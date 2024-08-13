<?php 

$data_slick = 'data-owl-option=\'{
"autoplay":false,
"nav":true, 
"loop":false,
"dots":false, 
"autoWidth":true,
"smartSpeed":500, 
"responsive":{
    "1024":{"items":1,"slideBy":1},
    "768":{"items":1,"slideBy":1},
    "0":{"items":1,"slideBy":1}
}}\'';
  
$person_id = get_the_ID(); 


$args = array(
    'post_type' => array('movies','tv_shows','videos'),
    'fields' => 'ids',
    'posts_per_page' => -1,
    'suppress_filters' => false,
    'meta_query' => array(
    'relation'      => 'OR',
        array(
            'key' => 'crew_$_person',
            'value' => $person_id,
            'compare' => 'LIKE'
        )
    )
);


$crew = new WP_Query($args);
$crew = $crew->posts;


$args = array(
    'post_type' => array('movies','tv_shows','videos'),
    'fields' => 'ids',
    'posts_per_page' => -1,
    'suppress_filters' => false,
    'meta_query' => array(
    'relation'      => 'OR',
        array(
            'key' => 'cast_$_person',
            'value' => $person_id,
            'compare' => 'LIKE'
        )
    )
);


$cast = new WP_Query($args);
$cast = $cast->posts;


$cast = array_unique(array_merge($cast, $crew));


if(!empty($cast)) {
    $post_type = array('all' => esc_html__('All','streamvid'));
?>
<div class="person-know-slider global-movies jws-movies_advanced-element">


<h6><?php echo apply_filters( 'person/single/know/heading', esc_html__('Know for','streamvid') ); ?></h6>
 
<div class=" jws_movies_advanced_slider owl-carousel layout2" <?php echo ''.$data_slick; ?>>
    <?php

        $args =  array('image_size' => jws_theme_get_option('movies_imagesize'));
        
        foreach($cast as $value) {
            
            if(!isset($value)) continue;

            $slug = get_post_type($value); 
            $label = get_post_type_object($slug)->labels->singular_name;
          
            $post_type[$slug] = $label;
            
            $args['post_id'] = $value;
               
            ?>
            
            <div class="jws-post-item slider-item">
            
                <?php get_template_part( 'template-parts/content/movies/layout/layout2' , '' ,$args ); ?>
            
            </div>
            
            <?php 
        }
    ?>
</div>
</div>    
<div class="person-know-history"> 
 
 <ul class="reset_ul_ol history-nav fs-small fw-500 uppercase">
    
        <?php
       
            
            if(!empty($post_type)) {
                foreach($post_type as $key => $value) {
                  $active = $key == 'all' ? 'active' : '';  
                  echo "<li><a class='$active' href='#' data-slug='$key'>$value</a></li>";  
                    
                }
            }
         ?>
    
  </ul>
  <div class="history-content">
  
    <?php
 
    
        foreach($cast as $value) {
            if(!isset($value)) continue;
            $years = get_post_meta($value , 'videos_years' , true);
            $slug = get_post_type($value); 
            
            
                $this_casts = get_field('cast',$value);
                $this_crews = get_field('crew',$value);
                
                $this_casts = !empty($this_casts) ? $this_casts : array();
                $this_crews = !empty($this_crews) ? $this_crews : array();
                
                $this_casts = array_merge($this_casts, $this_crews);
                
                
                foreach( $this_casts as $this_cast) {
                  
                    if($person_id != $this_cast['person']) continue;
                    
                    $ruleas  =  isset($this_cast['as']) && !empty($this_cast['as']) ? esc_html__( 'as ','streamvid' ) : (isset($this_cast['job']) && !empty($this_cast['job'])  ? esc_html__( 'job ','streamvid' ) : '');
                    
                    printf(
                        '<div class="history-item cl-light %s"><span class="years">%s</span>%s %s %s</div>',
                        $slug,
                        !empty($years) ? $years : '-',
                        '<a class="fw-700" href="'.get_the_permalink($value).'">'.get_the_title($value).'</a>',
                        '<span class="cl-body">'.$ruleas.'</span>',
                        isset($this_cast['as']) ? $this_cast['as'] : $this_cast['job']
                    );
                    
                    
                }
                

                 ?>
            
            <?php 
        }
    ?>
  
  
  </div>
 
</div>   

    <?php
}


?>






