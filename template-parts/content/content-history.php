<?php 
$args = wp_parse_args( $args , array(
    'id'    =>  0,
    'history' => array()
) );

extract( $args );

?>
<div class="post-inner">
    <input type="checkbox" name="watchlisted[]" value="<?php echo esc_attr($id); ?>" />
    <div class="post-media">
        <?php     
            $attach_id = get_post_thumbnail_id($id);
            $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => 'full'));
            echo !empty($image) ? $image : '';
	  
               
        ?>
        <?php if(isset($history['time'])) {
            
            $time = $history['time'] / $history['endtime'] * 100;
         
          ?>
          <div class="time-data">
               <span style="width:<?php echo esc_attr($time) ?>%;" class=""></span>
                   <?php 
 
                   ?>
            </div>
        <?php } ?>
 
    </div>
    <div class="videos-content">
        <h6 class="title">
           <?php  
           
           if(isset($history['episodes'])) { 
             
             ?>
               
               <a href="<?php echo get_the_permalink($history['episodes']); ?>">
                     <?php echo get_the_title($history['episodes']); ?>
               </a>
             
             <?php
            
           } else {
              
              ?>
                
               <a href="<?php echo get_the_permalink($id); ?>">
                     <?php echo get_the_title($id); ?>
               </a>
              
              <?php
            
           }
           
           ?>
           
        </h6>
        
        <?php
          
          if(isset($history['episodes'])) {
            
            $seasion = jws_episodes_check_season( array('id_tv' => $id , 'id' => $history['episodes']) );
          
             printf(
                 __('Seasion','streamvid').' %s - %s',
                 $seasion,
                 get_the_title($history['episodes'])
                  
             );
            ?>
             
             <div>
               
            
            
            </div>
            
            <?php
            
          }
        
         ?>
        

    </div>
</div>