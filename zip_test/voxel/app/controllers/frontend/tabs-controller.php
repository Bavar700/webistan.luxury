<?php

namespace Voxel\Controllers\Frontend;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Tabs_Controller extends \Voxel\Controllers\Base_Controller {

	protected function hooks() {
		$this->on( 'voxel_ajax_tabs.load', '@load_tab' );
		$this->on( 'voxel_ajax_nopriv_tabs.load', '@load_tab' );
	}

	protected function load_tab() {
		try {
			$template_id = $_GET['template_id'] ?? null;
			$post_id = $_GET['post_id'] ?? null;
			$widget_id = $_GET['widget_id'] ?? null;
			$tab_key = $_GET['tab'] ?? null;

			// check if widget exists
			$allowed_widgets = \Voxel\get_custom_page_settings( $template_id )['template_tabs'] ?? [];
			if ( ! isset( $allowed_widgets[ $widget_id ] ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel' ), 90 );
			}

			// check if post exists
			$post = \Voxel\Post::get( $post_id );
			if ( ! ( $post && $post->post_type && $post->is_viewable_by_current_user() ) ) {
				throw new \Exception( __( 'Invalid request.', 'voxel' ), 91 );
			}

			\Voxel\set_current_post( $post );

			// check if template exists
			$doc = \Elementor\Plugin::$instance->documents->get( $template_id );
			if ( ! $doc ) {
				throw new \Exception( __( 'Invalid request.', 'voxel' ), 92 );
			}

			// evaluate document visibility rules
			$behavior = \Voxel\get_page_setting( '_voxel_visibility_behavior', $template_id );
			$rules = \Voxel\get_page_setting( '_voxel_visibility_rules', $template_id );
			if ( is_array( $rules ) && ! empty( $rules ) ) {
				$rules_passed = \Voxel\evaluate_visibility_rules( $rules );
				if ( $behavior === 'hide' ) {
					$should_render = $rules_passed ? false : true;
				} else {
					$should_render = $rules_passed ? true : false;
				}

				if ( ! $should_render ) {
					throw new \Exception( __( 'Access denied.', 'voxel' ), 93 );
				}
			}

			// if this is a custom single post template, evaluate visibility rules configured in the post type editor
			foreach ( $post->post_type->templates->get_custom_templates()['single_post'] as $single_post_template ) {
				if ( $single_post_template['id'] === (int) $template_id ) {
					$rules = $single_post_template['visibility_rules'];
					if ( is_array( $rules ) && ! empty( $rules ) ) {
						if ( ! \Voxel\evaluate_visibility_rules( $rules ) ) {
							throw new \Exception( __( 'Access denied.', 'voxel' ), 101 );
						}
					}
				}
			}

			// find widget in template
			$widget = null;
			$data = $doc->get_elements_data();
			$path = explode( '.', $allowed_widgets[ $widget_id ] );

			while ( ! empty( $path ) ) {
				$index = array_shift( $path );
				if ( ! isset( $data[ $index ] ) ) {
					break;
				}

				// evaluate element visibility rules
				$behavior = $data[ $index ]['settings']['_voxel_visibility_behavior'] ?? null;
				$rules = $data[ $index ]['settings']['_voxel_visibility_rules'] ?? null;
				if ( is_array( $rules ) && ! empty( $rules ) ) {
					$rules_passed = \Voxel\evaluate_visibility_rules( $rules );
					if ( $behavior === 'hide' ) {
						$should_render = $rules_passed ? false : true;
					} else {
						$should_render = $rules_passed ? true : false;
					}

					if ( ! $should_render ) {
						throw new \Exception( __( 'Access denied.', 'voxel' ), 94 );
					}
				}

				if ( empty( $path ) && $data[ $index ]['elType'] === 'widget' && $data[ $index ]['widgetType'] === 'ts-template-tabs' ) {
					$widget = $data[ $index ];
					break;
				}

				$data = $data[ $index ]['elements'];
			}

			if ( ! $widget ) {
				throw new \Exception( __( 'Invalid request.', 'voxel' ), 95 );
			}

			$tabs = (array) ( $widget['settings']['ts_tabs'] ?? [] );
			$tab = null;

			foreach ( $tabs as $t ) {
				if ( ( $t['url_key'] ?? '' ) === $tab_key ) {
					$tab = $t;
					break;
				}
			}

			if ( ! $tab ) {
				throw new \Exception( __( 'Invalid request.', 'voxel' ), 96 );
			}

			// evaluate tab visibility rules
			$behavior = $tab['_voxel_visibility_behavior'] ?? null;
			$rules = $tab['_voxel_visibility_rules'] ?? null;
			if ( is_array( $rules ) && ! empty( $rules ) ) {
				$rules_passed = \Voxel\evaluate_visibility_rules( $rules );
				if ( $behavior === 'hide' ) {
					$should_render = $rules_passed ? false : true;
				} else {
					$should_render = $rules_passed ? true : false;
				}

				if ( ! $should_render ) {
					throw new \Exception( __( 'Access denied.', 'voxel' ), 97 );
				}
			}

			// ensure lazy loading attributes are added even during AJAX requests
			add_filter( 'wp_lazy_loading_enabled', '__return_true', 196 );

			do_action( 'voxel/before_render_tab_template' );

			$rendered_template = \Voxel\render_template_with_context( \Voxel\render( $tab['template_id'] ?? null ), [
				'mode' => 'fragment',
				'sanitize_styles' => true,
				'register_frontend_styles' => true,
			] );

			ob_start();
			foreach ( wp_scripts()->queue as $handle ) {
				wp_scripts()->do_item( $handle );
			}
			$scripts = ob_get_clean();

			$markup = sprintf( '<div class="tab-wrapper">%s</div>', $rendered_template['markup'] );

			// remove lazy loading filter after rendering
			remove_filter( 'wp_lazy_loading_enabled', '__return_true', 196 );

			echo $rendered_template['styles'];
			echo $markup;
			echo $scripts;
			exit;
		} catch ( \Exception $e ) {
			return wp_send_json( [
				'success' => false,
				'message' => $e->getMessage(),
				'code' => $e->getCode(),
			] );
		}
	}
}
