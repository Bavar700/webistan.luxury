<?php

namespace Voxel\Controllers\Templates\Post_Types;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Post_Type_Custom_Templates_Controller extends \Voxel\Controllers\Base_Controller {

	protected function hooks() {
		$this->on( 'voxel_ajax_pte.create_custom_template', '@create_custom_template' );
		$this->on( 'voxel_ajax_pte.update_custom_template_details', '@update_custom_template_details' );
		$this->on( 'voxel_ajax_pte.update_custom_template_rules', '@update_custom_template_rules' );
		$this->on( 'voxel_ajax_pte.update_custom_template_order', '@update_custom_template_order' );
		$this->on( 'voxel_ajax_pte.delete_custom_template', '@delete_custom_template' );
		$this->on( 'voxel/templates/synchronize', '@run_template_sync' );
	}

	protected function run_template_sync() {
		$this->sync_post_type_custom_template_types_and_titles();
		$this->migrate_existing_post_type_single_post_templates_to_document_type();
		$this->migrate_existing_post_type_template_titles();
	}

	protected function create_custom_template() {
		try {
			\Voxel\verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'vx_admin_edit_templates' );
			if ( ! current_user_can('manage_options') ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 100 );
			}

			$post_type = \Voxel\Post_Type::get( $_GET['post_type'] ?? null );
			if ( ! $post_type ) {
				throw new \Exception( __( 'Could not create template', 'voxel-backend' ), 101 );
			}

			$templates = $post_type->templates->get_custom_templates();
			$group_key = $_GET['group'] ?? null;

			if ( ! isset( $templates[ $group_key ] ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 102 );
			}

			$label = sanitize_text_field( $_GET['label'] ?? '' );
			if ( empty( $label ) ) {
				throw new \Exception( __( 'Template label is required.', 'voxel-backend' ), 103 );
			}

			$post_type_label = method_exists( $post_type, 'get_label' )
				? $post_type->get_label()
				: ucfirst( $post_type->get_key() );
			$template_id = \Voxel\create_template(
				sprintf( '%s: %s', $post_type_label, $label )
			);

			if ( is_wp_error( $template_id ) ) {
				throw new \Exception( __( 'Could not create template', 'voxel-backend' ), 104 );
			}

			if ( in_array( $group_key, [ 'single_post', 'single' ], true ) ) {
				$this->set_elementor_template_type( $template_id, 'single-post', 'single' );
			} elseif ( $group_key === 'card' ) {
				$this->set_elementor_template_type( $template_id, 'card' );
			}

			$template_config = [
				'label' => $label,
				'id' => absint( $template_id ),
				'unique_key' => strtolower( \Voxel\random_string(8) ),
			];

			if ( in_array( $group_key, [ 'single_post' ], true ) ) {
				$template_config['visibility_rules'] = [];
			}

			$templates[ $group_key ][] = $template_config;

			$templates = array_map( 'array_values', $templates );
			$post_type->repository->set_config( [
				'custom_templates' => $templates,
			] );

