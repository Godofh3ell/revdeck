<?php 


$tv_shows_seasons = get_field('tv_shows_seasons');
if(isset($tv_shows_seasons[0]['episodes']) && !empty($tv_shows_seasons[0]['episodes'])) : 

$episodes = $tv_shows_seasons[0]['episodes'];

$image_size = jws_theme_get_option('tv_shows_imagesize'); 


$data_slick = 'data-owl-option=\'{
"autoplay":false,
"nav":true, 
"loop":false,
"dots":false, 
"autoWidth":true,
"smartSpeed":500, 
"responsive":{
    "1024":{"items":1,"slideBy":1},
    "768":{"items":1,"slideBy":1},
    "0":{"items":1,"slideBy":1}
}}\''; 

?>
        <div class="jws-episodes_advanced-element global-episodes">
        
        <?php
          
          if(isset($args['episodes'])) {
            
            ?>
            
            <div class="jws-episodes-heading clear-both">
            
            <h6 class="heading"><?php echo esc_html__('Episodes','streamvid'); ?></h6>
            
            <a class="jws-view-episodes" href="<?php echo trailingslashit( get_the_permalink() ) . 'episodes'; ?>"><?php echo esc_html__('All Episodes','streamvid'); ?><i class="jws-icon-caret-right"></i></a>
            
            </div>
            
            <?php
            
            
          }
         
         ?>
       
        <div class="jws-pisodes_advanced-slider owl-carousel episodes-content clear-both layout3" <?php echo ''.$data_slick; ?>>
            <?php 
                foreach($episodes as $episodes_value) {
                   $args = array(
                        'image_size'    =>  $image_size,
                        'post_id' => $episodes_value,
                   );
                   ?>
                   
                    
                    <div class="jws-post-item slider-item">
                    
                    
                   <?php 
                     
                     get_template_part( 'template-parts/content/episodes/layout/layout4' , '' , $args ); 
                  
                    ?>
                 
                    
                    
                    </div>
                   
                   
                   <?php 
                }
             ?>
        </div>
        <div class="jws-nav-carousel">
             <div class="jws-button-prev"><i class="jws-icon-caret-left"></i></div>
             <div class="jws-button-next"><i class="jws-icon-caret-right"></i></div>
        </div>
        </div>
<?php  endif; ?>