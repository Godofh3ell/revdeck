<?php 

$id = get_the_ID();
$featured_img_url = get_the_post_thumbnail_url($id,'full'); 
$imdb = get_post_meta($id , 'videos_imdb' , true);
$years = get_post_meta($id , 'videos_years' , true);
$time = get_post_meta($id , 'videos_time' , true);
$badge = get_post_meta($id , 'videos_badge' , true);
$title_images = get_post_meta($id , 'title_images', true );
$watchlisted = jws_watchlist_check($id);
$background_banner = get_post_meta($id , 'featured_image_two', true );
if(!empty($background_banner)) {
  $featured_img_url = jws_image_advanced(array('attach_id' => $background_banner, 'thumb_size' => 'full','return_url' => true));  
}

$trailer_type = get_post_meta($id , 'videos_trailer_type' , true);

if($trailer_type == 'url') {
    $url =  get_post_meta($id , 'videos_trailer_url' , true);
    
  
} else {
    $video_id =  get_post_meta($id , 'videos_trailer_file' , true);

    $url = wp_get_attachment_url($video_id);
 
}

$tv_shows_seasons = get_field('tv_shows_seasons');



?>
<div class="video-background-holder">
    <div style="background-image: url('<?php echo esc_attr($featured_img_url); ?>');" class="video-images">
    
    </div>
    <?php if($settings['enable_background_video'] == 'yes') : ?>
        <div class="video-player" data-trailer="<?php echo esc_attr($url); ?>">
            
        </div>
    <?php endif; ?>
</div>

<div class="video-content-holder">
    <div class="row">
        <div class="col-12">
            <div class="video-inner">
                <div class="video-cat">
                    <?php echo jws_get_cat_list('movies_cat',',', $id); ?>
                </div>
                
                <?php 
    
                if(!empty($title_images)) {
                    echo '<div class="title-images">'.jws_image_advanced(array('attach_id' => $title_images, 'thumb_size' => 'full')).'</div>';
                }else {
                    ?>
                        <h3 class="video_title">
                          <a href="<?php echo get_the_permalink(); ?>">  
                            <?php echo get_the_title(); ?>
                          </a>  
                        </h3>
                    <?php
                }
                
                ?>
                
               
                <?php if($settings['show_excerpt']): ?>
               <div class="video-description fs-small">
                        <?php  echo (!empty($settings['excerpt_length'])) ? wp_trim_words( get_the_excerpt(), $settings['excerpt_length'], $settings['excerpt_more'] ) : get_the_excerpt();?>
               </div>
               <?php endif; ?>
                <div class="video-play">
                    <a class="btn-main button-default btn-left" href="<?php echo get_the_permalink(); ?>"><?php echo esc_html($settings['play_text']); ?>
                    <i class="jws-icon-play-circle"></i>
                    </a>
                    <a class="btn-right watchlist-add<?php if(!empty($watchlisted)) echo esc_attr($watchlisted); ?>" href="<?php echo get_the_permalink(); ?>" data-post-id="<?php echo esc_attr($id); ?>">
                    <?php 
                        if($settings['wishlist_layouts'] == 'layout1') {
                            echo esc_html($settings['watch_later_text']);
                            echo '<i class="jws-icon-bookmark-simple"></i>';
                        } else {
                            echo '<i class="jws-icon-plus"></i>';
                        }
                     ?>
                    <?php  ?>
                    
                    </a>
                </div>
                 <div class="video-meta fs-small">
                    <?php 
                      
                        echo !empty($imdb) ? '<div class="video-imdb"><i class="fas fa-star"></i>'.$imdb.'</div>' : '';
                        echo !empty($years) ? '<div class="video-years">'.$years.'</div>' : '';
                        echo !empty($time) ? '<div class="video-time">'.$time.'</div>' : '';
                        if(!empty($tv_shows_seasons)) {
                           $number = count($tv_shows_seasons);  
                           ?>   
                           <div class="seasions-numer"> <?php  printf( _n( '%s Season', '%s Seasons', $number , 'streamvid' ), number_format_i18n( $number ) ); ?> </div>
                           <?php 
                        }
                        echo !empty($badge) ? '<div class="video-badge">'.$badge.'</div>' : '';
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>