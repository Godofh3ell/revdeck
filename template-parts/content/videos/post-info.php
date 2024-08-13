<?php 
$id = get_the_ID();
$view = jws_get_videos_view(); 
$comment_global = jws_ci_comment_rating_get_average_ratings($id);
$rating_number = get_comments_number($id);

?>
  <div class="jws-meta-info clear-both">
  
        <span class="jws-date">
             <?php echo esc_html__('Published on ','streamvid').jws_videos_time_ago_function(); ?>
        </span>      
         
        <span class="jws-view">

        <?php echo sprintf( _n( '%s View', '%s Views', $view, 'streamvid' ), $view );  ?>
        
        </span>
        
        <span class="jws-comment-number">
        
           <?php echo sprintf( _n( '%s Comment', '%s Comments', $rating_number, 'streamvid' ), $rating_number );  ?>
        
        </span>
        
</div>


