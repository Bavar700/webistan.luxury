<?php

namespace Voxel\Modules\Elementor\Controllers;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Dynamic_Css_Controller extends \Voxel\Controllers\Base_Controller {

	protected $pending_attrs = [];
	protected $pending_css = [];
	protected $pending_meta = [];
	private $styling_rendered = [];

	protected function hooks() {
		$this->on( 'elementor/element/common/_section_style/after_section_end', '@register_settings', 110 );
		$this->on( 'elementor/element/section/section_advanced/after_section_end', '@register_settings', 110 );
		$this->on( 'elementor/element/column/section_advanced/after_section_end', '@register_settings', 110 );
		$this->on( 'elementor/element/container/section_layout/after_section_end', '@register_settings', 110 );

		$this->on( 'elementor/frontend/before_render', '@render_dynamic_styling' );
		$this->on( 'elementor/widget/before_render_content', '@render_widget_dynamic_styling' );
		$this->on( 'elementor/widget/render_content', '@inject_pending_widget_data', 10, 2 );

		$this->on( 'wp_ajax_voxel_resolve_dcss', '@ajax_resolve_dcss' );
		$this->filter( 'voxel/js/elementor-editor-config', '@add_dcss_editor_config' );
	}

	public function add_dcss_editor_config( $config ) {
		$config['dcss_nonce'] = wp_create_nonce( 'voxel_dcss' );
		return $config;
	}

	protected function ajax_resolve_dcss() {
		check_ajax_referer( 'voxel_dcss', '_wpnonce' );

		if ( ! current_user_can( 'edit_posts' ) ) {
			wp_send_json_error();
		}

		$template_id = absint( $_POST['template_id'] ?? 0 );
		if ( $template_id ) {
			\Voxel\set_current_post( \Voxel\get_post_for_preview( $template_id ) );
		}

		$fields = $_POST['fields'] ?? [];
		if ( ! is_array( $fields ) ) {
			wp_send_json_error();
		}

		$resolved = [];
		foreach ( $fields as $key => $value ) {
			$key = sanitize_text_field( $key );
			if ( is_string( $value ) && strncmp( $value, '@tags()', 7 ) === 0 ) {
				$resolved[ $key ] = \Voxel\render( $value );
			} else {
				$resolved[ $key ] = sanitize_text_field( $value );
			}
		}

		wp_send_json_success( $resolved );
	}

	protected function render_widget_dynamic_styling( $widget ) {
		if ( isset( $this->styling_rendered[ $widget->get_id() ] ) ) {
			return;
		}

		$id = $widget->get_id();
		$this->pending_meta[ $id ] = [ 'classes' => [], 'attrs' => [] ];

		$this->render_dynamic_styling( $widget );

		if ( ! empty( $this->pending_css[ $id ] ) ) {
			$this->pending_css[ $id ]['inject_class'] = true;
		}
	}

	protected function register_settings( $element ) {
		$element->start_controls_section( '_voxel_dynamic_css_section', [
			'label' => __( 'Dynamic styles', 'voxel-backend' ),
			'tab' => 'tab_voxel',
		] );

		$element->add_control( '_voxel_dynamic_class', [
			'label' => __( 'Dynamic class', 'voxel-backend' ),
			'type' => \Elementor\Controls_Manager::TEXT,
			'label_block' => true,
			'render_type' => 'template',
		] );

		$element->add_control( '_voxel_dynamic_css', [
			'label' => __( 'Dynamic CSS', 'voxel-backend' ),
			'type' => \Elementor\Controls_Manager::CODE,
			'language' => 'css',
			'label_block' => true,
			'description' => __( 'Use <code>selector</code> to target this element.', 'voxel-backend' ),
			'render_type' => 'template',
		] );

		$repeater = new \Elementor\Repeater();
		$repeater->add_control( 'attr_key', [
			'label' => __( 'Key', 'voxel-backend' ),
			'type' => \Elementor\Controls_Manager::TEXT,
			'placeholder' => 'data-post-id',
		] );
		$repeater->add_control( 'attr_value', [
			'label' => __( 'Value', 'voxel-backend' ),
			'type' => \Elementor\Controls_Manager::TEXT,
			'placeholder' => '',
		] );

		$element->add_control( '_voxel_dynamic_attrs', [
			'label' => __( 'Dynamic attributes', 'voxel-backend' ),
			'type' => \Elementor\Controls_Manager::REPEATER,
			'fields' => $repeater->get_controls(),
			'prevent_empty' => false,
			'title_field' => '{{{ attr_key }}}',
			'render_type' => 'template',
			'_disable_loop' => true,
			'_disable_visibility_rules' => true,
		] );

		$element->end_controls_section();
	}

