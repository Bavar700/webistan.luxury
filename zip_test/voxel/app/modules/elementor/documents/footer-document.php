<?php

namespace Voxel\Modules\Elementor\Documents;

use Elementor\Utils;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Footer_Document extends \Elementor\Modules\Library\Documents\Section {

	public static function get_type() {
		return 'footer';
	}

	public static function get_title() {
		return esc_html__( 'Footer (VX)', 'voxel-backend' );
	}

	public static function get_plural_title() {
		return esc_html__( 'Footers (VX)', 'voxel-backend' );
	}

	public function print_elements_with_wrapper( $elements_data = null ) {
		if ( ! $elements_data ) {
			$elements_data = $this->get_elements_data();
		}
		?>
		<footer <?php Utils::print_html_attributes( $this->get_container_attributes() ); ?>>
			<?php $this->print_elements( $elements_data ); ?>
		</footer>
		<?php
	}
}
