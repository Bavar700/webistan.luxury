<?php

namespace Voxel\Dynamic_Data\Visibility_Rules;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Template_Is_Homepage extends Base_Visibility_Rule {

	public function get_type(): string {
		return 'template:is_homepage';
	}

	public function get_label(): string {
		return _x( 'Is homepage', 'visibility rules', 'voxel-backend' );
	}

	public function evaluate(): bool {
		if ( $template = \Voxel\get_visibility_context_template() ) {
			return ! empty( $template['is_front_page'] );
		}

		return is_front_page();
	}
}
