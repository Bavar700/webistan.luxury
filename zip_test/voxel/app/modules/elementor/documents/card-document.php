<?php

namespace Voxel\Modules\Elementor\Documents;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Card_Document extends \Elementor\Modules\Library\Documents\Section {

	public static function get_type() {
		return 'card';
	}

	public static function get_title() {
		return esc_html__( 'Preview Card (VX)', 'voxel-backend' );
	}

	public static function get_plural_title() {
		return esc_html__( 'Preview Cards (VX)', 'voxel-backend' );
	}
}
