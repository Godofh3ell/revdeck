<?php 

$args = array(
   'episodes' => 'v2',
);

get_template_part( 
  'template-parts/content/tv_shows/post','banner-v2' , $args
);

echo '<div class="jws-content">';

get_template_part( 
	    'template-parts/content/tv_shows/post','tabs'
);

get_template_part( 
	    'template-parts/content/tv_shows/post','related'
);

echo '</div>';

?>