<?php
$post_id = get_the_ID();
$years = get_post_meta($post_id , 'videos_years' , true);
$badge = get_post_meta($post_id , 'videos_badge' , true);
$cast = get_field('cast');
$crew = get_field('crew');

$tags = jws_get_cat_list('tv_shows_tag',', ' ,$post_id);
?>
<?php echo '<h6>'.esc_html__('About this Show','streamvid').'</h6>'; ?>
<h4 class="jws-title">
    <?php echo get_the_title(); ?>
</h4>
<div class="post-content"><?php the_content(); ?></div>
<div class="jws-meta-info clear-both">
    <span class="jws-category clear-both"><?php echo jws_get_cat_list('tv_shows_cat',' ' ,$post_id); ?></span>
    <?php 
    
        echo !empty($years) ? '<span class="video-years">'.$years.'</span>' : '';
      
        echo !empty($badge) ? '<span class="video-badge">'.$badge.'</span>' : '';
    ?>
</div>


<div class="jws-meta-director">
     <?php if(!empty($cast)) : ?>
        <div><label><?php echo esc_html__('Cast:','streamvid'); ?></label>
            <?php 
                foreach($cast as $cast_value) {
                    echo '<a href="'.get_the_permalink($cast_value['person']).'">'.get_the_title($cast_value['person']).'</a>';
                    if ($cast_value != end($cast)) {
                       echo ', ';
                    }    
                    
                }
             ?>
        </div>
    <?php endif; ?> 
    <?php if(!empty($crew)) : ?>
        <div><label><?php echo esc_html__('Crew:','streamvid'); ?></label>
        <?php    
            foreach($crew as $crew_value) {
                echo '<a href="'.get_the_permalink($crew_value['person']).'">'.get_the_title($crew_value['person']).'</a>';
                if ($crew_value != end($crew)) {
                   echo ', ';
                }              
            }
        ?>    
        </div>
    <?php endif; ?> 
    <?php if(!empty($tags)) : ?>
        <div class="jws-tags">
            <label><?php echo esc_html__('Tags:','streamvid'); ?></label>
            <?php echo ''.$tags; ?>
        </div>
    <?php endif; ?>
</div>