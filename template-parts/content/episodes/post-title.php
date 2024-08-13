<div class="jws-title clear-both">
    <?php 
        $post_type = get_post_type_object(get_post_type());  
        if($args['tv_shows']) {
            
           echo '<h1 class="h3"><a href="'.get_the_permalink($args['tv_shows']).'">'.get_the_title($args['tv_shows']).'</a></h1>'; 
           echo '<h6 class="season"><a href="'.get_the_permalink($args['tv_shows']).$post_type->rewrite['slug'].'/?season='.$args['season'].'">'.esc_html__('Season','streamvid').' '.$args['season'].'</a></h6>';
         
        }
        echo '<h6>'.get_the_title().'</h6>';
    ?>
</div>
