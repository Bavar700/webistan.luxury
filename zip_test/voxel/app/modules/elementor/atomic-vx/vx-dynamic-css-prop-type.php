<?php

namespace Voxel\Modules\Elementor\Atomic_Vx;

use \Elementor\Modules\AtomicWidgets\PropTypes\Base\Plain_Prop_Type;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Vx_Dynamic_Css_Prop_Type extends Plain_Prop_Type {

	static $KIND = 'vx-dynamic-css';

	public static function get_key(): string {
		return 'vx-dynamic-css';
	}

	protected function validate_value( $value ): bool {
		return is_array( $value )
			&& ( isset( $value['dynamic_class'] ) || isset( $value['dynamic_css'] ) || isset( $value['dynamic_attrs'] ) );
	}

	protected function sanitize_value( $value ) {
		$attrs = [];
		if ( isset( $value['dynamic_attrs'] ) && is_array( $value['dynamic_attrs'] ) ) {
			foreach ( $value['dynamic_attrs'] as $row ) {
				if ( is_array( $row ) && ! empty( $row['key'] ) && is_string( $row['key'] ) ) {
					$attrs[] = [
						'key' => \sanitize_text_field( $row['key'] ),
						'value' => \sanitize_text_field( $row['value'] ?? '' ),
					];
				}
			}
		}

		return [
			'dynamic_class' => \sanitize_text_field( $value['dynamic_class'] ?? '' ),
			'dynamic_css' => \wp_strip_all_tags( $value['dynamic_css'] ?? '' ),
			'dynamic_attrs' => $attrs,
		];
	}
}
