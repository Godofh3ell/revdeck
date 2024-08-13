<div class="jws-search-form">
	<form role="search" method="get" class="searchform jws-ajax-search search-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="text" class="s" autocomplete="off" placeholder="<?php echo esc_attr( $settings['placeholder']); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        <input type="hidden" name="action" value="jws_ajax_search"/>
        <input type="hidden" name="post_type" value="movies"/>
        <button type="submit" class="searchsubmit">
	       <?php 
                if(!empty($settings['icon']['value'])) {
                  \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );  
                }else {
                  echo '<i aria-hidden="true" class="jws-icon-magnifying-glass"></i>';  
                }
            ?>
		</button>
        <span class="form-loader"></span>
	</form>
    <div class="search-results-wrapper"><div class="jws-search-results row jws-scrollbar">
        <?php 
            
            printf(
                '<p class="not-found fs-small">%s</p>',
                esc_html__( 'Please enter keywords', 'streamvid' )
            );
            
        ?>
    </div></div>
</div>