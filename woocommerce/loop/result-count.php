<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$shop = jws_check_layout_shop();
?>
<div class="row shop-nav-top">
    <div class="col-xl-6 col-lg-6 col-6">
    <a class="show_filter_shop" href="javascript:void(0)">
            <i aria-hidden="true" class="jws-icon-plus"></i>
            <span><?php echo esc_html__('Filters','streamvid'); ?></span>
    </a>
    <span class="woocommerce-result-count fs-small cl-heading">
    	<?php
        	jws_woo_found();
    	?>
    </span>

         
</div>