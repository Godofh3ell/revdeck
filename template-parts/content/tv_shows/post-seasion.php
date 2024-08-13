<?php 
$tv_shows_seasons = get_field('tv_shows_seasons');
 if(!empty($tv_shows_seasons)) { 
    
    ?>
        <div class="dropdown select-seasion" data-id="<?php echo esc_attr(get_the_ID()); ?>">
          <button class="dropdown-toggle" type="button">
            <?php echo esc_html__('Season 1','streamvid'); ?>
          </button>
          <ul class="dropdown-menu jws-scrollbar" aria-labelledby="dropdownMenuButton">
            <?php 
            
            foreach($tv_shows_seasons as $index => $seasons) {
                $name = esc_html__('Season ','streamvid').($index + 1);
                $class = "dropdown-item";
                if($index == 0) {
                  $class .= ' active';  
                }
                echo '<li><a class="'.$class.'" href="#" data-index="'.$index.'" data-value="'.$name.'">'.$name.'</a></li>';
       
            }
            
            ?>

          </ul>
        </div>
       
    
    <?php
    
 }

?>