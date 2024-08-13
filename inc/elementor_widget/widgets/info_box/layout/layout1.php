<div class="jws-info-box-inner row-eq-height">
    <div>
    
        <h6 class="box-title">
            <?php echo esc_html($settings['info_title']); ?>
        </h6>
        <div class="box-content">
            <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );  ?>  
            <?php echo ''.$settings['info_content']; ?>
        </div>
    
    </div>
    <div class="box-more">
    
        <a class="button-custom" href="<?php echo esc_url($url); ?>" <?php echo esc_attr($target.$nofollow); ?>>
                 <?php echo esc_html($settings['info_readmore']); ?>
        </a>
    
    </div>
</div>
