<?php

namespace Voxel\Controllers\Templates\Post_Types;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Post_Type_Base_Templates_Controller extends \Voxel\Controllers\Base_Controller {

	protected function hooks() {
		$this->on( 'voxel_ajax_pte.create_base_template', '@create_base_template' );
		$this->on( 'voxel_ajax_pte.update_base_template_id', '@update_base_template_id' );
		$this->on( 'voxel_ajax_pte.delete_base_template', '@delete_base_template' );
		$this->on( 'voxel/templates/synchronize', '@run_template_sync' );
	}

	protected function run_template_sync() {
		$this->sync_post_type_base_template_types_and_titles();
		$this->migrate_existing_post_type_base_templates_to_document_types();
	}

	protected function create_base_template() {
		try {
			\Voxel\verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'vx_admin_edit_templates' );
			if ( ! current_user_can( 'manage_options' ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 100 );
			}

			$post_type = \Voxel\Post_Type::get( $_GET['post_type'] ?? null );
			if ( ! $post_type ) {
				throw new \Exception( __( 'Could not create template', 'voxel-backend' ), 101 );
			}

			$template_key = $_GET['template_key'] ?? null;
			if ( $template_key === 'form' ) {
				$title = sprintf( 'Create %s', $post_type->get_singular_name() );
				$new_template_id = \Voxel\create_page(
					$title,
					sprintf( 'create-%s', $post_type->get_key() )
				);

				if ( is_wp_error( $new_template_id ) ) {
					throw new \Exception( __( 'Could not create template', 'voxel-backend' ), 103 );
				}

				$templates = $post_type->get_templates();
				$templates['form'] = $new_template_id;

				$post_type->repository->set_config( [
					'templates' => $templates,
				] );

				return wp_send_json( [
					'success' => true,
					'template_id' => $new_template_id,
				] );
			} else {
				throw new \Exception( __( 'Could not create template', 'voxel-backend' ), 102 );
			}
		} catch ( \Exception $e ) {
			return wp_send_json( [
				'success' => false,
				'message' => $e->getMessage(),
			] );
		}
	}

	protected function update_base_template_id() {
		try {
			\Voxel\verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'vx_admin_edit_templates' );
			if ( ! current_user_can( 'manage_options' ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ) );
			}

			$post_type = \Voxel\Post_Type::get( $_GET['post_type'] ?? null );
			if ( ! $post_type ) {
				throw new \Exception( __( 'Could not edit template', 'voxel-backend' ), 101 );
			}

			$template_key = $_GET['template_key'] ?? null;
			if ( ! in_array( $template_key, [ 'single', 'card', 'archive', 'form' ], true ) ) {
				throw new \Exception( __( 'Could not edit template', 'voxel-backend' ), 102 );
			}

			$template_type = $template_key === 'form' ? 'page' : 'template';

			$new_template_id = $_GET['new_template_id'] ?? null;
			if ( ! is_numeric( $new_template_id ) ) {
				throw new \Exception( __( 'Enter the ID of the new template.', 'voxel-backend' ), 103 );
			}

			$new_template_id = absint( $new_template_id );
			if ( $template_type === 'page' && ! \Voxel\page_exists( $new_template_id ) ) {
				throw new \Exception( __( 'Provided page template does not exist.', 'voxel-backend' ), 104 );
			} elseif ( $template_type === 'template' && ! \Voxel\template_exists( $new_template_id ) ) {
				throw new \Exception( __( 'Provided template does not exist.', 'voxel-backend' ), 105 );
			}

			$post_type_templates = $post_type->get_templates();
			$post_type_templates[ $template_key ] = $new_template_id;

			if ( $template_key === 'archive' ) {
				$this->set_elementor_template_type( $new_template_id, 'archive', 'archive' );
			} elseif ( $template_key === 'single' ) {
				$this->set_elementor_template_type( $new_template_id, 'single-post', 'single' );
			} elseif ( $template_key === 'card' ) {
				$this->set_elementor_template_type( $new_template_id, 'card' );
			}

			$post_type->repository->set_config( [
				'templates' => $post_type_templates,
			] );

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

	protected function delete_base_template() {
		try {
			\Voxel\verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'vx_admin_edit_templates' );
			if ( ! current_user_can( 'manage_options' ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel-backend' ), 100 );
			}

			$post_type = \Voxel\Post_Type::get( $_GET['post_type'] ?? null );
			if ( ! $post_type ) {
				throw new \Exception( __( 'Could not delete template', 'voxel-backend' ), 101 );
			}

			$template_key = $_GET['template_key'] ?? null;
			if ( $template_key === 'form' ) {
				$templates = $post_type->get_templates();

				if ( is_numeric( $templates['form'] ) ) {
					wp_delete_post( $templates['form'] );
				}

				$templates['form'] = null;

				$post_type->repository->set_config( [
					'templates' => $templates,
				] );

				return wp_send_json( [
					'success' => true,
				] );
			} else {
				throw new \Exception( __( 'Could not delete template', 'voxel-backend' ), 102 );
			}
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

	protected function migrate_existing_post_type_base_templates_to_document_types() {
		$migration_key = 'voxel_post_type_base_document_types_migrated_v2';
		if ( get_option( $migration_key ) ) {
			return;
		}

		foreach ( \Voxel\Post_Type::get_voxel_types() as $post_type ) {
			$templates = $post_type->get_templates();
			$card_template_id = absint( $templates['card'] ?? 0 );
			$single_template_id = absint( $templates['single'] ?? 0 );
			$archive_template_id = absint( $templates['archive'] ?? 0 );
			if ( $card_template_id ) {
				$this->set_elementor_template_type( $card_template_id, 'card' );
			}
			if ( $single_template_id ) {
				$this->set_elementor_template_type( $single_template_id, 'single-post', 'single' );
			}
			if ( $archive_template_id ) {
				$this->set_elementor_template_type( $archive_template_id, 'archive', 'archive' );
			}
		}

		update_option( $migration_key, 1, true );
	}

	protected function sync_post_type_base_template_types_and_titles() {
		foreach ( \Voxel\Post_Type::get_voxel_types() as $post_type ) {
			$post_type_label = method_exists( $post_type, 'get_label' )
				? $post_type->get_label()
				: ucfirst( $post_type->get_key() );
			$templates = $post_type->get_templates();
			$map = [
				'single' => [ 'type' => 'single-post', 'location' => 'single', 'label' => 'Single post' ],
				'card' => [ 'type' => 'card', 'location' => '', 'label' => 'Preview card' ],
				'archive' => [ 'type' => 'archive', 'location' => 'archive', 'label' => 'Archive' ],
			];

			foreach ( $map as $template_key => $config ) {
				$template_id = absint( $templates[ $template_key ] ?? 0 );
				if ( ! $template_id ) {
					continue;
				}

				$this->set_elementor_template_type( $template_id, $config['type'], $config['location'] );

				$post = get_post( $template_id );
				if ( ! ( $post && $post->post_type === 'elementor_library' ) ) {
					continue;
				}

				$expected_title = sprintf( '%s: %s', $post_type_label, $config['label'] );
				if ( $post->post_title !== $expected_title ) {
					wp_update_post( [
						'ID' => $template_id,
						'post_title' => $expected_title,
					] );
				}
			}
		}

		// Hard fallback for imported legacy base-template titles.
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
			if ( ! preg_match( '/^post type:\s*([a-z0-9_]+)\s*\|\s*template:\s*(single|card|archive)$/i', $title, $matches ) ) {
				continue;
			}

			$post_type_key = sanitize_key( $matches[1] );
			$template_key = sanitize_key( $matches[2] );
			$post_type = \Voxel\Post_Type::get( $post_type_key );
			if ( ! $post_type ) {
				continue;
			}

			$template_map = [
				'single' => [ 'type' => 'single-post', 'location' => 'single', 'label' => 'Single post' ],
				'card' => [ 'type' => 'card', 'location' => '', 'label' => 'Preview card' ],
				'archive' => [ 'type' => 'archive', 'location' => 'archive', 'label' => 'Archive' ],
			];
			if ( ! isset( $template_map[ $template_key ] ) ) {
				continue;
			}

			$config = $template_map[ $template_key ];
			$this->set_elementor_template_type( $template_id, $config['type'], $config['location'] );

			$post_type_label = method_exists( $post_type, 'get_label' )
				? $post_type->get_label()
				: ucfirst( $post_type_key );
			$expected_title = sprintf( '%s: %s', $post_type_label, $config['label'] );
			if ( $title !== $expected_title ) {
				wp_update_post( [
					'ID' => $template_id,
					'post_title' => $expected_title,
				] );
			}
		}
	}
}
