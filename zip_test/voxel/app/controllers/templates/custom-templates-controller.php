<?php

namespace Voxel\Controllers\Templates;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Custom_Templates_Controller extends \Voxel\Controllers\Base_Controller {

	protected function hooks() {
		$this->on( 'voxel_ajax_backend.create_custom_template', '@create_custom_template' );
		$this->on( 'voxel_ajax_backend.update_custom_template_details', '@update_custom_template_details' );
		$this->on( 'voxel_ajax_backend.update_custom_template_rules', '@update_custom_template_rules' );
		$this->on( 'voxel_ajax_backend.update_custom_template_order', '@update_custom_template_order' );
		$this->on( 'voxel_ajax_backend.delete_custom_template', '@delete_custom_template' );
		$this->on( 'voxel/templates/synchronize', '@run_template_sync' );
	}

	protected function run_template_sync() {
		$this->sync_custom_templates_types_and_titles();
		$this->migrate_existing_header_footer_templates_to_document_types();
		$this->migrate_existing_custom_template_titles();
	}

	protected function create_custom_template() {
		try {
			\Voxel\verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'vx_admin_edit_templates' );
			if ( ! current_user_can( 'manage_options' ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 100 );
			}

			$templates = \Voxel\get_custom_templates();
			$group_key = $_GET['group'] ?? null;

			if ( ! isset( $templates[ $group_key ] ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 101 );
			}

			$label = sanitize_text_field( $_GET['label'] ?? '' );
			if ( empty( $label ) ) {
				throw new \Exception( __( 'Template label is required.', 'voxel-backend' ), 102 );
			}

			$group_label = [
				'header' => 'Header',
				'footer' => 'Footer',
				'term_single' => 'Single term',
				'term_card' => 'Preview card',
			][ $group_key ] ?? ucfirst( str_replace( '_', ' ', $group_key ) );

			$template_id = \Voxel\create_template( sprintf( '%s: %s', $group_label, $label ) );
			if ( is_wp_error( $template_id ) ) {
				throw new \Exception( __( 'Could not create template', 'voxel-backend' ), 103 );
			}

			if ( in_array( $group_key, [ 'header', 'footer' ], true ) ) {
				$this->set_elementor_template_type( $template_id, $group_key, $group_key );
			} elseif ( $group_key === 'term_card' ) {
				$this->set_elementor_template_type( $template_id, 'card' );
			} elseif ( $group_key === 'term_single' ) {
				$this->set_elementor_template_type( $template_id, 'single-term' );
			}

			$template_config = [
				'label' => $label,
				'id' => absint( $template_id ),
				'unique_key' => strtolower( \Voxel\random_string(8) ),
			];

			if ( in_array( $group_key, [ 'header', 'footer', 'term_single' ], true ) ) {
				$template_config['visibility_rules'] = [];
			}

			$templates[ $group_key ][] = $template_config;

			// make sure templates are stored as indexed arrays
			$templates = array_map( 'array_values', $templates );
			\Voxel\set( 'custom_templates', $templates );

			return wp_send_json( [
				'success' => true,
				'templates'	=> $templates,
			] );
		} catch ( \Exception $e ) {
			return wp_send_json( [
				'success' => false,
				'message' => $e->getMessage(),
				'code' => $e->getCode(),
			] );
		}
	}

	protected function update_custom_template_details() {
		try {
			\Voxel\verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'vx_admin_edit_templates' );
			if ( ! current_user_can( 'manage_options' ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 100 );
			}

			$templates = \Voxel\get_custom_templates();
			$unique_key = $_GET['unique_key'] ?? null;
			$group_key = $_GET['group'] ?? null;

			if ( ! isset( $templates[ $group_key ] ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 101 );
			}

			foreach ( $templates[ $group_key ] as $i => $template ) {
				if ( $template['unique_key'] === $unique_key ) {
					$new_template_id = $_GET['new_template_id'] ?? null;
					if ( ! is_numeric( $new_template_id ) ) {
						throw new \Exception( __( 'Template ID cannot be empty', 'voxel-backend' ), 102 );
					}

					$new_template_id = absint( $new_template_id );
					if ( ! \Voxel\template_exists( $new_template_id ) ) {
						throw new \Exception( __( 'Provided template does not exist', 'voxel-backend' ), 103 );
					}

					$new_template_label = sanitize_text_field( $_GET['new_template_label'] ?? '' );
					if ( empty( $new_template_label ) ) {
						throw new \Exception( __( 'Template label cannot be empty', 'voxel-backend' ), 104 );
					}

					$templates[ $group_key ][ $i ]['id'] = $new_template_id;
					$templates[ $group_key ][ $i ]['label'] = $new_template_label;

					if ( in_array( $group_key, [ 'header', 'footer' ], true ) ) {
						$this->set_elementor_template_type( $new_template_id, $group_key, $group_key );
					} elseif ( $group_key === 'term_card' ) {
						$this->set_elementor_template_type( $new_template_id, 'card' );
					} elseif ( $group_key === 'term_single' ) {
						$this->set_elementor_template_type( $new_template_id, 'single-term' );
					}

					// make sure templates are stored as indexed arrays
					$templates = array_map( 'array_values', $templates );
					\Voxel\set( 'custom_templates', $templates );

					return wp_send_json( [
						'success' => true,
					] );
				}
			}

			throw new \Exception( __( 'Could not update template.', 'voxel-backend' ), 105 );
		} catch ( \Exception $e ) {
			return wp_send_json( [
				'success' => false,
				'message' => $e->getMessage(),
				'code' => $e->getCode(),
			] );
		}
	}

	protected function update_custom_template_rules() {
		try {
			\Voxel\verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'vx_admin_edit_templates' );
			if ( ! current_user_can( 'manage_options' ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 100 );
			}

			$templates = \Voxel\get_custom_templates();
			$unique_key = $_GET['unique_key'] ?? null;
			$group_key = $_GET['group'] ?? null;

			if ( ! isset( $templates[ $group_key ] ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 101 );
			}

			foreach ( $templates[ $group_key ] as $i => $template ) {
				if ( $template['unique_key'] === $unique_key ) {
					$rules = (array) json_decode( wp_unslash( $_POST['visibility_rules'] ?? '' ), true );
					$templates[ $group_key ][ $i ]['visibility_rules'] = is_array( $rules ) ? $rules : [];

					// make sure templates are stored as indexed arrays
					$templates = array_map( 'array_values', $templates );
					\Voxel\set( 'custom_templates', $templates );

					return wp_send_json( [
						'success' => true,
					] );
				}
			}

			throw new \Exception( __( 'Could not update template.', 'voxel-backend' ), 105 );
		} catch ( \Exception $e ) {
			return wp_send_json( [
				'success' => false,
				'message' => $e->getMessage(),
				'code' => $e->getCode(),
			] );
		}
	}

	protected function delete_custom_template() {
		try {
			\Voxel\verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'vx_admin_edit_templates' );
			if ( ! current_user_can( 'manage_options' ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ) );
			}

			$templates = \Voxel\get_custom_templates();
			$unique_key = $_GET['unique_key'] ?? null;
			$group_key = $_GET['group'] ?? null;

			if ( ! isset( $templates[ $group_key ] ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 101 );
			}

			foreach ( $templates[ $group_key ] as $i => $template ) {
				if ( $template['unique_key'] === $unique_key ) {
					if ( is_numeric( $template['id'] ) ) {
						wp_delete_post( $template['id'] );
					}

					unset( $templates[ $group_key ][ $i ] );

					// make sure templates are stored as indexed arrays
					$templates = array_map( 'array_values', $templates );
					\Voxel\set( 'custom_templates', $templates );

					return wp_send_json( [
						'success' => true,
						'templates' => $templates,
					] );
				}
			}

			throw new \Exception( __( 'Could not update template.', 'voxel-backend' ), 105 );
		} catch ( \Exception $e ) {
			return wp_send_json( [
				'success' => false,
				'message' => $e->getMessage(),
				'code' => $e->getCode(),
			] );
		}
	}

	protected function update_custom_template_order() {
		try {
			\Voxel\verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'vx_admin_edit_templates' );
			if ( ! current_user_can( 'manage_options' ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 100 );
			}

			$custom_templates = json_decode( stripslashes( $_REQUEST['custom_templates'] ), true );

			if ( ! is_array( $custom_templates ) || empty( $custom_templates ) ) {
				throw new \Exception( 'Invalid request.', 101 );
			}

			// make sure templates are stored as indexed arrays
			$custom_templates = array_map( 'array_values', $custom_templates );
			\Voxel\set( 'custom_templates', $custom_templates );

			return wp_send_json( [
				'success' => true,
			] );
		} catch ( \Exception $e ) {
			return wp_send_json( [
				'success' => false,
				'message' => $e->getMessage(),
				'code' => $e->getCode(),
			] );
		}
	}

	protected function set_elementor_template_type( int $template_id, string $template_type, string $location = '' ): void {
		if ( get_post_type( $template_id ) !== 'elementor_library' ) {
			return;
		}

		update_post_meta( $template_id, '_elementor_template_type', $template_type );
		wp_set_object_terms( $template_id, $template_type, 'elementor_library_type' );

		if ( $location !== '' ) {
			update_post_meta( $template_id, '_elementor_location', $location );
		}
	}

	protected function migrate_existing_header_footer_templates_to_document_types() {
		$migration_key = 'voxel_header_footer_card_term_document_type_migrated_v4';
		if ( get_option( $migration_key ) ) {
			return;
		}

		$templates = \Voxel\get_custom_templates();
		$headers = is_array( $templates['header'] ?? null ) ? $templates['header'] : [];
		$footers = is_array( $templates['footer'] ?? null ) ? $templates['footer'] : [];
		$term_cards = is_array( $templates['term_card'] ?? null ) ? $templates['term_card'] : [];
		$term_singles = is_array( $templates['term_single'] ?? null ) ? $templates['term_single'] : [];
		$core_templates = \Voxel\get( 'templates', [] );
		$core_header_id = absint( $core_templates['header'] ?? 0 );
		$core_footer_id = absint( $core_templates['footer'] ?? 0 );

		foreach ( $headers as $template ) {
			$template_id = absint( $template['id'] ?? 0 );
			if ( $template_id ) {
				$this->set_elementor_template_type( $template_id, 'header', 'header' );
			}
		}

		foreach ( $footers as $template ) {
			$template_id = absint( $template['id'] ?? 0 );
			if ( $template_id ) {
				$this->set_elementor_template_type( $template_id, 'footer', 'footer' );
			}
		}

		foreach ( $term_cards as $template ) {
			$template_id = absint( $template['id'] ?? 0 );
			if ( $template_id ) {
				$this->set_elementor_template_type( $template_id, 'card' );
			}
		}

		foreach ( $term_singles as $template ) {
			$template_id = absint( $template['id'] ?? 0 );
			if ( $template_id ) {
				$this->set_elementor_template_type( $template_id, 'single-term' );
			}
		}

		if ( $core_header_id ) {
			$this->set_elementor_template_type( $core_header_id, 'header', 'header' );
		}

		if ( $core_footer_id ) {
			$this->set_elementor_template_type( $core_footer_id, 'footer', 'footer' );
		}

		update_option( $migration_key, 1, true );
	}

	protected function migrate_existing_custom_template_titles() {
		$migration_key = 'voxel_custom_template_titles_migrated_v4';
		if ( get_option( $migration_key ) ) {
			return;
		}

		$templates = \Voxel\get_custom_templates();
		$group_label_map = [
			'header' => 'Header',
			'footer' => 'Footer',
			'term_single' => 'Single term',
			'term_card' => 'Preview card',
		];

		foreach ( $group_label_map as $group_key => $group_label ) {
			foreach ( (array) ( $templates[ $group_key ] ?? [] ) as $template ) {
				$template_id = absint( $template['id'] ?? 0 );
				$template_label = sanitize_text_field( $template['label'] ?? '' );
				if ( ! $template_id ) {
					continue;
				}

				$post = get_post( $template_id );
				if ( ! ( $post && $post->post_type === 'elementor_library' ) ) {
					continue;
				}

				$current_title = (string) $post->post_title;
				$resolved_label = $template_label;

				// Fallback: parse label directly from legacy title.
				$legacy_pattern = sprintf( '/^template:\s*%s\s*\((.+)\)$/i', preg_quote( $group_key, '/' ) );
				if ( preg_match( $legacy_pattern, $current_title, $matches ) ) {
					$resolved_label = sanitize_text_field( trim( $matches[1] ) );
				}

				if ( $resolved_label === '' ) {
					continue;
				}

				$expected_title = sprintf( '%s: %s', $group_label, $resolved_label );
				if ( $current_title === $expected_title ) {
					continue;
				}

				$legacy_patterns = [
					sprintf( '/^template:\s*%s\s*\(.+\)$/i', preg_quote( $group_key, '/' ) ),
					sprintf( '/^%s:\s*.+$/i', preg_quote( $group_key, '/' ) ),
				];

				$should_rename = false;
				foreach ( $legacy_patterns as $pattern ) {
					if ( preg_match( $pattern, $current_title ) ) {
						$should_rename = true;
						break;
					}
				}

				if ( ! $should_rename ) {
					continue;
				}

				wp_update_post( [
					'ID' => $template_id,
					'post_title' => $expected_title,
				] );
			}
		}

		// Fallback pass: rename any remaining legacy titles directly by title pattern.
		$legacy_posts = get_posts( [
			'post_type' => 'elementor_library',
			'post_status' => 'any',
			'posts_per_page' => -1,
			'fields' => 'ids',
			'suppress_filters' => true,
		] );

		foreach ( $legacy_posts as $post_id ) {
			$title = (string) get_the_title( $post_id );
			$matches = [];
			if ( ! preg_match( '/^template:\s*(header|footer|term_single|term_card)\s*\((.+)\)$/i', $title, $matches ) ) {
				continue;
			}

			$group_key = strtolower( sanitize_key( $matches[1] ) );
			$label = sanitize_text_field( trim( $matches[2] ) );
			if ( ! isset( $group_label_map[ $group_key ] ) || $label === '' ) {
				continue;
			}

			wp_update_post( [
				'ID' => $post_id,
				'post_title' => sprintf( '%s: %s', $group_label_map[ $group_key ], $label ),
			] );
		}

		update_option( $migration_key, 1, true );
	}

	protected function sync_custom_templates_types_and_titles() {
		$templates = \Voxel\get_custom_templates();
		$type_map = [
			'header' => [ 'type' => 'header', 'location' => 'header', 'label' => 'Header' ],
			'footer' => [ 'type' => 'footer', 'location' => 'footer', 'label' => 'Footer' ],
			'term_single' => [ 'type' => 'single-term', 'location' => '', 'label' => 'Single term' ],
			'term_card' => [ 'type' => 'card', 'location' => '', 'label' => 'Preview card' ],
		];

		foreach ( $type_map as $group_key => $config ) {
			foreach ( (array) ( $templates[ $group_key ] ?? [] ) as $template ) {
				$template_id = absint( $template['id'] ?? 0 );
				$template_label = sanitize_text_field( $template['label'] ?? '' );
				if ( ! $template_id ) {
					continue;
				}

				$this->set_elementor_template_type( $template_id, $config['type'], $config['location'] );

				$post = get_post( $template_id );
				if ( ! ( $post && $post->post_type === 'elementor_library' ) ) {
					continue;
				}

				$matches = [];
				$current_title = (string) $post->post_title;
				if ( preg_match( sprintf( '/^template:\s*%s\s*\((.+)\)$/i', preg_quote( $group_key, '/' ) ), $current_title, $matches ) ) {
					$template_label = sanitize_text_field( trim( $matches[1] ) );
				}

				if ( $template_label === '' ) {
					continue;
				}

				$expected_title = sprintf( '%s: %s', $config['label'], $template_label );
				if ( $current_title !== $expected_title ) {
					wp_update_post( [
						'ID' => $template_id,
						'post_title' => $expected_title,
					] );
				}
			}
		}

		// Core header/footer templates (stored in `templates` option).
		$core_templates = \Voxel\get( 'templates', [] );
		$core_map = [
			'header' => [ 'type' => 'header', 'location' => 'header', 'title' => 'Header: Main' ],
			'footer' => [ 'type' => 'footer', 'location' => 'footer', 'title' => 'Footer: Main' ],
			'404' => [ 'type' => '', 'location' => '', 'title' => '404 Not Found' ],
			'restricted' => [ 'type' => '', 'location' => '', 'title' => 'Restricted content' ],
		];

		foreach ( $core_map as $template_key => $config ) {
			$template_id = absint( $core_templates[ $template_key ] ?? 0 );
			if ( ! $template_id ) {
				continue;
			}

			if ( $config['type'] !== '' ) {
				$this->set_elementor_template_type( $template_id, $config['type'], $config['location'] );
			}

			$post = get_post( $template_id );
			if ( ! ( $post && $post->post_type === 'elementor_library' ) ) {
				continue;
			}

			$current_title = (string) $post->post_title;
			$is_legacy_site_template_title = preg_match(
				sprintf( '/^site\s*template:\s*%s$/i', preg_quote( $template_key, '/' ) ),
				$current_title
			);

			if ( $current_title !== $config['title'] && $is_legacy_site_template_title ) {
				wp_update_post( [
					'ID' => $template_id,
					'post_title' => $config['title'],
				] );
			}
		}

		// Hard fallback for imported templates not linked in config arrays.
		$all_template_ids = get_posts( [
			'post_type' => 'elementor_library',
			'post_status' => 'any',
			'posts_per_page' => -1,
			'fields' => 'ids',
			'suppress_filters' => true,
		] );

		foreach ( $all_template_ids as $template_id ) {
			$title = (string) get_the_title( $template_id );
			$matches = [];
			if ( preg_match( '/^site\s*template:\s*(header|footer|404(?:\s*page\s*not\s*found)?|restricted(?:\s*content)?)$/i', $title, $matches ) ) {
				$group_key = strtolower( sanitize_key( $matches[1] ) );
				$legacy_key_map = [
					'header' => 'header',
					'footer' => 'footer',
					'404' => '404',
					'404pagenotfound' => '404',
					'restricted' => 'restricted',
					'restrictedcontent' => 'restricted',
				];
				$normalized_legacy_key = str_replace( [ '_', '-', ' ' ], '', $group_key );
				$core_key = $legacy_key_map[ $normalized_legacy_key ] ?? null;
				if ( ! $core_key || ! isset( $core_map[ $core_key ] ) ) {
					continue;
				}

				$config = $core_map[ $core_key ];
				if ( $config['type'] !== '' ) {
					$this->set_elementor_template_type( $template_id, $config['type'], $config['location'] );
				}

				$expected_title = $config['title'];
				if ( $title !== $expected_title ) {
					wp_update_post( [
						'ID' => $template_id,
						'post_title' => $expected_title,
					] );
				}

				continue;
			}

			if ( ! preg_match( '/^template:\s*(header|footer|term_single|term_card)\s*\((.+)\)$/i', $title, $matches ) ) {
				continue;
			}

			$group_key = strtolower( sanitize_key( $matches[1] ) );
			$template_label = sanitize_text_field( trim( $matches[2] ) );
			if ( ! isset( $type_map[ $group_key ] ) || $template_label === '' ) {
				continue;
			}

			$config = $type_map[ $group_key ];
			$this->set_elementor_template_type( $template_id, $config['type'], $config['location'] );

			$expected_title = sprintf( '%s: %s', $config['label'], $template_label );
			if ( $title !== $expected_title ) {
				wp_update_post( [
					'ID' => $template_id,
					'post_title' => $expected_title,
				] );
			}
		}
	}
}
