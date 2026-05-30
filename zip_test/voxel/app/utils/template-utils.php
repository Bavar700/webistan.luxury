<?php

namespace Voxel;

if ( ! defined('ABSPATH') ) {
	exit;
}

function create_template( $title, $template_type = 'page' ) {
	$template_id = wp_insert_post( [
		'post_type' => 'elementor_library',
		'post_status' => 'publish',
		'post_title' => $title,
		'meta_input' => [
			'_elementor_edit_mode' => 'builder',
			'_elementor_template_type' => $template_type,
		],
	] );

	if ( ! is_wp_error( $template_id ) ) {
		if ( ! term_exists( 'voxel-template', 'elementor_library_category' ) ) {
			wp_insert_term( 'Voxel Template', 'elementor_library_category', [
				'slug' => 'voxel-template',
			] );
		}

		wp_set_object_terms( $template_id, 'voxel-template', 'elementor_library_category' );
		wp_set_object_terms( $template_id, $template_type, 'elementor_library_type' );
	}

	return $template_id;
}

function template_exists( $template_id ) {
	return is_int( $template_id ) && get_post_type( $template_id ) === 'elementor_library' && get_post_status( $template_id ) !== 'trash';
}

function create_page( $title, $slug = '' ) {
	return wp_insert_post( [
		'post_type' => 'page',
		'post_status' => 'publish',
		'post_title' => $title,
		'post_name' => $slug,
		'meta_input' => [
			'_elementor_edit_mode' => 'builder',
		],
	] );
}

function page_exists( $page_id ) {
	return is_int( $page_id ) && get_post_type( $page_id ) === 'page' && get_post_status( $page_id ) !== 'trash';
}

function begin_nested_template_render() {
	$depth = absint( $GLOBALS['vx_nested_template_render_depth'] ?? 0 );
	$GLOBALS['vx_nested_template_render_depth'] = $depth + 1;
}

function end_nested_template_render() {
	$depth = absint( $GLOBALS['vx_nested_template_render_depth'] ?? 0 );
	$GLOBALS['vx_nested_template_render_depth'] = $depth > 0 ? $depth - 1 : 0;
}

function is_nested_template_render(): bool {
	return absint( $GLOBALS['vx_nested_template_render_depth'] ?? 0 ) > 0;
}

function capture_style_state(): array {
	$styles = wp_styles();

	return [
		'queue' => is_array( $styles->queue ?? null ) ? $styles->queue : [],
		'done' => is_array( $styles->done ?? null ) ? $styles->done : [],
	];
}

function get_new_style_handles_since( array $styles_before ): array {
	$styles = wp_styles();

	$queue_before_render = is_array( $styles_before['queue'] ?? null ) ? $styles_before['queue'] : [];
	$done_before_render = is_array( $styles_before['done'] ?? null ) ? $styles_before['done'] : [];
	$queue_after_render = is_array( $styles->queue ?? null ) ? $styles->queue : [];
	$done_after_render = is_array( $styles->done ?? null ) ? $styles->done : [];

	return array_values( array_filter(
		$queue_after_render,
		static function( $handle ) use ( $queue_before_render, $done_before_render, $done_after_render ) {
			return is_string( $handle )
				&& ! in_array( $handle, $queue_before_render, true )
				&& ! in_array( $handle, $done_before_render, true )
				&& ! in_array( $handle, $done_after_render, true );
		}
	) );
}

function is_disallowed_nested_style_handle( string $handle ): bool {
	$disallowed = apply_filters( 'voxel/elementor/nested-disallowed-style-handles', [
		'base-desktop',
		'base-tablet',
		'base-mobile',
		'elementor-frontend',
	] );

	if ( ! is_array( $disallowed ) ) {
		return false;
	}

	return in_array( $handle, array_values( array_filter( $disallowed, 'is_string' ) ), true );
}

function filter_nested_style_handles( array $handles ): array {
	return array_values( array_unique( array_values( array_filter(
		$handles,
		static function( $handle ) {
			return is_string( $handle )
				&& $handle !== ''
				&& ! \Voxel\is_disallowed_nested_style_handle( $handle );
		}
	) ) ) );
}

function get_nested_style_handles_since( array $styles_before ): array {
	return \Voxel\filter_nested_style_handles( \Voxel\get_new_style_handles_since( $styles_before ) );
}

