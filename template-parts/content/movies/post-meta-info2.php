<?php 
$cast = get_field('cast');
$crew = get_field('crew');
?>

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
    <?php if($tags = jws_get_cat_list('movies_tag',',' ,get_the_ID())): ?>
    <div class="jws-tags">
        <label><?php echo esc_html__('Tags:','streamvid'); ?></label>
        <?php echo ''.$tags;  ?>
    </div>
    <?php endif; ?>
</div>