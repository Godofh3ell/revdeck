<?php 
    $archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d');
?>
<div class="post-inner">
    <div class="post-media">
      <a href="<?php echo get_the_permalink(); ?>"> 
          <?php 
    
             $attach_id = get_post_thumbnail_id();
             $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
             echo !empty($image) ? $image : '';    
      
         ?>
     </a>    
    </div>
    <div class="jws_post_content">
           <h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5> 
           <?php if($settings['show_excerpt']): ?>
           <div class="jws_post_excerpt">
                    <?php  echo (!empty($settings['excerpt_length'])) ? wp_trim_words( get_the_excerpt(), $settings['excerpt_length'], $settings['excerpt_more'] ) : get_the_excerpt();?>
           </div>
           <?php endif; ?>
           <div class="jws_post_meta fs-small">
                <span class="entry-date"><a href="<?php echo esc_url(get_day_link($archive_year, $archive_month, $archive_day)); ?>"><?php echo get_the_date(); ?></a></span>
                <span class="post_author"><?php echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author(); ?></a></span> 
                <span class="post_cat"><?php echo get_the_term_list(get_the_ID(), 'category', '', ', '); ?></span> 
           </div>
    </div>
</div>   