function get_markup_attribute_value( string $markup, string $attribute ): string {
	$pattern = sprintf(
		"/\\b%s\\s*=\\s*(?:\"([^\"]*)\"|'([^']*)'|([^\\s>\"']+))/i",
		preg_quote( $attribute, '/' )
	);

	if ( ! preg_match( $pattern, $markup, $matches ) ) {
		return '';
	}

	foreach ( [ 1, 2, 3 ] as $index ) {
		if ( isset( $matches[ $index ] ) && $matches[ $index ] !== '' ) {
			return (string) html_entity_decode( $matches[ $index ], ENT_QUOTES );
		}
	}

	return '';
}

function is_disallowed_nested_style_id( string $style_id ): bool {
	$style_id = strtolower( trim( $style_id ) );
	if ( $style_id === '' ) {
		return false;
	}

	if ( strlen( $style_id ) > 4 && substr( $style_id, -4 ) === '-css' ) {
		$handle = substr( $style_id, 0, -4 );
		if ( $handle !== '' && \Voxel\is_disallowed_nested_style_handle( $handle ) ) {
			return true;
		}
	}

	if ( strlen( $style_id ) > 11 && substr( $style_id, -11 ) === '-inline-css' ) {
		$handle = substr( $style_id, 0, -11 );
		if ( $handle !== '' && \Voxel\is_disallowed_nested_style_handle( $handle ) ) {
			return true;
		}
	}

	return false;
}

function is_disallowed_nested_style_href( string $href ): bool {
	$href_path = strtolower( (string) parse_url( $href, PHP_URL_PATH ) );
	if ( $href_path === '' ) {
		return false;
	}

	if ( preg_match( '#/(base-desktop|base-tablet|base-mobile)(?:-[^/]+)?(?:\.min)?\.css$#', $href_path ) ) {
		return true;
	}

	if ( strpos( $href_path, '/elementor/' ) !== false && preg_match( '#/(custom-frontend|frontend)(?:-[^/]+)?(?:\.min)?\.css$#', $href_path ) ) {
		return true;
	}

	return false;
}

function sanitize_nested_style_markup( string $markup ): string {
	if ( $markup === '' ) {
		return '';
	}

	$markup = preg_replace_callback( '/<link\b[^>]*>/i', static function( $matches ) {
		$tag = $matches[0];
		$rel = strtolower( \Voxel\get_markup_attribute_value( $tag, 'rel' ) );
		if ( $rel === '' || strpos( $rel, 'stylesheet' ) === false ) {
			return $tag;
		}

		$style_id = \Voxel\get_markup_attribute_value( $tag, 'id' );
		$href = \Voxel\get_markup_attribute_value( $tag, 'href' );
		if ( \Voxel\is_disallowed_nested_style_id( $style_id ) || \Voxel\is_disallowed_nested_style_href( $href ) ) {
			return '';
		}

		return $tag;
	}, $markup );

	if ( ! is_string( $markup ) || $markup === '' ) {
		return '';
	}

	$markup = preg_replace_callback( '/<style\b[^>]*>.*?<\/style>/is', static function( $matches ) {
		$style_tag = $matches[0];
		$open_tag_end = strpos( $style_tag, '>' );
		if ( $open_tag_end === false ) {
			return $style_tag;
		}

		$open_tag = substr( $style_tag, 0, $open_tag_end + 1 );
		$style_id = \Voxel\get_markup_attribute_value( $open_tag, 'id' );
		if ( \Voxel\is_disallowed_nested_style_id( $style_id ) ) {
			return '';
		}

		return $style_tag;
	}, $markup );

	return is_string( $markup ) ? $markup : '';
}

function get_printed_style_markup( array $style_handles, bool $sanitize_nested_markup = false ): string {
	if ( empty( $style_handles ) ) {
		return '';
	}

	ob_start();
	wp_print_styles( $style_handles );
	$markup = (string) ob_get_clean();

	if ( $sanitize_nested_markup ) {
		$markup = \Voxel\sanitize_nested_style_markup( $markup );
	}

	return $markup;
}

function print_style_handles( array $style_handles, bool $sanitize_nested_markup = false ) {
	$markup = \Voxel\get_printed_style_markup( $style_handles, $sanitize_nested_markup );
	if ( $markup !== '' ) {
		echo $markup;
	}
}

