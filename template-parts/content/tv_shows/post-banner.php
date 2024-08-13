<?php 
$post_id = get_the_ID();
$years = get_post_meta($post_id , 'videos_years' , true);
$badge = get_post_meta($post_id , 'videos_badge' , true);

$tv_shows_seasons = get_field('tv_shows_seasons');

$title_images = get_post_meta($post_id , 'title_images', true );

$background = jws_tv_shows_background($post_id);

?>

<div class="jws-banners" style="background-image:url(<?php echo esc_attr($background); ?>)">
    <div class="jws-banners-inner">
        <div class="jws-category"><?php echo jws_get_cat_list('tv_shows_cat',' ' ,$post_id); ?></div>
        <div class="title-images">
            <?php 
            
            if(!empty($title_images)) {
                echo jws_image_advanced(array('attach_id' => $title_images, 'thumb_size' => 'full'));
            }
            
            ?>
        </div>
        <h1 class="jws-title">
           <?php echo get_the_title(); ?>
        </h1>
        
        
        <div class="jws-meta-info clear-both">
            <?php 
                echo !empty($years) ? '<span class="video-years">'.$years.'</span>' : '';
                if(!empty($tv_shows_seasons)) {
                   $number = count($tv_shows_seasons);  
                  echo '<span class="seasions-numer">'. sprintf( _n( '%s Season', '%s Seasons', $number , 'streamvid' ), number_format_i18n( $number ) ) .' </span>';
                 
                }
                echo !empty($badge) ? '<span class="video-badge">'.$badge.'</span>' : '';
            ?>
        </div>
        
        <div class="jws-description"><?php echo get_the_excerpt(); ?></div>
        
        <div class="video-play clear-both">
            <a class="btn-main button-default jws-play" href="<?php echo jws_check_play_tv_shows($tv_shows_seasons); ?>"><i class="jws-icon-play-circle"></i><?php echo esc_html__('Star Watching','streamvid'); ?></a> 
            <?php 
            
             get_template_part( 
            	'template-parts/content/tv_shows/post','seasion' 
            );
            
            ?>
        </div>
        
        <?php 
        
        get_template_part( 
        	'template-parts/content/tv_shows/post','tool' , $args
        );
        
        ?>
    </div>
</div>