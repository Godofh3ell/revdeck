<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

?>
<li class="product-item product">
    <div class="product-item-inner">
        <div class="product-image">
           <?php echo ''.$product->get_image(); ?>
        </div>
        <div class="product-content">
            <?php if ( ! empty( $show_rating ) ) : ?>
		          <?php echo wc_get_rating_html( $product->get_average_rating() ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	       <?php endif; ?>
            <h6 class="woocommerce-loop-product__title fw-400">
                <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
            	   <?php echo wp_kses_post( $product->get_name() ); ?>
            	</a>
            </h6>
            <span class="price-item fw-700">
                <span class="price"><?php echo ''.$product->get_price_html(); ?></span>
            </span>
        </div>
    </div>
</li>