function normalize_template_render_context( array $context = [] ): array {
	$mode = $context['mode'] ?? ( \Voxel\is_nested_template_render() ? 'embedded' : 'root' );
	if ( ! in_array( $mode, [ 'root', 'embedded', 'fragment' ], true ) ) {
		$mode = 'root';
	}

	$is_embedded = $mode !== 'root';
	$disable_builder_inline_css = array_key_exists( 'disable_builder_inline_css', $context )
		? (bool) $context['disable_builder_inline_css']
		: ( $is_embedded || \Voxel\is_edit_mode() );
	$print_styles = array_key_exists( 'print_styles', $context ) ? (bool) $context['print_styles'] : true;
	$defer_styles = ! empty( $context['defer_styles'] ) || ! $print_styles;

	return [
		'mode' => $mode,
		'is_embedded' => $is_embedded,
		'print_styles' => $print_styles,
		'defer_styles' => $defer_styles,
		'sanitize_styles' => array_key_exists( 'sanitize_styles', $context ) ? (bool) $context['sanitize_styles'] : $is_embedded,
		'disable_builder_inline_css' => $disable_builder_inline_css,
		'register_frontend_styles' => ! empty( $context['register_frontend_styles'] ),
		'allow_preview_css' => ! empty( $context['allow_preview_css'] ),
	];
}

function enqueue_style_handles( array $style_handles ) {
	foreach ( $style_handles as $style_handle ) {
		if ( ! is_string( $style_handle ) || $style_handle === '' ) {
			continue;
		}

		wp_enqueue_style( $style_handle );
	}
}

function get_template_asset_style_handles( int $template_id, bool $is_embedded ): array {
	if ( ! did_action( 'wp_enqueue_scripts' ) ) {
		return [];
	}

	$template_assets = get_post_meta( $template_id, '_elementor_page_assets', true );
	if ( ! is_array( $template_assets ) || version_compare( ELEMENTOR_VERSION, '3.24.0', '<' ) ) {
		return [];
	}

	$style_handles = is_array( $template_assets['styles'] ?? null ) ? $template_assets['styles'] : [];
	if ( $is_embedded ) {
		$style_handles = \Voxel\filter_nested_style_handles( $style_handles );
	}

	return array_values( array_filter( $style_handles, 'is_string' ) );
}

function collect_template_style_markup( int $template_id, array $context, array $styles_before_render ): string {
	$style_handles = [];
	$style_markup = '';
	$allow_preview_css = (bool) $context['allow_preview_css'];
	$defer_styles = (bool) $context['defer_styles'];

	if ( ! \Voxel\is_preview_mode() || $allow_preview_css ) {
		if ( $defer_styles ) {
			\Voxel\enqueue_template_css( $template_id );
		} elseif ( $context['is_embedded'] ) {
			$style_markup .= \Voxel\get_template_css_markup( $template_id );
		} else {
			\Voxel\enqueue_template_css( $template_id );
			$style_handles[] = sprintf( 'elementor-post-%d', $template_id );
		}

		$template_asset_styles = \Voxel\get_template_asset_style_handles( $template_id, $context['is_embedded'] );
		if ( $defer_styles ) {
			\Voxel\enqueue_style_handles( $template_asset_styles );
		} else {
			$style_handles = array_merge( $style_handles, $template_asset_styles );
		}
	}

	do_action( 'elementor/frontend/after_enqueue_post_styles' );

	if ( $defer_styles ) {
		return '';
	}

	$new_style_handles = \Voxel\get_new_style_handles_since( $styles_before_render );
	if ( $context['is_embedded'] ) {
		$new_style_handles = \Voxel\filter_nested_style_handles( $new_style_handles );
	}

	$style_handles = array_values( array_unique( array_merge( $style_handles, $new_style_handles ) ) );
	if ( ! empty( $style_handles ) ) {
		$style_markup .= \Voxel\get_printed_style_markup( $style_handles, (bool) $context['sanitize_styles'] );
	}

	if ( $context['sanitize_styles'] ) {
		$style_markup = \Voxel\sanitize_nested_style_markup( $style_markup );
	}

	return $style_markup;
}

