<?php 

$view = jws_get_videos_view(); 

?>
<?php if($args['episodes'] == 'v2') {
    ?>

            <div class="jws-tool clear-both">
                <div class="tool-left">
                    <div class="jws-view">
    
                    <?php echo sprintf( _n( '<i class="jws-icon-eye"></i> %s View', '<i class="jws-icon-eye"></i> %s Views', $view, 'streamvid' ), $view );  ?>
                    
                    </div>
                    <?php if(function_exists('jws_like_button')) jws_like_button('tv_shows',get_the_ID()); ?>
                </div>
                <div class="tool-right">
                     <?php if(function_exists('jws_watchlist_button')) jws_watchlist_button(get_the_ID()); ?>
                     <?php if(function_exists('jws_share_button')) jws_share_button(); ?>
                </div>
            </div>
    <?php
} else {
    
 
        
   if(function_exists('jws_share_button')) jws_share_button(); 
    
    
    
} ?>



