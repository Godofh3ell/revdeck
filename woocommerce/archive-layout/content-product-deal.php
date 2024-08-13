<div class="product-item-inner deal">

<?php
/**
 *    jws: Quick view product content
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

//jws_quick_view_vg_data(true);
global $post, $product;




// Main wrapper class
$class = 'product main-product' . ' product-quick-view single-product-content product-' . $product->get_type();
$check = 'oke';
?>
<div class="shop-single">
<div id="product-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-12">
            <?php  include( JWS_ABS_PATH_WC.'/quickview/product-image.php' ); ?>
        </div>

        <div class="jws-summary col-xl-6 col-lg-6 col-12">
            <div class="summary entry-summary quickview-summary jws-scrollbar">
                <?php
             
                 echo '<div class="product-category uppercase fs-small">'.jws_get_cat_list('product_cat',' ',get_the_ID()).'</div>';
                 echo '<h5 class="product-title "><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
                 woocommerce_template_single_rating();
                 woocommerce_template_single_price();
                 woocommerce_template_single_excerpt(); 
                 woocommerce_template_single_add_to_cart();
                 woocommerce_template_single_sharing();
                
                 echo '<a href="'.get_permalink().'" class="view-product fs-small fw-700">'.esc_html__('View product details','streamvid').'</a>';
                ?>
            </div>
        </div>
    </div>
</div>
</div>

  </div>  