function render_template_with_context( $template_id, array $context = [] ): array {
	if ( ! \Voxel\is_elementor_active() ) {
		return [
			'template_id' => 0,
			'styles' => '',
			'markup' => '',
		];
	}

	$template_id = absint( $template_id );
	if ( ! $template_id ) {
		return [
			'template_id' => 0,
			'styles' => '',
			'markup' => '',
		];
	}

	$context = \Voxel\normalize_template_render_context( $context );
	$styles_before_render = \Voxel\capture_style_state();
	if ( $context['register_frontend_styles'] ) {
		\Elementor\Plugin::$instance->frontend->register_styles();
	}

	\Voxel\register_elementor_template_for_asset_hooks( $template_id );

	$styles_markup = \Voxel\collect_template_style_markup( $template_id, $context, $styles_before_render );

	$frontend = \Elementor\Plugin::$instance->frontend;
	if ( $context['disable_builder_inline_css'] ) {
		add_filter( 'elementor/frontend/builder_content/before_print_css', '__return_false', 1150 );
	}

	$markup = $frontend->get_builder_content_for_display( $template_id );

	if ( $context['disable_builder_inline_css'] ) {
		remove_filter( 'elementor/frontend/builder_content/before_print_css', '__return_false', 1150 );
	}

	return [
		'template_id' => $template_id,
		'styles' => $context['print_styles'] ? $styles_markup : '',
		'markup' => is_string( $markup ) ? $markup : '',
	];
}

function print_template_legacy( $template_id ) {
	if ( ! \Voxel\is_elementor_active() ) {
		return;
	}

	$styles_before_render = \Voxel\capture_style_state();
	$is_nested_render = \Voxel\is_nested_template_render();

	\Voxel\register_elementor_template_for_asset_hooks( $template_id );

	if ( ! \Voxel\is_preview_mode() ) {
		if ( $is_nested_render ) {
			\Voxel\print_template_css( $template_id );
		} else {
			\Voxel\enqueue_template_css( $template_id );
			wp_print_styles( 'elementor-post-'.$template_id );
		}

		if ( did_action( 'wp_enqueue_scripts' ) ) {
			$template_assets = get_post_meta( $template_id, '_elementor_page_assets', true );
			if ( is_array( $template_assets['styles'] ?? null ) && version_compare( ELEMENTOR_VERSION, '3.24.0', '>=' ) ) {
				$template_asset_styles = $template_assets['styles'];
				if ( $is_nested_render ) {
					$template_asset_styles = \Voxel\filter_nested_style_handles( $template_asset_styles );
				}

				if ( ! empty( $template_asset_styles ) ) {
					\Voxel\print_style_handles( $template_asset_styles, $is_nested_render );
				}
			}
		}
	}

	do_action( 'elementor/frontend/after_enqueue_post_styles' );

	$new_style_handles = \Voxel\get_new_style_handles_since( $styles_before_render );

	if ( $is_nested_render ) {
		$new_style_handles = \Voxel\filter_nested_style_handles( $new_style_handles );
	}

	if ( ! empty( $new_style_handles ) ) {
		\Voxel\print_style_handles( $new_style_handles, $is_nested_render );
	}

	$frontend = \Elementor\Plugin::$instance->frontend;

	// fix incorrect rendering of templates in the editor
	if ( \Voxel\is_edit_mode() ) {
		if ( ! $is_nested_render ) {
			wp_styles()->do_item( 'elementor-post-'.$template_id );
		}
		add_filter( 'elementor/frontend/builder_content/before_print_css', '__return_false', 1150 );
		echo $frontend->get_builder_content_for_display( $template_id );

		remove_filter( 'elementor/frontend/builder_content/before_print_css', '__return_false', 1150 );
	} else {
		echo $frontend->get_builder_content_for_display( $template_id );
	}
}

function print_template( $template_id, array $context = [] ) {
	$use_new_pipeline = apply_filters( 'voxel/elementor/render-pipeline-v2', true ) !== false;
	if ( ! $use_new_pipeline ) {
		\Voxel\print_template_legacy( $template_id );
		return;
	}

	$rendered = \Voxel\render_template_with_context( $template_id, $context );
	if ( $rendered['styles'] !== '' ) {
		echo $rendered['styles'];
	}

	if ( $rendered['markup'] !== '' ) {
		echo $rendered['markup'];
	}
}

