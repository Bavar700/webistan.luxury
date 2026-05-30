<?php

namespace Voxel\Modules\Elementor\Atomic_Vx;

use \Elementor\Modules\AtomicWidgets\PropTypes\Base\Plain_Prop_Type;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Vx_Visibility_Prop_Type extends Plain_Prop_Type {

	static $KIND = 'vx-visibility';

	public static function get_key(): string {
		return 'vx-visibility';
	}

	protected function validate_value( $value ): bool {
		return is_array( $value )
			&& isset( $value['behavior'] )
			&& in_array( $value['behavior'], [ 'show', 'hide' ], true );
	}

	protected function sanitize_value( $value ) {
		return [
			'behavior' => $value['behavior'] ?? 'show',
			'rules' => is_array( $value['rules'] ?? null ) ? $value['rules'] : [],
		];
	}
}
