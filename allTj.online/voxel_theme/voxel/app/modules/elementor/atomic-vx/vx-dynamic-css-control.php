<?php

namespace Voxel\Modules\Elementor\Atomic_Vx;

use \Elementor\Modules\AtomicWidgets\Controls\Base\Atomic_Control_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Vx_Dynamic_Css_Control extends Atomic_Control_Base {

	public function get_type(): string {
		return 'voxel-dynamic-css-v4';
	}

	public function get_props(): array {
		return [];
	}
}
