<?php
wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true );


$tv_shows = jws_episodes_check_type(get_the_ID());
$tags = jws_get_cat_list('tv_shows_tag',', ' ,$tv_shows);
$seasion = jws_episodes_check_season( array('id_tv' => $tv_shows) );

$args = array(
   'tv_shows' => $tv_shows,
   'season' => $seasion,
);
?>

<div class="episodes-top row">
    <div class="col-xl-9">
        <?php do_action('streamvid/movies/player'); 
              get_template_part( 
                 'template-parts/content/global/post','sources' , 'list'
              );
        ?>
    </div>

    <div class="col-xl-3">
        <?php 
        
          $list_right = jws_theme_get_option('select-episodes-single-list');
          if($list_right == 'season' || isset($_GET['season_list'])) {
            get_template_part('template-parts/content/episodes/post', 'season-list', $args);
          } else {
            get_template_part('template-parts/content/episodes/post', 'episodes-list', $args);
          }
          
          
        ?>
    </div>
</div>

<div class="episodes-bottom row">
    <div class="col-xl-9">
        <?php
        get_template_part('template-parts/content/episodes/post', 'breadcrumb', $args);
        get_template_part('template-parts/content/episodes/post', 'title', $args);
        get_template_part('template-parts/content/episodes/post', 'info', $args);
        ?>

        <div class="jws-description"><?php the_content(); ?></div>

        <?php if (!empty($tags)) : ?>
            <div class="jws-tags">
                <label><?php echo esc_html__('Tags:', 'streamvid'); ?></label>
                <?php echo ''.$tags; ?>
            </div>
        <?php endif; ?>

        <?php
        get_template_part('template-parts/content/episodes/post', 'tool');
        get_template_part('template-parts/content/episodes/post', 'related', $args);
        get_template_part('template-parts/content/episodes/post', 'comments', $args);
        ?>
    </div>

    <div class="col-xl-3">
         <div class="jws_sticky_move">
            <?php
          
                $sidebar = jws_theme_get_option('select-sidebar-episodes') ;    
                
                echo do_shortcode('[hf_template id="' . $sidebar . '"]');
                
             ?>
         </div>
    </div>
</div>