function get_template_css_markup( $template_id ): string {
	if ( ! \Voxel\is_elementor_active() ) {
		return '';
	}

	$template_id = \absint( $template_id );
	if ( ! $template_id ) {
		return '';
	}

	$document = \Elementor\Plugin::$instance->documents->get( $template_id );
	if ( ! $document || ! $document->is_built_with_elementor() ) {
		return '';
	}

	static $printed = [];
	if ( isset( $printed[ $template_id ] ) ) {
		return '';
	}

	$printed[ $template_id ] = true;

	$css_file = \Elementor\Core\Files\CSS\Post::create( $template_id );
	$css_status = (string) $css_file->get_meta( 'status' );

	if ( '' === $css_status ) {
		$css_file->update();
		$css_status = (string) $css_file->get_meta( 'status' );
	}

	$can_print_file_link = false;
	if ( \Elementor\Core\Files\CSS\Base::CSS_STATUS_FILE === $css_status ) {
		$css_path = $css_file->get_path();
		$can_print_file_link = is_string( $css_path ) && $css_path !== '' && file_exists( $css_path );

		if ( ! $can_print_file_link ) {
			$css_file->update();
			$css_status = (string) $css_file->get_meta( 'status' );
			$css_path = $css_file->get_path();
			$can_print_file_link = \Elementor\Core\Files\CSS\Base::CSS_STATUS_FILE === $css_status
				&& is_string( $css_path )
				&& $css_path !== ''
				&& file_exists( $css_path );
		}
	}

	if ( $can_print_file_link ) {
		return \sprintf(
			'<link rel="stylesheet" id="%1$s" href="%2$s" media="all">',
			\esc_attr( sprintf( 'elementor-post-%d-css', $template_id ) ),
			\esc_url( $css_file->get_url() )
		);
	}

	if ( \Elementor\Core\Files\CSS\Base::CSS_STATUS_EMPTY === $css_status ) {
		return '';
	}

	ob_start();
	$css_file->print_css();
	$markup = (string) ob_get_clean();

	add_action( 'wp_footer', function() use ( $template_id ) {
		wp_dequeue_style( sprintf( 'elementor-post-%d', $template_id ) );
	} );

	return $markup;
}

function print_template_css( $template_id ) {
	$markup = \Voxel\get_template_css_markup( $template_id );
	if ( $markup !== '' ) {
		echo $markup;
	}
}

/**
 * Notify Elementor that a Voxel template document will be rendered.
 *
 * Elementor registers `elementor/post/render` listeners (including atomic widget CSS)
 * before `elementor/frontend/after_enqueue_post_styles`. Core passes `get_the_ID()`,
 * which is the main-query post — not the Elementor template on Voxel singles, archives,
 * taxonomy, etc. Firing this with the template ID before `Frontend::enqueue_styles()`
 * ensures those pipelines run for the document that actually contains the layout.
 *
 * @since 1.0
 */
function register_elementor_template_for_asset_hooks( $template_id ) {
	if ( ! \Voxel\is_elementor_active() || ! $template_id ) {
		return;
	}

	do_action( 'elementor/post/render', absint( $template_id ) );
}

function enqueue_template_css( $template_id ) {
	if ( ! \Voxel\is_elementor_active() ) {
		return;
	}

	$template_assets = get_post_meta( $template_id, '_elementor_page_assets', true );
	if ( ! empty( $template_assets ) && version_compare( ELEMENTOR_VERSION, '3.24.0', '>=' ) ) {
		\Elementor\Plugin::$instance->assets_loader->enable_assets( $template_assets );
	}

	if ( ! wp_style_is( 'elementor-frontend', 'registered' ) ) {
		\Elementor\Plugin::$instance->frontend->register_styles();
	}

	$css_file = new \Elementor\Core\Files\CSS\Post( $template_id );
	$css_file->enqueue();
}

function get_page_setting( $setting_key, $post_id = null ) {
	if ( ! \Voxel\is_elementor_active() ) {
		return;
	}

	$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );
	$page_settings_model = $page_settings_manager->get_model( $post_id ?? get_the_ID() );
	return $page_settings_model->get_settings( $setting_key );
}

