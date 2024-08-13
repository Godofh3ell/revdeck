<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $jws_option; 
do_action( 'woocommerce_before_checkout_form', $checkout );
?> 
<div class="checkout-pages">

<?php 
    woocommerce_checkout_login_form();
    woocommerce_checkout_coupon_form(); 
?>


<?php
// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'streamvid' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    <div class="row">
         <div class="col-lg-60 col-xs-12">
            	<?php if ( $checkout->get_checkout_fields() ) : ?>

            		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
            
            		<div id="customer_details" class="loading">
            		       <div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>   
            				<?php do_action( 'woocommerce_checkout_billing' ); ?>
            				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
            		</div>
            
            		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
            
            	<?php endif; ?>
         </div>
         
         <div class="col-lg-40 col-xs-12">
            <div class="jws_woo_your_order">
            <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
        	<h5 id="order_review_heading"><?php esc_html_e( 'Your order', 'streamvid' ); ?></h5>
        	
        	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
        
        	<div id="order_review" class="woocommerce-checkout-review-order">
        		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
        	</div>
        
        	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
            </div>
         </div>
    </div>

	
	

</form>
</div>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>