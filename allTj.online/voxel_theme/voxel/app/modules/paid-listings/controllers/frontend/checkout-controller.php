<?php

namespace Voxel\Modules\Paid_Listings\Controllers\Frontend;

use \Voxel\Modules\Paid_Listings as Module;
use \Voxel\Modules\Claim_Listings as Claim_Listings;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Checkout_Controller extends \Voxel\Controllers\Base_Controller {

	protected function hooks() {
		$this->on( 'voxel_ajax_paid_listings.choose_plan', '@choose_plan' );
		$this->on( 'voxel_ajax_nopriv_paid_listings.choose_plan', '@choose_plan_guest_user' );
	}

	protected function choose_plan() {
		try {
			\Voxel\verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'vx_choose_plan' );

			$customer = \Voxel\get_current_user();

			// support custom redirect
			$redirect_to = null;
			if ( ! empty( $_REQUEST['redirect_to'] ) && wp_validate_redirect( $_REQUEST['redirect_to'] ) ) {
				$redirect_to = wp_validate_redirect( $_REQUEST['redirect_to'] );
			}

			$process = \Voxel\from_list( $_REQUEST['process'] ?? null, [ 'new', 'relist', 'claim', 'switch', 'upgrade' ], null );

			if ( $process === 'new' ) {
				$post_type = \Voxel\Post_Type::get( $_REQUEST['item_type'] ?? null );
				if ( $post_type === null ) {
					throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 70 );
				}

				if ( ! empty( $_REQUEST['package_id'] ) ) {
					$package = Module\Listing_Package::get( absint( $_REQUEST['package_id'] ) );
					if ( ! ( $package && $customer->is_customer_of( $package->order->get_id() ) ) ) {
						throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 75 );
					}

					if ( ! $package->can_create_post( $post_type ) ) {
						throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 71 );
					}

					$draft = Module\get_or_create_draft( $package, $post_type, $customer );
					if ( $draft === null ) {
						throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 72 );
					}


					$redirect_url = $draft->get_edit_link();
					if ( ! empty( $_REQUEST['submit_to'] ) && wp_validate_redirect( $_REQUEST['submit_to'] ) ) {
						$redirect_url = add_query_arg( [
							'post_id' => $draft->get_id(),
						], wp_validate_redirect( $_REQUEST['submit_to'] ) );
					}

					return wp_send_json( [
						'success' => true,
						'type' => 'redirect',
						'redirect_to' => $redirect_url,
					] );
				} else {
					$plan = Module\Listing_Plan::get( sanitize_text_field( $_REQUEST['plan'] ?? '' ) );
					if ( $plan === null || ! $plan->supports_post_type( $post_type ) ) {
						throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 80 );
					}

					$submit_to = null;
					if ( ! empty( $_REQUEST['submit_to'] ) && wp_validate_redirect( $_REQUEST['submit_to'] ) ) {
						$submit_to = wp_validate_redirect( $_REQUEST['submit_to'] );
					}

					$cart_item = \Voxel\Cart_Item::create( [
						'product' => [
							'post_id' => $plan->get_product_id(),
							'field_key' => 'voxel:listing_plan',
						],
						'custom_data' => [
							'checkout_context' => [
								'process' => 'new',
								'post_type' => $post_type->get_key(),
								'submit_to' => $submit_to,
							],
						],
					] );

					$cart = new \Voxel\Product_Types\Cart\Direct_Cart;
					$cart->add_item( $cart_item );

					$order = \Voxel\Order::create_from_cart( $cart );

					$payment_method = $order->get_payment_method();
					if ( $payment_method === null ) {
						throw new \Exception( __( 'Could not process payment', 'voxel' ), 101 );
					}

					return wp_send_json( $payment_method->process_payment() );
				}
			} elseif ( $process === 'relist' ) {
				$post = \Voxel\Post::get( $_REQUEST['post_id'] ?? null );
				if ( ! (
					$post
					&& $post->post_type
					&& $post->is_editable_by_current_user()
					&& in_array( $post->get_status(), [ 'expired', 'rejected' ], true )
				) ) {
					throw new \Exception( _x( 'This item cannot be relisted.', 'pricing plans', 'voxel' ), 70 );
				}

				if ( ! empty( $_REQUEST['package_id'] ) ) {
					$package = Module\Listing_Package::get( absint( $_REQUEST['package_id'] ) );
					if ( ! ( $package && $customer->is_customer_of( $package->order->get_id() ) ) ) {
						throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 75 );
					}

					if ( ! $package->can_create_post( $post->post_type ) ) {
						throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 71 );
					}

					$draft = Module\prepare_post_for_relisting( $package, $post );
					if ( $draft === null ) {
						throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 72 );
					}

					return wp_send_json( [
						'success' => true,
						'type' => 'redirect',
						'redirect_to' => $draft->get_edit_link(),
					] );
				} else {
					$plan = Module\Listing_Plan::get( sanitize_text_field( $_REQUEST['plan'] ?? '' ) );
					if ( $plan === null || ! $plan->supports_post_type( $post->post_type ) ) {
						throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 80 );
					}

					$cart_item = \Voxel\Cart_Item::create( [
						'product' => [
							'post_id' => $plan->get_product_id(),
							'field_key' => 'voxel:listing_plan',
						],
						'custom_data' => [
							'checkout_context' => [
								'process' => 'relist',
								'post_id' => $post->get_id(),
							],
						],
					] );

					$cart = new \Voxel\Product_Types\Cart\Direct_Cart;
					$cart->add_item( $cart_item );

					$order = \Voxel\Order::create_from_cart( $cart );

					$payment_method = $order->get_payment_method();
					if ( $payment_method === null ) {
						throw new \Exception( __( 'Could not process payment', 'voxel' ), 101 );
					}

					return wp_send_json( $payment_method->process_payment() );
				}
			} elseif ( $process === 'switch' ) {
				$post = \Voxel\Post::get( $_REQUEST['post_id'] ?? null );
				if ( ! (
					$post
					&& $post->post_type
					&& $post->is_editable_by_current_user()
					&& $post->get_status() === 'publish'
				) ) {
					throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 70 );
				}

				if ( ! empty( $_REQUEST['package_id'] ) ) {
					$package = Module\Listing_Package::get( absint( $_REQUEST['package_id'] ) );
					if ( ! ( $package && $customer->is_customer_of( $package->order->get_id() ) ) ) {
						throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 75 );
					}

					if ( ! $package->can_create_post( $post->post_type ) ) {
						throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 71 );
					}

					$package->assign_to_post( $post );

					return wp_send_json( [
						'success' => true,
						'type' => 'redirect',
						'redirect_to' => $redirect_to ?? $post->get_link(),
					] );
				} else {
					$plan = Module\Listing_Plan::get( sanitize_text_field( $_REQUEST['plan'] ?? '' ) );
					if ( $plan === null || ! $plan->supports_post_type( $post->post_type ) ) {
						throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 80 );
					}

					$cart_item = \Voxel\Cart_Item::create( [
						'product' => [
							'post_id' => $plan->get_product_id(),
							'field_key' => 'voxel:listing_plan',
						],
						'custom_data' => [
							'checkout_context' => [
								'process' => 'switch',
								'post_id' => $post->get_id(),
							],
						],
					] );

					$cart = new \Voxel\Product_Types\Cart\Direct_Cart;
					$cart->add_item( $cart_item );

					$order = \Voxel\Order::create_from_cart( $cart );

					$payment_method = $order->get_payment_method();
					if ( $payment_method === null ) {
						throw new \Exception( __( 'Could not process payment', 'voxel' ), 101 );
					}

					return wp_send_json( $payment_method->process_payment() );
				}
			} elseif ( $process === 'upgrade' ) {
				$order = \Voxel\Order::find( [
					'id' => absint( $_REQUEST['order_id'] ?? null ),
					'customer_id' => $customer->get_id(),
				] );
				$payment_method = $order ? $order->get_payment_method() : null;
				$current_package = $order ? Module\get_order_package( $order ) : null;
				$plan = Module\Listing_Plan::get( sanitize_text_field( $_REQUEST['plan'] ?? '' ) );

				if ( ! ( $order && $payment_method && $current_package && $plan ) ) {
					throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 150 );
				}

				if ( $plan->get_billing_mode() !== 'subscription' ) {
					throw new \Exception( _x( 'You can only upgrade into a subscription plan', 'pricing plans', 'voxel' ), 151 );
				}

				if ( $current_package->get_plan_key() === $plan->get_key() ) {
					return wp_send_json( [
						'success' => true,
						'type' => 'redirect',
						'redirect_to' => $redirect_to ?? $order->get_link(),
					] );
				}

				$cart_item = \Voxel\Cart_Item::create( [
					'product' => [
						'post_id' => $plan->get_product_id(),
						'field_key' => 'voxel:listing_plan',
					],
					'custom_data' => [
						'checkout_context' => [
							'process' => 'upgrade',
							'order_id' => $order->get_id(),
						],
					],
				] );
				$cart_item->validate();

				if ( $payment_method->is_subscription_active() ) {
					if (
						( strtoupper( $order->get_currency() ) !== strtoupper( $cart_item->get_currency() ) )
						|| ( $payment_method->get_type() !== $cart_item->get_payment_method() )
						|| ! $payment_method->supports_subscription_price_update()
					) {
						return wp_send_json( [
							'success' => true,
							'type' => 'dialog',
							'dialog' => [
								'type' => 'warning',
								'timeout' => 12000,
								'message' => _x( 'Cancel your existing plan to proceed.', 'pricing plans', 'voxel' ),
								'actions' => [
									[
										'label' => _x( 'Manage plan', 'pricing plans', 'voxel' ),
										'link' => $order->get_link(),
									],
								],
							],
						] );
					}

					$allocation = Module\get_upgrade_post_allocation( $current_package->get_limits(), $plan->get_limits() );
					$overflow_notice = $this->get_upgrade_overflow_notice( $allocation );

					try {
						if ( ! empty( $_REQUEST['confirm_switch'] ) ) {
							\Voxel\verify_nonce( $_REQUEST['confirm_switch_nonce'] ?? '', 'voxel_listing_plans_confirm_switch' );

							$order->set_details( 'checkout.listing_plan_upgrade', [
								'handled' => false,
								'source_package_id' => $current_package->get_id(),
								'source_plan_key' => $current_package->get_plan_key(),
								'target_plan_key' => $plan->get_key(),
								'old_limits' => $current_package->get_limits(),
							] );
							$order->save( true );

							$result = $payment_method->update_subscription_price( $cart_item );
							if ( is_array( $result ) && isset( $result['redirect_url'] ) ) {
								return wp_send_json( [
									'success' => true,
									'type' => 'redirect',
									'redirect_to' => $result['redirect_url'],
								] );
							}

							return wp_send_json( [
								'success' => true,
								'redirect_to' => $redirect_to ?? $order->get_link(),
							] );
						}

						$preview = $payment_method->preview_subscription_price_update( $cart_item );
						if ( $preview['amount_due'] > 0 ) {
							$message = sprintf(
								_x( 'Switching to this plan will incur an immediate charge of %s.', 'pricing plans', 'voxel' ),
								\Voxel\currency_format( $preview['amount_due'], $preview['currency'], false )
							);
						} elseif ( $preview['total'] < 0 ) {
							$message = sprintf(
								_x( 'Switching to this plan will cost nothing today and you\'ll receive a %s credit that will be applied to future invoices.', 'pricing plans', 'voxel' ),
								\Voxel\currency_format( abs( $preview['total'] ), $preview['currency'], false )
							);
						} else {
							$message = _x( 'Your plan will be updated immediately without additional charge.', 'pricing plans', 'voxel' );
						}
						$confirm_link = add_query_arg( [
							'confirm_switch' => true,
							'confirm_switch_nonce' => wp_create_nonce( 'voxel_listing_plans_confirm_switch' ),
						], \Voxel\get_current_url() );

						if ( $overflow_notice !== null ) {
							return wp_send_json( [
								'success' => true,
								'type' => 'dialog',
								'dialog' => [
									'type' => 'warning',
									'timeout' => 12000,
									'message' => $message,
									'actions' => [
										[
											'label' => _x( 'Continue', 'pricing plans', 'voxel' ),
											'next_dialog' => [
												'type' => 'warning',
												'timeout' => 12000,
												'message' => $overflow_notice.' '._x( 'Would you like to continue?', 'pricing plans', 'voxel' ),
												'actions' => [
													[
														'label' => _x( 'Continue', 'pricing plans', 'voxel' ),
														'link' => $confirm_link,
														'confirm_switch' => true,
													],
												],
												'closeLabel' => _x( 'Close', 'pricing plans', 'voxel' ),
											],
										],
									],
									'closeLabel' => _x( 'Close', 'pricing plans', 'voxel' ),
								],
							] );
						}

						$message .= ' '._x( 'Would you like to continue?', 'pricing plans', 'voxel' );

						return wp_send_json( [
							'success' => true,
							'type' => 'dialog',
							'dialog' => [
								'type' => 'warning',
								'timeout' => 12000,
								'message' => $message,
								'actions' => [
									[
										'label' => _x( 'Continue', 'pricing plans', 'voxel' ),
										'link' => $confirm_link,
										'confirm_switch' => true,
									],
								],
								'closeLabel' => _x( 'Close', 'pricing plans', 'voxel' ),
							],
						] );
					} catch ( \Exception $e ) {
						$order->set_details( 'checkout.listing_plan_upgrade', null );
						$order->save( true );
						throw new \Exception( _x( 'Could not process subscription, please try later.', 'pricing plans', 'voxel' ) );
					}
				} elseif ( $payment_method->is_subscription_recoverable() ) {
					throw new \Exception( _x( 'Cancel your existing subscription to proceed.', 'pricing plans', 'voxel' ) );
				} else {
					throw new \Exception( _x( 'This subscription is no longer active.', 'pricing plans', 'voxel' ) );
				}
			} elseif ( $process === 'claim' ) {
				$post = \Voxel\Post::get( $_REQUEST['post_id'] ?? null );
				if ( ! ( $post && Claim_Listings\is_claimable( $post ) ) ) {
					throw new \Exception( _x( 'This item cannot be claimed.', 'pricing plans', 'voxel' ), 70 );
				}

				if ( ! empty( $_REQUEST['package_id'] ) ) {
					$package = Module\Listing_Package::get( absint( $_REQUEST['package_id'] ) );
					if ( ! ( $package && $customer->is_customer_of( $package->order->get_id() ) ) ) {
						throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 75 );
					}

					if ( ! $package->can_create_post( $post->post_type ) ) {
						throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 71 );
					}

					$cart_item = \Voxel\Cart_Item::create( [
						'product' => [
							'post_id' => Claim_Listings\get_product()->get_id(),
							'field_key' => 'voxel:claim_request',
						],
						'custom_data' => [
							'voxel:claim_request' => [
								'post_id' => $post->get_id(),
								'package_id' => $package->get_id(),
							],
						],
					] );

					$checkout_link = get_permalink( \Voxel\get( 'templates.checkout' ) ) ?: home_url('/');
					$checkout_link = add_query_arg( 'checkout_item', $cart_item->get_key(), $checkout_link );

					if ( $redirect_to !== null ) {
						$checkout_link = add_query_arg(
							'redirect_to',
							urlencode( $redirect_to ),
							$checkout_link
						);
					}

					return wp_send_json( [
						'success' => true,
						'type' => 'checkout',
						'item' => $cart_item->get_frontend_config(),
						'checkout_link' => $checkout_link,
					] );
				} else {
					$plan = Module\Listing_Plan::get( sanitize_text_field( $_REQUEST['plan'] ?? '' ) );
					if ( $plan === null || ! $plan->supports_post_type( $post->post_type ) ) {
						throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 80 );
					}

					$cart_item = \Voxel\Cart_Item::create( [
						'product' => [
							'post_id' => $plan->get_product_id(),
							'field_key' => 'voxel:listing_plan',
						],
						'custom_data' => [
							'checkout_context' => [
								'process' => 'claim',
								'post_id' => $post->get_id(),
							],
						],
					] );

					$checkout_link = get_permalink( \Voxel\get( 'templates.checkout' ) ) ?: home_url('/');
					$checkout_link = add_query_arg( 'checkout_item', $cart_item->get_key(), $checkout_link );

					if ( $redirect_to !== null ) {
						$checkout_link = add_query_arg(
							'redirect_to',
							urlencode( $redirect_to ),
							$checkout_link
						);
					}

					return wp_send_json( [
						'success' => true,
						'type' => 'checkout',
						'item' => $cart_item->get_frontend_config(),
						'checkout_link' => $checkout_link,
					] );
				}
			} else {
				$plan = Module\Listing_Plan::get( sanitize_text_field( $_GET['plan'] ?? '' ) );
				if ( $plan === null ) {
					throw new \Exception( _x( 'This plan is not available.', 'pricing plans', 'voxel' ), 150 );
				}

				$cart_item = \Voxel\Cart_Item::create( [
					'product' => [
						'post_id' => $plan->get_product_id(),
						'field_key' => 'voxel:listing_plan',
					],
				] );

				$cart = new \Voxel\Product_Types\Cart\Direct_Cart;
				$cart->add_item( $cart_item );

				$order = \Voxel\Order::create_from_cart( $cart, [
					'meta' => [
						'redirect_to' => $redirect_to,
					],
				] );

				$payment_method = $order->get_payment_method();
				if ( $payment_method === null ) {
					throw new \Exception( __( 'Could not process payment', 'voxel' ), 101 );
				}

				return wp_send_json( $payment_method->process_payment() );
			}
		} catch ( \Exception $e ) {
			return wp_send_json( [
				'success' => false,
				'message' => $e->getMessage(),
				'code' => $e->getCode(),
			] );
		}
	}

	protected function get_upgrade_overflow_notice( array $allocation ): ?string {
		if ( empty( $allocation['expired_count'] ) ) {
			return null;
		}

		return sprintf(
			_x( 'Some of your listings (%d) will be expired automatically because this plan supports fewer active submissions.', 'pricing plans', 'voxel' ),
			absint( $allocation['expired_count'] )
		);
	}

	protected function choose_plan_guest_user() {
		try {
			$redirect_to = add_query_arg( [
				'_ctx' => 'listing_plans',
				'plan' => $_REQUEST['plan'] ?? '',
				'process' => $_REQUEST['process'] ?? '',
				'order_id' => $_REQUEST['order_id'] ?? '',
				'item_type' => $_REQUEST['item_type'] ?? '',
			], wp_get_referer() );

			return wp_send_json( [
				'success' => true,
				'type' => 'redirect',
				'redirect_to' => add_query_arg( [
					'register' => '',
					'redirect_to' => urlencode( $redirect_to ),
				], \Voxel\get_auth_url() ),
			] );
		} catch ( \Exception $e ) {
			return wp_send_json( [
				'success' => false,
				'message' => $e->getMessage(),
				'code' => $e->getCode(),
			] );
		}
	}

}
