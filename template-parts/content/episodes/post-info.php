<?php 

$view = jws_get_videos_view(); 
$comment_global = jws_ci_comment_rating_get_average_ratings($args['tv_shows']);
$rating_number = get_comments_number($args['tv_shows']);

?>
  <div class="jws-meta-info clear-both">
  
        <div class="jws-raring-number">
            <i class="fas fa-star"></i><?php echo ''.$comment_global ? $comment_global : '0'; ?>
        </div>      
         
        <div class="jws-view">

        <?php echo sprintf( _n( '<i class="jws-icon-eye"></i>%s View', '<i class="jws-icon-eye"></i>%s Views', $view, 'streamvid' ), $view );  ?>
        
        </div>
        
        <div class="jws-comment-number">
        
           <?php echo '<i class="jws-icon-chat-dots"></i>'.$rating_number; ?>
        
        </div>
        
</div>


