<?php
wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true );
$id = get_the_ID();
$tags = jws_get_cat_list('videos_tag', ', ', $id);

?>

<div class="videos-top row">
    <div class="col-xl-7">
        <?php
         do_action('streamvid/movies/player');
        ?> 
    </div>

    <div class="col-xl-5">
         <?php
         get_template_part('template-parts/content/videos/post', 'breadcrumb');
           echo '<h1 class="jws-title h4">'.get_the_title().'</h1>'; 
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

<div class="videos-bottom">
   <?php 
   get_template_part('template-parts/content/videos/post', 'related');
   get_template_part('template-parts/content/videos/post', 'comments');
   get_template_part('template-parts/content/videos/post', 'trending');
   ?> 
</div>