	private function get_dynamic_css_settings( $element ) {
		$vx = $element->get_settings( '_vx_dynamic_css' );
		if ( is_array( $vx ) && isset( $vx['$$type'] ) ) {
			$val = $vx['value'] ?? [];
			$class_val = $val['dynamic_class'] ?? '';
			$css_val = $val['dynamic_css'] ?? '';
			if ( is_string( $class_val ) && strncmp( $class_val, '@tags()', 7 ) === 0 ) {
				$class_val = \Voxel\render( $class_val );
			}
			if ( is_string( $css_val ) && strncmp( $css_val, '@tags()', 7 ) === 0 ) {
				$css_val = \Voxel\render( $css_val );
			}

			$attrs = [];
			if ( isset( $val['dynamic_attrs'] ) && is_array( $val['dynamic_attrs'] ) ) {
				foreach ( $val['dynamic_attrs'] as $row ) {
					if ( ! is_array( $row ) || empty( $row['key'] ) ) {
						continue;
					}
					$attr_value = $row['value'] ?? '';
					if ( is_string( $attr_value ) && strncmp( $attr_value, '@tags()', 7 ) === 0 ) {
						$attr_value = \Voxel\render( $attr_value );
					}
					$attrs[] = [ 'key' => $row['key'], 'value' => $attr_value ];
				}
			}

			return [ 'class' => $class_val, 'css' => $css_val, 'attrs' => $attrs ];
		}

		$attrs = [];
		$rows = $element->get_settings( '_voxel_dynamic_attrs' );
		if ( is_array( $rows ) ) {
			foreach ( $rows as $row ) {
				if ( ! is_array( $row ) || empty( $row['attr_key'] ) ) {
					continue;
				}
				$attr_value = $row['attr_value'] ?? '';
				if ( is_string( $attr_value ) && strncmp( $attr_value, '@tags()', 7 ) === 0 ) {
					$attr_value = \Voxel\render( $attr_value );
				}
				$attrs[] = [ 'key' => $row['attr_key'], 'value' => $attr_value ];
			}
		}

		return [
			'class' => $element->get_settings( '_voxel_dynamic_class' ) ?: '',
			'css' => $element->get_settings( '_voxel_dynamic_css' ) ?: '',
			'attrs' => $attrs,
		];
	}

	private function get_loop_tag( $element ) {
		$vx = $element->get_settings( '_vx_loop' );
		if ( is_array( $vx ) && isset( $vx['$$type'] ) ) {
			return $vx['value']['tag'] ?? '';
		}

		return $element->get_settings( '_voxel_loop' ) ?: '';
	}

	protected function render_dynamic_styling( $element ) {
		if ( $element instanceof \Elementor\Modules\AtomicWidgets\Elements\Base\Atomic_Widget_Base ) {
			$loop_tag = $this->get_loop_tag( $element );
			if ( ! empty( $loop_tag ) && ! \Voxel\Dynamic_Data\Looper::is_running( $loop_tag ) ) {
				return;
			}
		}

		if ( $element instanceof \Elementor\Widget_Base ) {
			$this->styling_rendered[ $element->get_id() ] = true;
		}

		$settings = $this->get_dynamic_css_settings( $element );

		$dynamic_class = $settings['class'];
		if ( ! empty( $dynamic_class ) && is_string( $dynamic_class ) ) {
			$classes = array_filter( array_map( 'sanitize_html_class', explode( ' ', $dynamic_class ) ) );
			foreach ( $classes as $class ) {
				$this->add_class_to_element( $element, $class );
			}
			if ( isset( $this->pending_meta[ $element->get_id() ] ) ) {
				$this->pending_meta[ $element->get_id() ]['classes'] = array_values( $classes );
			}
		}

		$css = $settings['css'];
		if ( ! empty( $css ) && is_string( $css ) ) {
			$unique_id = 'vxcss-' . \Voxel\random_string( 6 ) . '-'. wp_unique_id();
			$this->add_class_to_element( $element, $unique_id );
			$css = str_replace( 'selector', '.' . $unique_id, $css );
			$style_tag = sprintf( '<style>%s</style>', wp_strip_all_tags( $css ) );

			if ( $element instanceof \Elementor\Widget_Base ) {
				$this->pending_css[ $element->get_id() ] = [
					'style' => $style_tag,
					'class' => $unique_id,
				];
			} else {
				echo $style_tag;
			}
		}

		if ( ! empty( $settings['attrs'] ) ) {
			$this->apply_dynamic_attrs( $element, $settings['attrs'] );
		}
	}

