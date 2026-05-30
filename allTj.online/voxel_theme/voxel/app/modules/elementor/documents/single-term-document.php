<?php

namespace Voxel\Modules\Elementor\Documents;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Single_Term_Document extends \Elementor\Modules\Library\Documents\Section {

	public static function get_type() {
		return 'single-term';
	}

	public static function get_title() {
		return esc_html__( 'Single Term (VX)', 'voxel-backend' );
	}

	public static function get_plural_title() {
		return esc_html__( 'Single Terms (VX)', 'voxel-backend' );
	}
}
