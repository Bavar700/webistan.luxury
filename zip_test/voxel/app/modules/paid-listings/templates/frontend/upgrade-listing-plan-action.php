<?php

use \Voxel\Modules\Paid_Listings as Module;

if ( ! defined('ABSPATH') ) {
	exit;
}

$current_post = \Voxel\get_current_post();
if ( ! ( $current_post && $current_post->is_editable_by_current_user() ) ) {
	return;
}

$assigned_package = Module\get_assigned_package( $current_post );
$plan = $assigned_package['plan'];
$package = $assigned_package['package'];
$payment_method = $package ? $package->order->get_payment_method() : null;

if ( ! (
	$current_post->get_status() === 'publish'
	&& $plan
	&& $package
	&& $plan->get_billing_mode() === 'subscription'
	&& $payment_method
	&& $payment_method->is_subscription_active()
) ) {
	return;
} ?>

<?= $action['li_start'] ?>
<a
	href="<?= esc_url( wp_nonce_url( home_url( '/?vx=1&action=paid_listings.upgrade_listing_plan&post_id='.$current_post->get_id() ), 'vx_upgrade_listing_plan' ) ) ?>"
	vx-action
	rel="nofollow"
	class="ts-action-con"
	<?php if (!empty($action['ts_acw_initial_text']) || !empty($action['ts_tooltip_text'])): ?> aria-label="<?= esc_attr( !empty($action['ts_acw_initial_text']) ? $action['ts_acw_initial_text'] : $action['ts_tooltip_text'] ) ?>"<?php endif ?>
>
	<div class="ts-action-icon"><?php \Voxel\render_icon( $action['ts_acw_initial_icon'] ) ?></div>
	<?= $action['ts_acw_initial_text'] ?>
</a>
<?= $action['li_end'] ?>
