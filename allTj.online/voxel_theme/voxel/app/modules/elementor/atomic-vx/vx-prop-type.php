<?php

namespace Voxel\Modules\Elementor\Atomic_Vx;

use \Elementor\Modules\AtomicWidgets\PropTypes\Base\Plain_Prop_Type;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Vx_Prop_Type extends Plain_Prop_Type {

	static $KIND = 'vx';

	public static function get_key(): string {
		return 'vx';
	}

	protected function validate_value( $value ): bool {
		return is_string( $value );
	}

	protected function sanitize_value( $value ) {
		return is_string( $value ) ? $value : '';
	}
}
