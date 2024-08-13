<?php  
$args = wp_parse_args( $args, array(
    'image_size'   =>  'full',
    'post_id'   =>  get_the_ID()
) );
extract( $args );


$tv_shows_seasons = get_field('tv_shows_seasons',$post_id);

?>

<div class="post-inner">
    <div class="post-media">
        <a href="<?php echo get_the_permalink($post_id); ?>">
        <?php     
            do_action('streamvid_post_videos_media',$args);
        ?>
        </a>
    </div>
    <div class="tv-shows-content">
        <h6 class="title">
           <a href="<?php echo get_the_permalink($post_id); ?>">
                 <?php echo get_the_title($post_id); ?>
           </a> 
        </h6>

        <?php
            if(!empty($tv_shows_seasons)) {
               $number = count($tv_shows_seasons);  
               ?>   
               <span class="seasions-numer"> <?php  printf( _n( '%s Season', '%s Seasons', $number , 'streamvid' ), number_format_i18n( $number ) ); ?> </span>
               <?php 
            }
         ?>
    </div>
</div>