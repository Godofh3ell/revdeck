<?php 
    $archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d');
?>
<div class="post-inner row row-eq-height">
    <div class="col-xl-53 col-lg-6">
        <div class="post-media">
          <?php 
             $attach_id = get_post_thumbnail_id();
             $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
             echo !empty($image) ? $image : '';
            ?>  
    
        </div>
    </div>
    <div class="col-xl-47 col-lg-6">
          <div class="jws_post_content">
               <span class="post_cat fs-small uppercase bage"><?php echo get_the_term_list(get_the_ID(), 'category', '', ', '); ?></span> 
               <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2> 
               
                <?php if($settings['show_excerpt']): ?>
               <div class="jws_post_excerpt">
                        <?php  echo (!empty($settings['excerpt_length'])) ? wp_trim_words( get_the_excerpt(), $settings['excerpt_length'], $settings['excerpt_more'] ) : get_the_excerpt();?>
               </div>
               <?php endif; ?>
               <div class="jws_post_meta">
                    <span class="post_author"><?php echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author(); ?></a></span> 
                    <span class="entry-date"><a href="<?php echo esc_url(get_day_link($archive_year, $archive_month, $archive_day)); ?>"><?php echo get_the_date(); ?></a></span>
               </div>
               
        </div>
    </div>
</div>

  