function get_template_link( $template, $fallback = null ) {
	if ( empty( $fallback ) ) {
		$fallback = home_url('/');
	}

	return get_permalink( \Voxel\get( 'templates.'.$template ) ) ?: $fallback;
}

function print_header() {
	if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'header' ) ) {
		return;
	}

	$template_id = \Voxel\resolve_template_for_location( 'header' );
	if ( \Voxel\template_exists( $template_id ) ) {
		\Voxel\print_template( $template_id, [
			'mode' => 'root',
		] );
	}
}

function print_footer() {
	if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'footer' ) ) {
		return;
	}

	$template_id = \Voxel\resolve_template_for_location( 'footer' );
	if ( \Voxel\template_exists( $template_id ) ) {
		\Voxel\print_template( $template_id, [
			'mode' => 'root',
		] );
	}
}

function resolve_template_for_location( string $type ) {
	$templates = \Voxel\get( 'custom_templates' );
	if ( empty( $templates[ $type ] ) ) {
		return \Voxel\get( sprintf( 'templates.%s', $type ) );
	}

	foreach ( $templates[ $type ] as $index => $template ) {
		if ( empty( $template['visibility_rules'] ) ) {
			continue;
		}

		$rules_passed = \Voxel\evaluate_visibility_rules( $template['visibility_rules'] );
		if ( $rules_passed ) {
			return $template['id'];
		}
	}

	return \Voxel\get( sprintf( 'templates.%s', $type ) );
}

function get_custom_page_settings( $post_id ) {
	return (array) json_decode( get_post_meta( $post_id, '_voxel_page_settings', true ), ARRAY_A );
}

function get_temporary_custom_page_settings( $post_id ) {
	$settings = (array) json_decode( get_post_meta( $post_id, '_voxel_page_settings_tmp', true ), ARRAY_A );
	return ! empty( $settings ) ? $settings : \Voxel\get_custom_page_settings( $post_id );
}

function get_related_widget( \Elementor\Widget_Base $widget, $document_id, $relation_key, $relation_side ) {
	$page_settings = \Voxel\is_elementor_ajax()
		? \Voxel\get_temporary_custom_page_settings( $document_id )
		: \Voxel\get_custom_page_settings( $document_id );
	$relations = $page_settings['relations'] ?? [];
	$relation_group = $relations[ $relation_key ] ?? [];
	$other_side = $relation_side === 'left' ? 'right' : 'left';
	$path_key = $other_side === 'right' ? 'rightPath' : 'leftPath';

	foreach ( $relation_group as $relation ) {
		if ( $relation[ $relation_side ] === $widget->get_id() ) {
			$data = \Elementor\Plugin::$instance->documents->get_current()->get_elements_data();
			$path = explode( '.', $relation[ $path_key ] ?? '' );

			while ( ! empty( $path ) ) {
				$index = array_shift( $path );
				if ( ! isset( $data[ $index ] ) ) {
					break;
				}

				if ( empty( $path ) && $data[ $index ]['elType'] === 'widget' ) {
					return $data[ $index ];
				}

				$data = $data[ $index ]['elements'];
			}
		}
	}

	return null;
}

function get_post_for_preview( $template_id ) {
	$post_type = \Voxel\get_post_type_for_preview( $template_id );

	$post = apply_filters( '_voxel/editor/get_post_for_preview', null, $template_id );
	if ( $post !== null ) {
		return $post;
	}

	if ( $post_type ) {
		$page_settings = (array) get_post_meta( $template_id, '_elementor_page_settings', true );
		$post_id = $page_settings['voxel_preview_post'] ?? null;
		if ( is_numeric( $post_id ) && ( $_post = get_post( $post_id ) ) ) {
			$post = $_post;
		} else {
			$post = current( get_posts( [
				'number' => 1,
				'status' => 'publish',
				'post_type' => $post_type->get_key(),
				'orderby' => 'date',
				'order' => 'ASC',
			] ) );
		}

		// if we're editing the preview card for a post type, pass that information to the
		// editor frontend so that we can adjust the editing layout
		$custom_card_templates = array_column( $post_type->templates->get_custom_templates()['card'], 'id' );
		if ( (int) $post_type->get_templates()['card'] === (int) $template_id || in_array( $template_id, $custom_card_templates ) ) {
			add_filter( 'voxel/js/elementor-editor-config', function( $config ) {
				$config['is_preview_card'] = true;
				return $config;
			} );
		}

		return \Voxel\Post::get( $post ) ?? \Voxel\Post::dummy( [ 'post_type' => $post_type->get_key() ] );
	} else {
		$custom_term_card_templates = array_column( \Voxel\get_custom_templates()['term_card'], 'id' );
		if ( in_array( $template_id, $custom_term_card_templates ) ) {
			add_filter( 'voxel/js/elementor-editor-config', function( $config ) {
				$config['is_preview_card'] = true;
				return $config;
			} );
		}

		return \Voxel\Post::get( $template_id );
	}
}

