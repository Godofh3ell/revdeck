<?php 


$tv_shows_seasons = get_field('tv_shows_seasons');

$id = 0;

if(isset($_GET['season'])) {
    $id = $_GET['season'] - 1;
}


if(isset($tv_shows_seasons[$id]['episodes']) && !empty($tv_shows_seasons[$id]['episodes'])) {


$episodes = $tv_shows_seasons[$id]['episodes'];

$image_size = jws_theme_get_option('tv_shows_imagesize');  

?>
<div class="episode-all">
        <div class="tv-shows-info">
        
            <h3>
               <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
            </h3>
            <?php  echo '<span class="seasions-numer">'. sprintf( _n( 'Season %s', 'Seasons %s', $id + 1 , 'streamvid' ), number_format_i18n( $id + 1 ) ) .' </span>'; ?>
        
        </div>
        <div class="jws-episodes_advanced-element">
        <h6 class="heading"><?php echo esc_html__('Episodes','streamvid'); ?></h6>
        <div class="episodes-content layout3 row">
            <?php 
                foreach($episodes as $episodes_value) {
                    $args = array(
                        'image_size'    =>  $image_size,
                        'post_id' => $episodes_value,
                    );
                   ?>
                   
                    
                    <div class="jws-post-item col-xl-2 col-lg-3 col-6">
                    
                    
                   <?php 
                   
                    get_template_part( 'template-parts/content/episodes/layout/layout4' , '' , $args ); 
                    
                    ?>
                    
                    </div>
                   
                   
                   <?php 
                }
             ?>
        </div>
    
        </div>
        
<?php      
} else {
    
    echo esc_html__('Episodes not found.','streamvid');
    
} ?>

</div>