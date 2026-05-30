<?php

namespace Voxel\Modules\Elementor\Atomic_Vx;

use \Elementor\Modules\AtomicWidgets\PropTypes\Base\Plain_Prop_Type;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Vx_Loop_Prop_Type extends Plain_Prop_Type {

	static $KIND = 'vx-loop';

	public static function get_key(): string {
		return 'vx-loop';
	}

	protected function validate_value( $value ): bool {
		return is_array( $value )
			&& isset( $value['tag'] )
			&& is_string( $value['tag'] );
	}

	protected function sanitize_value( $value ) {
		return [
			'tag' => \sanitize_text_field( $value['tag'] ?? '' ),
			'limit' => isset( $value['limit'] ) && is_numeric( $value['limit'] ) ? (int) $value['limit'] : null,
			'offset' => isset( $value['offset'] ) && is_numeric( $value['offset'] ) ? (int) $value['offset'] : null,
		];
	}
}
