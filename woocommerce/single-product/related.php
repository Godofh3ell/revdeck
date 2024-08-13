<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $jws_option; 
$layout = (isset($jws_option['shop_related_layout']) && !empty($jws_option['shop_related_layout']) ) ? $jws_option['shop_related_layout'] : 'layout1';
$item = (isset($jws_option['shop_related_item']) && !empty($jws_option['shop_related_item']) ) ? $jws_option['shop_related_item'] : '4';
$class = 'products related-slider products-tab products-wrap owl-carousel ';
$class .= $layout;

$data_slick = 'data-owl-option=\'{
"autoplay":false,
"nav":true, 
"loop":false,
"dots":false, 
"autoWidth":false,
"smartSpeed":500, 
"responsive":{
    "1024":{"items":4,"slideBy":1},
    "768":{"items":2,"slideBy":1},
    "0":{"items":1,"slideBy":1}
}}\'';


if ( $related_products ) : ?>

	<section class="related">

		<?php
      
       $heading = apply_filters( 'woocommerce_product_related_products_heading', esc_html__( 'Related products', 'streamvid' ) );  
       
		

		if ( $heading ) :
			?>
			<h5><?php echo esc_html( $heading ); ?></h5>
		<?php endif; ?>
		
		<div class="<?php echo esc_attr($class); ?>" <?php echo ''.$data_slick; ?>>
         
			<?php foreach ( $related_products as $related_product ) : ?>
                   
    					<?php
        					$post_object = get_post( $related_product->get_id() );
        
        					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
                            
        					wc_get_template_part( 'content', 'product-related' );
    					?>
                    
			<?php endforeach; ?>
            
		</div>

	</section>
  
	<?php
endif;

wp_reset_postdata();