			return wp_send_json( [
				'success' => true,
				'templates' => $templates,
			] );
		} catch ( \Exception $e ) {
			return wp_send_json( [
				'success' => false,
				'message' => $e->getMessage(),
			] );
		}
	}

	protected function update_custom_template_details() {
		try {
			\Voxel\verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'vx_admin_edit_templates' );
			if ( ! current_user_can('manage_options') ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 100 );
			}

			$post_type = \Voxel\Post_Type::get( $_GET['post_type'] ?? null );
			if ( ! $post_type ) {
				throw new \Exception( __( 'Could not update template', 'voxel-backend' ), 101 );
			}

			$templates = $post_type->templates->get_custom_templates();
			$unique_key = $_GET['unique_key'] ?? null;
			$group_key = $_GET['group'] ?? null;

			if ( ! isset( $templates[ $group_key ] ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 102 );
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

					if ( in_array( $group_key, [ 'single_post', 'single' ], true ) ) {
						$this->set_elementor_template_type( $new_template_id, 'single-post', 'single' );
					} elseif ( $group_key === 'card' ) {
						$this->set_elementor_template_type( $new_template_id, 'card' );
					}

					// make sure templates are stored as indexed arrays
					$templates = array_map( 'array_values', $templates );
					$post_type->repository->set_config( [
						'custom_templates' => $templates,
					] );

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
			] );
		}
	}

	protected function update_custom_template_rules() {
		try {
			\Voxel\verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'vx_admin_edit_templates' );
			if ( ! current_user_can('manage_options') ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 100 );
			}

			$post_type = \Voxel\Post_Type::get( $_GET['post_type'] ?? null );
			if ( ! $post_type ) {
				throw new \Exception( __( 'Could not update template', 'voxel-backend' ), 101 );
			}

			$templates = $post_type->templates->get_custom_templates();
			$unique_key = $_GET['unique_key'] ?? null;
			$group_key = $_GET['group'] ?? null;

			if ( ! isset( $templates[ $group_key ] ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 102 );
			}

			foreach ( $templates[ $group_key ] as $i => $template ) {
				if ( $template['unique_key'] === $unique_key ) {
					$rules = (array) json_decode( wp_unslash( $_POST['visibility_rules'] ?? '' ), true );
					$templates[ $group_key ][ $i ]['visibility_rules'] = is_array( $rules ) ? $rules : [];

					// make sure templates are stored as indexed arrays
					$templates = array_map( 'array_values', $templates );
					$post_type->repository->set_config( [
						'custom_templates' => $templates,
					] );

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
			] );
		}
	}

	protected function update_custom_template_order() {
		try {
			\Voxel\verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'vx_admin_edit_templates' );
			if ( ! current_user_can('manage_options') ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 100 );
			}

			$post_type = \Voxel\Post_Type::get( $_REQUEST['post_type'] ?? null );
			if ( ! $post_type ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 101 );
			}

			$custom_templates = json_decode( stripslashes( $_REQUEST['custom_templates'] ), true );

			if ( ! is_array( $custom_templates ) || empty( $custom_templates ) ) {
				throw new \Exception( 'Invalid request.', 102 );
			}

			$templates = array_map( 'array_values', $custom_templates );
			$post_type->repository->set_config( [
				'custom_templates' => $custom_templates,
			] );

			return wp_send_json( [
				'success' => true,
			] );
		} catch ( \Exception $e ) {
			return wp_send_json( [
				'success' => false,
				'message' => $e->getMessage(),
			] );
		}
	}

	protected function delete_custom_template() {
		try {
			\Voxel\verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'vx_admin_edit_templates' );
			if ( ! current_user_can('manage_options') ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ) );
			}

			$post_type = \Voxel\Post_Type::get( $_REQUEST['post_type'] ?? null );
			if ( ! $post_type ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 101 );
			}

			$templates = $post_type->templates->get_custom_templates();
			$unique_key = $_REQUEST['unique_key'] ?? null;
			$group_key = $_REQUEST['group'] ?? null;

			if ( ! isset( $templates[ $group_key ] ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 102 );
			}

			foreach ( $templates[ $group_key ] as $i => $template ) {
				if ( $template['unique_key'] === $unique_key ) {
					if ( is_numeric( $template['id'] ) ) {
						wp_delete_post( $template['id'] );
					}

					unset( $templates[ $group_key ][ $i ] );

					// make sure templates are stored as indexed arrays
					$templates = array_map( 'array_values', $templates );
					$post_type->repository->set_config( [
						'custom_templates' => $templates,
					] );

					return wp_send_json( [
						'success' => true,
						'templates' => $templates,
					] );
				}
			}

			throw new \Exception( __( 'Could not delete template.', 'voxel-backend' ), 105 );
		} catch ( \Exception $e ) {
			return wp_send_json( [
				'success' => false,
				'message' => $e->getMessage(),
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

	protected function migrate_existing_post_type_single_post_templates_to_document_type() {
		$migration_key = 'voxel_post_type_single_post_card_document_type_migrated_v3';
		if ( get_option( $migration_key ) ) {
			return;
		}

		foreach ( \Voxel\Post_Type::get_voxel_types() as $post_type ) {
			$custom_templates = $post_type->templates->get_custom_templates();
			$card_templates = is_array( $custom_templates['card'] ?? null ) ? $custom_templates['card'] : [];
			$single_templates = is_array( $custom_templates['single'] ?? null ) ? $custom_templates['single'] : [];
			$single_post_templates = is_array( $custom_templates['single_post'] ?? null ) ? $custom_templates['single_post'] : [];
			foreach ( $card_templates as $template ) {
				$template_id = absint( $template['id'] ?? 0 );
				if ( $template_id ) {
					$this->set_elementor_template_type( $template_id, 'card' );
				}
			}
			foreach ( $single_templates as $template ) {
				$template_id = absint( $template['id'] ?? 0 );
				if ( $template_id ) {
					$this->set_elementor_template_type( $template_id, 'single-post', 'single' );
				}
			}
			foreach ( $single_post_templates as $template ) {
				$template_id = absint( $template['id'] ?? 0 );
				if ( $template_id ) {
					$this->set_elementor_template_type( $template_id, 'single-post', 'single' );
				}
			}
		}

		update_option( $migration_key, 1, true );
	}

	protected function migrate_existing_post_type_template_titles() {
		$migration_key = 'voxel_post_type_template_titles_migrated_v2';
		if ( get_option( $migration_key ) ) {
			return;
		}

		foreach ( \Voxel\Post_Type::get_voxel_types() as $post_type ) {
			$post_type_key = $post_type->get_key();
			$post_type_label = method_exists( $post_type, 'get_label' )
				? $post_type->get_label()
				: ucfirst( $post_type_key );

			$base_templates = $post_type->get_templates();
			$base_title_map = [
				'single' => 'Single post',
				'card' => 'Preview card',
				'archive' => 'Archive',
			];

			foreach ( $base_title_map as $template_key => $template_label ) {
				$template_id = absint( $base_templates[ $template_key ] ?? 0 );
				if ( ! $template_id ) {
					continue;
				}

				$post = get_post( $template_id );
				if ( ! ( $post && $post->post_type === 'elementor_library' ) ) {
					continue;
				}

				$current_title = (string) $post->post_title;
				$expected_title = sprintf( '%s: %s', $post_type_label, $template_label );
				if ( $current_title === $expected_title ) {
					continue;
				}

				$legacy_patterns = [
					sprintf( '/^post type:\s*%s\s*\|\s*template:\s*%s$/i', preg_quote( $post_type_key, '/' ), preg_quote( $template_key, '/' ) ),
					sprintf( '/^%s:\s*%s$/i', preg_quote( $post_type_key, '/' ), preg_quote( $template_key, '/' ) ),
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

			$custom_templates = $post_type->templates->get_custom_templates();
			foreach ( $custom_templates as $group_key => $templates ) {
				foreach ( (array) $templates as $template ) {
					$template_id = absint( $template['id'] ?? 0 );
					$template_label = sanitize_text_field( $template['label'] ?? '' );
					if ( ! $template_id || $template_label === '' ) {
						continue;
					}

					$post = get_post( $template_id );
					if ( ! ( $post && $post->post_type === 'elementor_library' ) ) {
						continue;
					}

					$current_title = (string) $post->post_title;
					$expected_title = sprintf( '%s: %s', $post_type_label, $template_label );
					if ( $current_title === $expected_title ) {
						continue;
					}

					$legacy_patterns = [
						sprintf(
							'/^Post type:\s*%s\s*\|\s*Template:\s*%s\s*\(%s\)$/i',
							preg_quote( $post_type_key, '/' ),
							preg_quote( $group_key, '/' ),
							preg_quote( $template_label, '/' )
						),
						sprintf(
							'/^%s:\s*%s$/i',
							preg_quote( $post_type_key, '/' ),
							preg_quote( $template_label, '/' )
						),
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
		}

		update_option( $migration_key, 1, true );
	}

	protected function sync_post_type_custom_template_types_and_titles() {
		foreach ( \Voxel\Post_Type::get_voxel_types() as $post_type ) {
			$post_type_label = method_exists( $post_type, 'get_label' )
				? $post_type->get_label()
				: ucfirst( $post_type->get_key() );
			$custom_templates = $post_type->templates->get_custom_templates();
			$type_map = [
				'card' => [ 'type' => 'card', 'location' => '' ],
				'single' => [ 'type' => 'single-post', 'location' => 'single' ],
				'single_post' => [ 'type' => 'single-post', 'location' => 'single' ],
			];

			foreach ( $type_map as $group_key => $config ) {
				foreach ( (array) ( $custom_templates[ $group_key ] ?? [] ) as $template ) {
					$template_id = absint( $template['id'] ?? 0 );
					$template_label = sanitize_text_field( $template['label'] ?? '' );
					if ( ! $template_id ) {
						continue;
					}

					$this->set_elementor_template_type( $template_id, $config['type'], $config['location'] );

					if ( $template_label === '' ) {
						continue;
					}

					$post = get_post( $template_id );
					if ( ! ( $post && $post->post_type === 'elementor_library' ) ) {
						continue;
					}

					$expected_title = sprintf( '%s: %s', $post_type_label, $template_label );
					if ( $post->post_title !== $expected_title ) {
						wp_update_post( [
							'ID' => $template_id,
							'post_title' => $expected_title,
						] );
					}
				}
			}
		}

		// Hard fallback for imported legacy titles not present in current config.
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
			if ( ! preg_match( '/^Post type:\s*([a-z0-9_]+)\s*\|\s*Template:\s*([a-z0-9_]+)\s*\((.+)\)$/i', $title, $matches ) ) {
				continue;
			}

			$post_type_key = sanitize_key( $matches[1] );
			$group_key = sanitize_key( $matches[2] );
			$template_label = sanitize_text_field( trim( $matches[3] ) );
			if ( $template_label === '' ) {
				continue;
			}

			$post_type = \Voxel\Post_Type::get( $post_type_key );
			if ( ! $post_type ) {
				continue;
			}

			$type_map = [
				'card' => [ 'type' => 'card', 'location' => '' ],
				'single' => [ 'type' => 'single-post', 'location' => 'single' ],
				'single_post' => [ 'type' => 'single-post', 'location' => 'single' ],
			];
			if ( ! isset( $type_map[ $group_key ] ) ) {
				continue;
			}

			$this->set_elementor_template_type( $template_id, $type_map[ $group_key ]['type'], $type_map[ $group_key ]['location'] );

			$post_type_label = method_exists( $post_type, 'get_label' )
				? $post_type->get_label()
				: ucfirst( $post_type_key );
			$expected_title = sprintf( '%s: %s', $post_type_label, $template_label );
			if ( $title !== $expected_title ) {
				wp_update_post( [
					'ID' => $template_id,
					'post_title' => $expected_title,
				] );
			}
		}
	}
}
