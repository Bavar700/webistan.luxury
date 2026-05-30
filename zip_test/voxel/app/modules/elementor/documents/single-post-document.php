<?php

namespace Voxel\Modules\Elementor\Documents;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Single_Post_Document extends \Elementor\Modules\Library\Documents\Section {

	public static function get_type() {
		return 'single-post';
	}

	public static function get_title() {
		return esc_html__( 'Single post (VX)', 'voxel-backend' );
	}

	public static function get_plural_title() {
		return esc_html__( 'Single posts (VX)', 'voxel-backend' );
	}
}
