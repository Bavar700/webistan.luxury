<?php

namespace Voxel\Dynamic_Data\Visibility_Rules;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Template_Is_Author extends Base_Visibility_Rule {

	public function get_type(): string {
		return 'template:is_author';
	}

	public function get_label(): string {
		return _x( 'Is author profile', 'visibility rules', 'voxel-backend' );
	}

	protected function define_args(): void {
		$this->define_arg( 'author_id', [
			'type' => 'text',
			'label' => _x( 'Enter author ID', 'visibility rules', 'voxel-backend' ),
		] );
	}

	public function evaluate(): bool {
		if ( $template = \Voxel\get_visibility_context_template() ) {
			if ( empty( $template['is_author'] ) ) {
				return false;
			}

			$author = trim( (string) $this->get_arg('author_id') );
			if ( $author === '' ) {
				return true;
			}

			if ( is_numeric( $author ) ) {
				return absint( $template['author_id'] ?? 0 ) === absint( $author );
			}

			return (string) ( $template['author_nicename'] ?? '' ) === $author;
		}

		return is_author( $this->get_arg('author_id') );
	}
}
