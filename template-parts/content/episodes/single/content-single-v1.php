<?php



$tv_shows = jws_episodes_check_type(get_the_ID());
$tags = jws_get_cat_list('tv_shows_tag',', ' ,$tv_shows);
$seasion = jws_episodes_check_season( array('id_tv' => $tv_shows) );


$args = array(
   'tv_shows' => $tv_shows,
   'season' => $seasion,
);

echo '<div class="spisodes-top">';

do_action('streamvid/movies/player');

get_template_part( 
  'template-parts/content/episodes/post','breadcrumb' , $args
);

get_template_part( 
  'template-parts/content/episodes/post','title' , $args
);

get_template_part( 
  'template-parts/content/episodes/post','info' , $args
);



echo '<div class="jws-description">'.the_content().'</div>';



if(!empty($tags)) : ?>
    <div class="jws-tags">
        <label><?php echo esc_html__('Tags:','streamvid'); ?></label>
        <?php echo ''.$tags; ?>
    </div>
<?php endif;

get_template_part( 
  'template-parts/content/episodes/post','tool',$tv_shows
);


echo '</div>';
echo '<div class="episodes-bottom">';


get_template_part( 
     'template-parts/content/episodes/post','episodes' , $args
); 

get_template_part( 
	  'template-parts/content/episodes/post','related' , $args
);

echo '</div>';

get_template_part( 
     'template-parts/content/episodes/post','comments' , $args
); 
 ?>
