<?php

namespace Voxel;

if ( ! defined('ABSPATH') ) {
	exit;
}

function get_visibility_context(): ?array {
	$stack = $GLOBALS['vx_visibility_context_stack'] ?? null;
	if ( ! is_array( $stack ) || empty( $stack ) ) {
		return null;
	}

	$context = end( $stack );
	return is_array( $context ) ? $context : null;
}

function with_visibility_context( ?array $context, callable $callback ) {
	if ( $context === null ) {
		return $callback();
	}

	if ( ! is_array( $GLOBALS['vx_visibility_context_stack'] ?? null ) ) {
		$GLOBALS['vx_visibility_context_stack'] = [];
	}

	$GLOBALS['vx_visibility_context_stack'][] = $context;

	try {
		return $callback();
	} finally {
		array_pop( $GLOBALS['vx_visibility_context_stack'] );
		if ( empty( $GLOBALS['vx_visibility_context_stack'] ) ) {
			unset( $GLOBALS['vx_visibility_context_stack'] );
		}
	}
}

function get_visibility_context_template(): ?array {
	$context = \Voxel\get_visibility_context();
	if ( ! is_array( $context['template'] ?? null ) ) {
		return null;
	}

	return $context['template'];
}

function get_visibility_context_query_var( string $key ) {
	$context = \Voxel\get_visibility_context();
	if ( ! is_array( $context['query_vars'] ?? null ) ) {
		return null;
	}

	$value = $context['query_vars'][ $key ] ?? null;
	if ( ! is_scalar( $value ) ) {
		return null;
	}

	return $value;
}

function create_visibility_context_snapshot(): array {
	$query_vars = [];
	foreach ( (array) $_GET as $key => $value ) {
		if ( ! is_scalar( $value ) ) {
			continue;
		}

		$key = (string) $key;
		if ( $key === '' ) {
			continue;
		}

		$query_vars[ $key ] = (string) wp_unslash( $value );
	}

	$post_id = null;
	$post_slug = null;
	$post_type = null;
	$page_ancestors = [];

	$term_id = null;
	$term_slug = null;
	$taxonomy = null;

	$author_id = null;
	$author_nicename = null;

	$archive_post_type = null;

	$queried_object = get_queried_object();
	if ( $queried_object instanceof \WP_Post ) {
		$post_id = (int) $queried_object->ID;
		$post_slug = is_string( $queried_object->post_name ) ? $queried_object->post_name : null;
		$post_type = is_string( $queried_object->post_type ) ? $queried_object->post_type : null;
	} elseif ( $queried_object instanceof \WP_Term ) {
		$term_id = (int) $queried_object->term_id;
		$term_slug = is_string( $queried_object->slug ) ? $queried_object->slug : null;
		$taxonomy = is_string( $queried_object->taxonomy ) ? $queried_object->taxonomy : null;
	} elseif ( $queried_object instanceof \WP_User ) {
		$author_id = (int) $queried_object->ID;
		$author_nicename = is_string( $queried_object->user_nicename ) ? $queried_object->user_nicename : null;
	} elseif ( $queried_object instanceof \WP_Post_Type ) {
		$archive_post_type = is_string( $queried_object->name ) ? $queried_object->name : null;
	}

	if ( is_page() && is_numeric( $post_id ) ) {
		$page_ancestors = array_values( array_filter( array_map( 'absint', (array) get_post_ancestors( $post_id ) ) ) );
	}

	if ( $archive_post_type === null ) {
		$query_post_type = get_query_var( 'post_type' );
		if ( is_array( $query_post_type ) ) {
			$query_post_type = $query_post_type[0] ?? null;
		}

		if ( is_string( $query_post_type ) && $query_post_type !== '' ) {
			$archive_post_type = $query_post_type;
		}
	}

	if ( $author_id === null && is_author() ) {
		$author_id = absint( get_query_var( 'author' ) );
		if ( ! empty( $query_vars['author_name'] ) ) {
			$author_nicename = (string) $query_vars['author_name'];
		}
	}

	return [
		'template' => [
			'is_page' => (bool) is_page(),
			'is_singular' => (bool) is_singular(),
			'is_post_type_archive' => (bool) is_post_type_archive(),
			'is_author' => (bool) is_author(),
			'is_tax' => (bool) is_tax(),
			'is_category' => (bool) is_category(),
			'is_tag' => (bool) is_tag(),
			'is_home' => (bool) is_home(),
			'is_front_page' => (bool) is_front_page(),
			'is_404' => (bool) is_404(),
			'post_id' => $post_id,
			'post_slug' => $post_slug,
			'post_type' => $post_type,
			'page_ancestors' => $page_ancestors,
			'archive_post_type' => $archive_post_type,
			'author_id' => $author_id,
			'author_nicename' => $author_nicename,
			'taxonomy' => $taxonomy,
			'term_id' => $term_id,
			'term_slug' => $term_slug,
		],
		'query_vars' => $query_vars,
	];
}

