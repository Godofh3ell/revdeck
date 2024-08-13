<?php 
$cast = get_field('cast');
$crew = get_field('crew');

$cast = !empty($cast) ? $cast : array();
$crew = !empty($crew) ? $crew : array();

$cast = array_merge($cast, $crew);

$image_size = '208x295';  


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


if(!empty($cast)) : ?>
        <div class="jws-person-advanced-element global-cast">
        <h5><?php echo esc_html__('Cast & Crew','streamvid'); ?></h5>
        <div class="jws-person-advanced-slider clear-both owl-carousel layout2" <?php echo ''.$data_slick; ?>>
            <?php 
           
                foreach($cast as $cast_value) {
                   if(!isset($cast_value['person'])) continue; 
                   $id = $cast_value['person']; 
                   ?>
                   
                    
                    <div class="jws-post-item slider-item">
                    
                    
                    
                        <div class="post-inner">
                            <div class="post-media">
                                <a href="<?php echo get_the_permalink($id); ?>"> 
                                    <?php     
                                        $attach_id = get_post_thumbnail_id($id);
                                        $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
                                        echo !empty($image) ? $image : '';   
                                    ?>
                                </a>
                            </div>
                            <div class="person-content">
                                <h6 class="title">
                                   <a href="<?php echo get_the_permalink($id); ?>">
                                         <?php echo get_the_title($id); ?>
                                   </a> 
                                </h6>
                                <div class="cast-cat">
                                    <?php echo jws_get_cat_list('person_cat',' ',$id); ?>
                                </div>
                            </div>
                        </div>
                    
                    
                    </div>
                   
                   
                   <?php 
                }
             ?>
        </div>
        </div>
<?php endif; ?>