function get_post_type_for_preview( $template_id ) {
	return current( array_filter( \Voxel\Post_Type::get_all(), function( $post_type ) use ( $template_id ) {
		$templates = $post_type->get_templates();
		$custom_card_templates = array_column( $post_type->templates->get_custom_templates()['card'], 'id' );
		$custom_single_templates = array_column( $post_type->templates->get_custom_templates()['single'], 'id' );
		$custom_single_post_templates = array_column( $post_type->templates->get_custom_templates()['single_post'], 'id' );
		return (
			in_array( $template_id, [ $templates['single'], $templates['card'] ] )
			|| in_array( $template_id, $custom_card_templates )
			|| in_array( $template_id, $custom_single_templates )
			|| in_array( $template_id, $custom_single_post_templates )
		);
	} ) );
}

function get_base_templates(): array {
	return [
		/* General */
		[
			'category' => 'header',
			'label' => __( 'Default Header', 'voxel-backend' ),
			'key' => 'templates.header',
			'id' => \Voxel\get( 'templates.header' ),
			'image' => \Voxel\get_image('post-types/header.png'),
			'type' => 'template',
		],
		[
			'category' => 'footer',
			'label' => __( 'Default Footer', 'voxel-backend' ),
			'key' => 'templates.footer',
			'id' => \Voxel\get( 'templates.footer' ),
			'image' => \Voxel\get_image('post-types/footer.png'),
			'type' => 'template',
		],
		[
			'category' => 'social',
			'label' => __( 'Newsfeed', 'voxel-backend' ),
			'key' => 'templates.timeline',
			'id' => \Voxel\get( 'templates.timeline' ),
			'image' => \Voxel\get_image('post-types/timeline.png'),
			'type' => 'page',
		],
		[
			'category' => 'social',
			'label' => __( 'Inbox', 'voxel-backend' ),
			'key' => 'templates.inbox',
			'id' => \Voxel\get( 'templates.inbox' ),
			'image' => \Voxel\get_image('post-types/timeline.png'),
			'type' => 'page',
		],
		[
			'category' => 'general',
			'label' => __( 'Post statistics', 'voxel-backend' ),
			'key' => 'templates.post_stats',
			'id' => \Voxel\get( 'templates.post_stats' ),
			'image' => \Voxel\get_image('post-types/prvc.png'),
			'type' => 'page',
		],
		[
			'category' => 'general',
			'label' => __( 'Privacy Policy', 'voxel-backend' ),
			'key' => 'templates.privacy_policy',
			'id' => \Voxel\get( 'templates.privacy_policy' ),
			'image' => \Voxel\get_image('post-types/prvc.png'),
			'type' => 'page',
		],
		[
			'category' => 'general',
			'label' => __( 'Terms & Conditions', 'voxel-backend' ),
			'key' => 'templates.terms',
			'id' => \Voxel\get( 'templates.terms' ),
			'image' => \Voxel\get_image('post-types/prvc.png'),
			'type' => 'page',
		],
		[
			'category' => 'general',
			'label' => __( '404 Not Found', 'voxel-backend' ),
			'key' => 'templates.404',
			'id' => \Voxel\get( 'templates.404' ),
			'image' => \Voxel\get_image('post-types/404.png'),
			'type' => 'template',
		],
		[
			'category' => 'general',
			'label' => __( 'Restricted content', 'voxel-backend' ),
			'key' => 'templates.restricted',
			'id' => \Voxel\get( 'templates.restricted' ),
			'image' => \Voxel\get_image('post-types/restricted.png'),
			'type' => 'template',
		],

		/* Membership */
		[
			'category' => 'membership',
			'label' => __( 'Login & registration', 'voxel-backend' ),
			'key' => 'templates.auth',
			'id' => \Voxel\get( 'templates.auth' ),
			'image' => \Voxel\get_image('post-types/login.png'),
			'type' => 'page',
		],
		[
			'category' => 'membership',
			'label' => __( 'Current plan', 'voxel-backend' ),
			'key' => 'templates.current_plan',
			'id' => \Voxel\get( 'templates.current_plan' ),
			'image' => \Voxel\get_image('post-types/plans.png'),
			'type' => 'page',
		],

		/* Orders */
		[
			'category' => 'orders',
			'label' => __( 'Orders page', 'voxel-backend' ),
			'key' => 'templates.orders',
			'id' => \Voxel\get( 'templates.orders' ),
			'image' => \Voxel\get_image('post-types/orders.png'),
			'type' => 'page',
		],
		// [
		// 	'category' => 'orders',
		// 	'label' => __( 'Reservations page', 'voxel-backend' ),
		// 	'key' => 'templates.reservations',
		// 	'id' => \Voxel\get( 'templates.reservations' ),
		// 	'image' => \Voxel\get_image('post-types/orders.png'),
		// 	'type' => 'page',
		// ],
		[
			'category' => 'orders',
			'label' => __( 'Cart summary', 'voxel-backend' ),
			'key' => 'templates.checkout',
			'id' => \Voxel\get( 'templates.checkout' ),
			'image' => \Voxel\get_image('post-types/orders.png'),
			'type' => 'page',
		],
		[
			'category' => 'orders',
			'label' => __( 'Stripe Connect account', 'voxel-backend' ),
			'key' => 'templates.stripe_account',
			'id' => \Voxel\get( 'templates.stripe_account' ),
			'image' => \Voxel\get_image('post-types/orders.png'),
			'type' => 'page',
		],
		// [
		// 	'category' => 'orders',
		// 	'label' => __( 'Order tags: QR code handler', 'voxel-backend' ),
		// 	'key' => 'templates.qr_tags',
		// 	'id' => \Voxel\get( 'templates.qr_tags' ),
		// 	'image' => \Voxel\get_image('post-types/orders.png'),
		// 	'type' => 'page',
		// ],

		/* Style kits */
		[
			'category' => 'style_kits',
			'label' => __( 'Popup styles', 'voxel-backend' ),
			'key' => 'templates.kit_popups',
			'id' => \Voxel\get( 'templates.kit_popups' ),
			'image' => \Voxel\get_image('post-types/orders.png'),
			'type' => 'template',
		],
		[
			'category' => 'style_kits',
			'label' => __( 'Timeline styles', 'voxel-backend' ),
			'key' => 'templates.kit_timeline',
			'id' => \Voxel\get( 'templates.kit_timeline' ),
			'image' => \Voxel\get_image('post-types/orders.png'),
			'type' => 'template',
		],
	];
}

