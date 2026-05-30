<?php

namespace Voxel\Modules\Elementor\Documents;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Archive_Document extends \Elementor\Modules\Library\Documents\Section {

	public static function get_type() {
		return 'archive';
	}

	public static function get_title() {
		return esc_html__( 'Archive (VX)', 'voxel-backend' );
	}

	public static function get_plural_title() {
		return esc_html__( 'Archives (VX)', 'voxel-backend' );
	}
}
