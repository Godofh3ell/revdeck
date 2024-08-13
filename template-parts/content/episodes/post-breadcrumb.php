<?php 

$setting = array(

    'tv_shows'   =>  $args['tv_shows'],
    'season'   =>  $args['season'],
    'delimiter' => '<span class="delimiter">/</span>'


);
 echo '<div class="jws-breadcrumb">'.jws_page_breadcrumb($setting).'</div>';
?>