function issue_visibility_context_token( array $payload, int $ttl = 0 ): array {
	$ttl = max( absint( $ttl ), 1 );
	$issued_at = time();
	$payload['iat'] = $issued_at;
	$payload['exp'] = $issued_at + $ttl;
	$payload['v'] = 1;

	$header_segment = \Voxel\_visibility_context_base64url_encode( wp_json_encode( [
		'alg' => 'HS256',
		'typ' => 'VXVC',
		'v' => 1,
	] ) ?: '{}' );

	$payload_segment = \Voxel\_visibility_context_base64url_encode( wp_json_encode( $payload ) ?: '{}' );
	$message = $header_segment.'.'.$payload_segment;
	$signature = hash_hmac( 'sha256', $message, wp_salt( 'voxel_visibility_context_v1' ), true );

	return [
		'token' => $message.'.'.\Voxel\_visibility_context_base64url_encode( $signature ),
		'payload' => $payload,
	];
}

function verify_visibility_context_token( string $token, array $bindings = [] ): array {
	$result = [
		'valid' => false,
		'reason' => 'invalid',
		'payload' => null,
		'context' => null,
		'allowed_field_keys' => null,
	];

	$token = trim( $token );
	if ( $token === '' ) {
		$result['reason'] = 'missing';
		return $result;
	}

	$parts = explode( '.', $token );
	if ( count( $parts ) !== 3 ) {
		$result['reason'] = 'malformed';
		return $result;
	}

	[ $header_segment, $payload_segment, $signature_segment ] = $parts;

	$header_json = \Voxel\_visibility_context_base64url_decode( $header_segment );
	$payload_json = \Voxel\_visibility_context_base64url_decode( $payload_segment );
	$signature = \Voxel\_visibility_context_base64url_decode( $signature_segment );
	if ( $header_json === null || $payload_json === null || $signature === null ) {
		$result['reason'] = 'malformed';
		return $result;
	}

	$header = json_decode( $header_json, true );
	$payload = json_decode( $payload_json, true );
	if ( ! is_array( $header ) || ! is_array( $payload ) ) {
		$result['reason'] = 'malformed';
		return $result;
	}

	if ( ( $header['alg'] ?? null ) !== 'HS256' ) {
		$result['reason'] = 'malformed';
		return $result;
	}

	$message = $header_segment.'.'.$payload_segment;
	$expected_signature = hash_hmac( 'sha256', $message, wp_salt( 'voxel_visibility_context_v1' ), true );
	if ( ! hash_equals( $expected_signature, $signature ) ) {
		$result['reason'] = 'invalid_signature';
		return $result;
	}

	if ( ! is_numeric( $payload['exp'] ?? null ) || (int) $payload['exp'] < time() ) {
		$result['reason'] = 'expired';
		return $result;
	}

	if ( ! \Voxel\_visibility_context_bindings_match( $payload, $bindings ) ) {
		$result['reason'] = 'binding_mismatch';
		return $result;
	}

	$context = $payload['context'] ?? null;
	if ( ! is_array( $context ) ) {
		$result['reason'] = 'invalid_payload';
		return $result;
	}

	$allowed_field_keys = $payload['allowed_field_keys'] ?? null;
	if ( ! is_array( $allowed_field_keys ) ) {
		$result['reason'] = 'invalid_payload';
		return $result;
	}

	$normalized_field_keys = [];
	$seen_field_keys = [];
	foreach ( $allowed_field_keys as $field_key ) {
		if ( ! ( is_string( $field_key ) || is_numeric( $field_key ) ) ) {
			continue;
		}

		$field_key = (string) $field_key;
		if ( $field_key === '' ) {
			continue;
		}

		$lookup_key = 'key:'.$field_key;
		if ( isset( $seen_field_keys[ $lookup_key ] ) ) {
			continue;
		}

		$seen_field_keys[ $lookup_key ] = true;
		$normalized_field_keys[] = $field_key;
	}

	$result['valid'] = true;
	$result['reason'] = null;
	$result['payload'] = $payload;
	$result['context'] = $context;
	$result['allowed_field_keys'] = $normalized_field_keys;
	return $result;
}

function _visibility_context_bindings_match( array $payload, array $bindings ): bool {
	foreach ( $bindings as $key => $expected ) {
		$actual = $payload[ $key ] ?? null;

		if ( $expected === null ) {
			if ( ! ( $actual === null || $actual === '' ) ) {
				return false;
			}

			continue;
		}

		if ( is_int( $expected ) ) {
			if ( ! is_numeric( $actual ) || (int) $actual !== $expected ) {
				return false;
			}

			continue;
		}

		if ( (string) $actual !== (string) $expected ) {
			return false;
		}
	}

	return true;
}

function _visibility_context_base64url_encode( string $value ): string {
	return rtrim( strtr( base64_encode( $value ), '+/', '-_' ), '=' );
}

function _visibility_context_base64url_decode( string $value ): ?string {
	$padded = strtr( $value, '-_', '+/' );
	$padding = strlen( $padded ) % 4;
	if ( $padding > 0 ) {
		$padded .= str_repeat( '=', 4 - $padding );
	}

	$decoded = base64_decode( $padded, true );
	return $decoded === false ? null : $decoded;
}
