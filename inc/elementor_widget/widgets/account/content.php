<div class="jws_account jws-dropdown-ui">
    <?php
        if ( is_user_logged_in() || isset($_GET['p']) ) {
            ?>
             
             <a class="dr-button" href="<?php echo  get_author_posts_url( get_current_user_id() ); ?>">
             <?php printf(
                '<div class="user-avatar">%s</div>',
                    get_avatar( get_current_user_id(), 30, null, null, array(
                        'class' =>  'img-thumbnail avatar'
                    ) )
                 );
            ?>
              <?php if($show_text &&!empty($text_after_login)): ?>
                    <span class="jws_account_text"><?php echo esc_html($text_after_login); ?><i class="jws-icon-arrow_carrot-down"></i></span>
             <?php endif; ?>
             </a>
            
             
        <?php } else {
            ?>
               
                <a href="#">
                <span class="jws_a_icon">
                    <?php
                         if ( isset($settings['icon']) && !empty($settings['icon']['value']) ) {
    						\Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
    					} else{ ?>
    					    <i class="jws-icon-user-circle" aria-hidden="true"></i>   
    					<?php } 
                 	?> 
                </span>
                <?php if($show_text): ?>
                    <span class="jws_account_text"><?php echo esc_html($text); ?><i class="jws-icon-arrow_carrot-down"></i></span>
                <?php endif; ?> 
                </a>
                 
            
       <?php }
        if(is_user_logged_in() && $settings['show_dropdown'] == 'yes') : ?>
            <div class="dropdown-menu">
                <div class="post-author">
                    <?php printf(
                        '<a href="%s"><div class="user-avatar user-avatar-lg">%s</div><h6>%s</h6></a>',
                        get_author_posts_url( get_current_user_id() ),
                        get_avatar( get_current_user_id(), 30, null, null, array(
                            'class' =>  'img-thumbnail avatar'
                        ) ),
                        get_the_author_meta( 'display_name', get_current_user_id() )
                    );?>
                </div>
                <?php
                
                echo jws_streamvid()->get()->profile->the_menu(true); 
                
                 ?>
            </div>  
        <?php endif; ?> 
</div>