<?php

namespace Voxel\Direct_Messages;

if ( ! defined('ABSPATH') ) {
	exit;
}

function user_has_reached_message_rate_limit( int $user_id ): bool {
	global $wpdb;

	$limits = (array) \Voxel\get( 'settings.messages.rate_limit' );
	$limits = apply_filters( 'voxel/messages/rate-limits', $limits, $user_id );
	$user_id = absint( $user_id );

	$time_between = absint( $limits['time_between'] ?? 1 );
	if ( $time_between > 0 ) {
		$time_between_reached = !! $wpdb->get_var( $wpdb->prepare( <<<SQL
			SELECT COUNT(*) < 1
				FROM {$wpdb->prefix}voxel_messages m
				LEFT JOIN {$wpdb->posts} AS p ON ( m.sender_type = 'post' AND m.sender_id = p.ID )
			WHERE ( ( m.sender_type = 'user' AND m.sender_id = {$user_id} ) OR ( m.sender_type = 'post' AND p.post_author = {$user_id} ) )
				AND m.created_at >= %s
			LIMIT 1
		SQL, date( 'Y-m-d H:i:s', strtotime( sprintf( '-%d seconds', $time_between ) ) ) ) );

		if ( ! $time_between_reached ) {
			return true;
		}
	}

	$hourly_limit = absint( $limits['hourly_limit'] ?? 50 );
	if ( $hourly_limit > 0 ) {
		$hourly_limit_reached = !! $wpdb->get_var( $wpdb->prepare( <<<SQL
			SELECT COUNT(*) > {$hourly_limit}
				FROM {$wpdb->prefix}voxel_messages m
				LEFT JOIN {$wpdb->posts} AS p ON ( m.sender_type = 'post' AND m.sender_id = p.ID )
			WHERE ( ( m.sender_type = 'user' AND m.sender_id = {$user_id} ) OR ( m.sender_type = 'post' AND p.post_author = {$user_id} ) )
				AND m.created_at >= %s
		SQL, date( 'Y-m-d H:i:s', strtotime( '-1 hour' ) ) ) );

		if ( $hourly_limit_reached ) {
			return true;
		}
	}

	$daily_limit = absint( $limits['daily_limit'] ?? 200 );
	if ( $daily_limit > 0 ) {
		$daily_limit_reached = !! $wpdb->get_var( $wpdb->prepare( <<<SQL
			SELECT COUNT(*) > {$daily_limit}
				FROM {$wpdb->prefix}voxel_messages m
				LEFT JOIN {$wpdb->posts} AS p ON ( m.sender_type = 'post' AND m.sender_id = p.ID )
			WHERE ( ( m.sender_type = 'user' AND m.sender_id = {$user_id} ) OR ( m.sender_type = 'post' AND p.post_author = {$user_id} ) )
				AND m.created_at >= %s
		SQL, date( 'Y-m-d H:i:s', strtotime( '-1 day' ) ) ) );

		if ( $daily_limit_reached ) {
			return true;
		}
	}

	return false;
}

function user_has_reached_new_chat_limit( int $user_id ): bool {
	global $wpdb;

	$limits = (array) \Voxel\get( 'settings.messages.new_chats_limit' );
	$limits = apply_filters( 'voxel/messages/new-chat-limits', $limits, $user_id );
	$user_id = absint( $user_id );

	$daily_limit = absint( $limits['daily_limit'] ?? 10 );
	if ( $daily_limit <= 0 ) {
		return false;
	}

	$since = date( 'Y-m-d H:i:s', strtotime( '-1 day' ) );

	$new_chats_count = absint( $wpdb->get_var( $wpdb->prepare( <<<SQL
		SELECT COUNT(*) FROM (
			SELECT DISTINCT m.receiver_type, m.receiver_id
				FROM {$wpdb->prefix}voxel_messages m
				LEFT JOIN {$wpdb->posts} AS p ON ( m.sender_type = 'post' AND m.sender_id = p.ID )
			WHERE ( ( m.sender_type = 'user' AND m.sender_id = {$user_id} ) OR ( m.sender_type = 'post' AND p.post_author = {$user_id} ) )
				AND m.created_at >= %s
				AND NOT EXISTS (
					SELECT 1 FROM {$wpdb->prefix}voxel_messages older
					WHERE older.sender_type = m.sender_type
						AND older.sender_id = m.sender_id
						AND older.receiver_type = m.receiver_type
						AND older.receiver_id = m.receiver_id
						AND older.created_at < %s
				)
		) AS new_chats
	SQL, $since, $since ) ) );

	return $new_chats_count >= $daily_limit;
}

function user_meets_account_age_requirement( int $user_id ): bool {
	$min_hours = absint( \Voxel\get( 'settings.messages.min_account_age', 0 ) );
	$min_hours = apply_filters( 'voxel/messages/min-account-age', $min_hours, $user_id );

	if ( $min_hours <= 0 ) {
		return true;
	}

	$user = get_userdata( $user_id );
	if ( ! $user ) {
		return false;
	}

	$registered_at = strtotime( $user->user_registered );
	return ( time() - $registered_at ) >= ( $min_hours * HOUR_IN_SECONDS );
}