	private function apply_dynamic_attrs( $element, array $attrs ) {
		$pairs = [];
		foreach ( $attrs as $row ) {
			$key = sanitize_key( $row['key'] ?? '' );
			if ( $key === '' ) {
				continue;
			}
			$value = esc_attr( (string) ( $row['value'] ?? '' ) );
			$pairs[] = $key . '="' . $value . '"';
		}

		if ( empty( $pairs ) ) {
			return;
		}

		if ( $element instanceof \Elementor\Modules\AtomicWidgets\Elements\Base\Atomic_Widget_Base ) {
			$this->pending_attrs[ $element->get_id() ] = implode( ' ', $pairs );
		} else {
			$meta_attrs = [];
			foreach ( $attrs as $row ) {
				$key = sanitize_key( $row['key'] ?? '' );
				if ( $key === '' ) {
					continue;
				}
				$element->add_render_attribute( '_wrapper', $key, (string) ( $row['value'] ?? '' ) );
				$meta_attrs[] = [ 'key' => $key, 'value' => (string) ( $row['value'] ?? '' ) ];
			}
			if ( isset( $this->pending_meta[ $element->get_id() ] ) ) {
				$this->pending_meta[ $element->get_id() ]['attrs'] = $meta_attrs;
			}
		}
	}

	protected function inject_pending_widget_data( $content, $widget ) {
		$id = $widget->get_id();
		unset( $this->styling_rendered[ $id ] );

		if ( ! empty( $this->pending_css[ $id ] ) ) {
			$data = $this->pending_css[ $id ];
			unset( $this->pending_css[ $id ] );

			if ( ! empty( $data['inject_class'] ) ) {
				$style = str_replace(
					'.' . $data['class'],
					'.elementor-element-' . $id,
					$data['style']
				);
			} else {
				$style = $data['style'];
			}

			$content = $style . $content;
		}

		if ( ! empty( $this->pending_attrs[ $id ] ) ) {
			$attrs = $this->pending_attrs[ $id ];
			unset( $this->pending_attrs[ $id ] );
			$content = preg_replace( '/^(<[a-zA-Z][a-zA-Z0-9-]*)([\s>])/', '$1 ' . $attrs . '$2', ltrim( $content ), 1 );
		}

		if ( isset( $this->pending_meta[ $id ] ) ) {
			$meta = $this->pending_meta[ $id ];
			unset( $this->pending_meta[ $id ] );
			$content = sprintf(
				'<span class="vx-dynamic-meta" data-classes="%s" data-attrs="%s" style="display:none!important"></span>',
				esc_attr( wp_json_encode( $meta['classes'] ) ),
				esc_attr( wp_json_encode( $meta['attrs'] ) )
			) . $content;
		}

		return $content;
	}

	private function add_class_to_element( $element, string $class ) {
		if ( $element instanceof \Elementor\Modules\AtomicWidgets\Elements\Base\Atomic_Widget_Base ) {
			$classes = $element->get_settings( 'classes' );
			if ( ! is_array( $classes ) || ! isset( $classes['$$type'] ) ) {
				$classes = [ '$$type' => 'classes', 'value' => [ $class ] ];
			} else {
				$classes['value'][] = $class;
			}
			$element->set_settings( 'classes', $classes );
		} else {
			$element->add_render_attribute( '_wrapper', 'class', $class );
		}
	}
}
