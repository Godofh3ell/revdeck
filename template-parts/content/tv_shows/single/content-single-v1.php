<?php 

$args = array(
   'episodes' => 'v1',
);

get_template_part( 
  'template-parts/content/tv_shows/post','banner' , $args
);

echo '<div class="jws-content">';

get_template_part( 
  'template-parts/content/tv_shows/post','episodes' , $args
);

get_template_part( 
	    'template-parts/content/global/post','cast'
);

get_template_part( 
	    'template-parts/content/tv_shows/post','related'
);

echo '</div>';

?>