<?php 
    $archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d');
?>
<div class="post-inner flexbox row-eq-height">
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
           <h6 class="entry-title fs-small"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6> 
           <?php if($settings['show_excerpt']): ?>
           <?php endif; ?>
           <div class="jws_post_meta fs-small">
                <span class="entry-date"><a href="<?php echo esc_url(get_day_link($archive_year, $archive_month, $archive_day)); ?>"><?php echo get_the_date(); ?></a></span>
           </div>
    </div>
</div>   