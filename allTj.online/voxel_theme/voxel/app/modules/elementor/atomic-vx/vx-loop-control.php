<?php

namespace Voxel\Modules\Elementor\Atomic_Vx;

use \Elementor\Modules\AtomicWidgets\Controls\Base\Atomic_Control_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Vx_Loop_Control extends Atomic_Control_Base {

	public function get_type(): string {
		return 'voxel-loop-v4';
	}

	public function get_props(): array {
		return [];
	}
}