function get_custom_templates(): array {
	$groups = [
		'header' => [],
		'footer' => [],
		'term_single' => [],
		'term_card' => [],
	];

	$needs_resaving = false;

	foreach ( (array) ( \Voxel\get( 'custom_templates' ) ?? [] ) as $group => $templates ) {
		if ( ! isset( $groups[ $group ] ) ) {
			continue;
		}

		foreach ( (array) $templates as $template ) {
			if ( isset( $template['id'], $template['label'] ) && is_numeric( $template['id'] ) ) {
				$template_config = [
					'label' => $template['label'],
					'id' => absint( $template['id'] ),
					'unique_key' => $template['unique_key'] ?? null,
				];

				if ( in_array( $group, [ 'header', 'footer', 'term_single' ], true ) ) {
					$template_config['visibility_rules'] = is_array( $template['visibility_rules'] ?? null ) ? $template['visibility_rules'] : [];
				}

				if ( empty( $template_config['unique_key'] ) ) {
					$template_config['unique_key'] = strtolower( \Voxel\random_string(8) );
					$needs_resaving = true;
				}

				$groups[ $group ][] = $template_config;
			}
		}
	}

	if ( $needs_resaving ) {
		\Voxel\set( 'custom_templates', $groups );
	}

	return $groups;
}
