<div class="product-item-inner grid">
    <div class="grid_top">
        <div class="product-image">
            <a href="<?php echo get_the_permalink(); ?>" class="overlay"></a>
            <?php 
                /**
            	 * Hook: woocommerce_before_shop_loop_item.
            	 *
            	 * @hooked woocommerce_template_loop_product_link_open - 10
            	 */
            	do_action( 'woocommerce_before_shop_loop_item' );
            
            	/**
            	 * Hook: woocommerce_before_shop_loop_item_title.
            	 *
            	 * @hooked woocommerce_show_product_loop_sale_flash - 10
            	 * @hooked woocommerce_template_loop_product_thumbnail - 10
            	 */
          
            	do_action( 'woocommerce_before_shop_loop_item_title' );
                $size = isset($image_size) && !empty($image_size) ? $image_size : 'woocommerce_thumbnail';
                echo woocommerce_get_product_thumbnail($size);
                
            	/**
            	 * Hook: woocommerce_after_shop_loop_item.
            	 *
            	 * @hooked woocommerce_template_loop_product_link_close - 5
            	 * @hooked woocommerce_template_loop_add_to_cart - 10
            	 */
            	do_action( 'woocommerce_after_shop_loop_item' );
                ?>
                <div class="button-inner">
                    <?php woocommerce_template_loop_add_to_cart(); ?>
                </div>
        </div>
        <div class="product-info">
    	<?php
    
        /**
    	 * Hook: woocommerce_shop_loop_item_title.
    	 *
    	 * @hooked woocommerce_template_loop_product_title - 10
    	 */
        echo '<div class="product-category">'.jws_get_cat_list('product_cat',' ',get_the_ID()).'</div>';
    	do_action( 'woocommerce_shop_loop_item_title' );

        woocommerce_template_loop_price();
        woocommerce_template_loop_rating();
        ?>
        </div>
    </div>
   
   
</div>  