<?php 
$post_id = get_the_ID();
$years = get_post_meta($post_id , 'videos_years' , true);
$badge = get_post_meta($post_id , 'videos_badge' , true);
$tv_shows_seasons = get_field('tv_shows_seasons');
$title_images = get_post_meta($post_id , 'title_images', true );

$background = jws_tv_shows_background($post_id);

$artists = get_post_meta(get_the_ID() , 'artists' , true);

$trailer_type = get_post_meta(get_the_ID() , 'videos_trailer_type' , true);
    
if($trailer_type == 'url') {
    $url =  get_post_meta(get_the_ID() , 'videos_trailer_url' , true);
    
  
} else {
    $video_id =  get_post_meta(get_the_ID() , 'videos_trailer_file' , true);

    $url = wp_get_attachment_url($video_id);
 
}

    
?>

<div class="jws-banners" style="background-image:url(<?php echo esc_attr($background); ?>)">
<div class="jws-banners-inner">
<?php 
 
   if(!empty($tv_shows_seasons)) {
       $number = count($tv_shows_seasons);  
      echo '<span class="seasions-numer">'. sprintf( _n( '%s Season available', '%s Seasons available', $number , 'streamvid' ), number_format_i18n( $number ) ) .' </span>';
     
    }
 
?>

    <?php 
    
    if(!empty($title_images)) {
        echo '<div class="title-images">'.jws_image_advanced(array('attach_id' => $title_images, 'thumb_size' => 'full')).'</div>';
    }else {
        echo '<h1 class="jws-title">'.get_the_title().'</h1>';
    }
    
    ?>


<div class="jws-description"><?php echo get_the_excerpt(); ?></div>


<?php if(!empty($artists)) : ?>
    <div class="jws-meta-artists">
        <label><?php echo esc_html__('Starring:','streamvid'); ?></label>
            <?php 
                foreach($artists as $artists_value) {
                    echo '<a href="'.get_the_permalink($artists_value).'">'.get_the_title($artists_value).'</a>';
                    if ($artists_value != end($artists)) {
                       echo ', ';
                    }    
                    
                }
             ?>
    </div>         
<?php endif; ?> 


<div class="jws-meta-info clear-both">
    <span class="jws-category clear-both"><?php echo jws_get_cat_list('tv_shows_cat',' ' ,$post_id); ?></span>
    <?php 
    
        echo !empty($years) ? '<span class="video-years">'.$years.'</span>' : '';
      
        echo !empty($badge) ? '<span class="video-badge">'.$badge.'</span>' : '';
    ?>
</div>

<div class="video-play clear-both">
    <a href="<?php echo jws_check_play_tv_shows($tv_shows_seasons); ?>" class="btn-main button-default jws-play"><i class="jws-icon-play-circle"></i><?php echo esc_html__('Play','streamvid'); ?></a> 
    <a href="<?php echo esc_attr($url); ?>" class="btn-main button-custom video-trailer"><i class="jws-icon-play-circle"></i><?php echo esc_html__('View Trailer','streamvid'); ?></a> 
</div>

<?php 

get_template_part( 
	'template-parts/content/tv_shows/post','tool' , $args
);


?>
</div>
</div>
