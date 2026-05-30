<?php

namespace Voxel\Modules\Elementor\Atomic_Vx;

use \Elementor\Modules\AtomicWidgets\PropsResolver\Transformer_Base;
use \Elementor\Modules\AtomicWidgets\PropsResolver\Props_Resolver_Context;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Vx_Transformer extends Transformer_Base {

	public function transform( $value, Props_Resolver_Context $context ) {
		if ( ! is_string( $value ) ) {
			return '';
		}

		$rendered = \Voxel\render( $value );
		$prop_type = $context->get_prop_type();

		if ( $prop_type->get_meta_item( 'vx_image_src', false ) ) {
			if ( empty( $rendered ) ) {
				return null;
			}

			if ( is_numeric( $rendered ) && (int) $rendered > 0 ) {
				return [
					'$$type' => 'image-src',
					'value' => [
						'id' => [ '$$type' => 'image-attachment-id', 'value' => (int) $rendered ],
						'url' => null,
					],
				];
			}

			return [
				'$$type' => 'image-src',
				'value' => [
					'id' => null,
					'url' => [ '$$type' => 'url', 'value' => $rendered ],
				],
			];
		}

		return $rendered;
	}
}
