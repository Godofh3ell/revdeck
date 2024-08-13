<?php
wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true );
$id = get_the_ID();
$tags = jws_get_cat_list('videos_tag', ', ', $id);

?>

<div class="videos-top row">
    <div class="col-xl-9 col-lg-8">
        <div class="jws_sticky_move">
        <?php
         do_action('streamvid/movies/player');
         get_template_part('template-parts/content/videos/post', 'live-stream');
         get_template_part('template-parts/content/videos/post', 'breadcrumb');
         get_template_part('template-parts/content/videos/post', 'title');
         get_template_part('template-parts/content/videos/post', 'info');
         the_content();
         if (!empty($tags)) : ?>
            <div class="jws-tags">
                <label><?php echo esc_html__('Tags:', 'streamvid'); ?></label>
                <?php echo ''.$tags; ?>
            </div>
          <?php  endif; ?>
         <?php get_template_part('template-parts/content/videos/post', 'tool'); ?>
         </div>
    </div>

    <div class="col-xl-3 col-lg-4">
         <div class="jws_sticky_move">
            <?php
                if(isset($_GET['playlist'])) {
                    get_template_part('template-parts/content/videos/post', 'playlist' , $_GET['playlist']);
                }
                $sidebar = jws_theme_get_option('select-sidebar-videos') ;    
                echo do_shortcode('[hf_template id="' . $sidebar . '"]');    
                
             ?>
         </div>
    </div>
</div>

<div class="videos-bottom">
   <?php 
   get_template_part('template-parts/content/videos/post', 'related');
   get_template_part('template-parts/content/videos/post', 'comments');
   get_template_part('template-parts/content/videos/post', 'trending');
   ?> 
</div>
