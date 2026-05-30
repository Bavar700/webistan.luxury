<?php

namespace Voxel\Modules\Elementor\Atomic_Vx;

use Elementor\Modules\AtomicWidgets\PropTypes\Contracts\Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Union_Prop_Type;
use Elementor\Modules\AtomicWidgets\PropTypes\Utils\Prop_Types_Schema_Extender;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Vx_Prop_Types_Mapping extends Prop_Types_Schema_Extender {

	public static function make(): self {
		return new static();
	}

	protected function get_prop_types_to_add( Prop_Type $prop_type ): array {
		if ( ! ( $prop_type instanceof Union_Prop_Type ) ) {
			return [];
		}

		if ( ! $prop_type->get_prop_type( 'dynamic' ) ) {
			return [];
		}

		if ( $prop_type->get_prop_type( Vx_Prop_Type::get_key() ) ) {
			return [];
		}

		$vx = Vx_Prop_Type::make();

		if ( $prop_type->get_prop_type( 'image-src' ) ) {
			$vx->meta( 'vx_image_src', true );
		}

		return [ $vx ];
	}
}
