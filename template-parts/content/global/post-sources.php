<?php 

$sources = get_field('sources');

$btn_class = 'reset-button';
if(empty($sources)) return false;

if($args == 'list') { 
    ?> 
    <div class="sources-videos sources-list fs-small" data-id="<?php echo get_the_ID(); ?>">
        <ul class="reset_ul_ol clear-both">
        
        <li class="label"><?php echo esc_html__('Change Source','streamvid'); ?>:</li>
            
        <?php
             foreach($sources as $index => $source) {
                $main = isset($source['main']) && $source['main'] ? ' main' : '';        
                ?>
                    <li class="<?php if($main == ' main') echo 'active'; ?>"> <button class="<?php echo esc_attr($btn_class.$main); ?>" data-index="<?php echo esc_attr($index); ?>"><i class="jws-icon-link"></i><?php printf(esc_html__('Link ','streamvid').'%s',$index + 1); ?></button></li>
                <?php
                        
             } 
         ?>
         </ul>
     </div>
     <?php 
    
}

if($args == 'table') {
    
    ?>
    <div class="sources-videos sources-table" data-id="<?php echo get_the_ID(); ?>">
    <h6><?php  echo esc_html__('Sources','streamvid'); ?></h6>
    <div class="jws-scrollbar jws-scrollbar-x">
    <table class="fs-small">
        <thead>
            <tr>
                <th><?php echo esc_html__('Links','streamvid'); ?></th>
                <th><?php echo esc_html__('Quality','streamvid'); ?></th>
                <th><?php echo esc_html__('Language','streamvid'); ?></th>
                <th><?php echo esc_html__('Player','streamvid'); ?></th>
                <th><?php echo esc_html__('Dated Added','streamvid'); ?></th>
            </tr>
        </thead>
        <tbody>
        <?php
            
            foreach($sources as $index => $source) {
                
                $main = isset($source['main']) && $source['main'] == 'on' ? ' main' : '';
     
                ?>
                
                <tr>
                
                    <td> <button class="<?php echo esc_attr($btn_class.$main); ?>" data-index="<?php echo esc_attr($index); ?>"><i class="jws-icon-play-fill"></i><span><?php echo esc_html__('Play Now','streamvid'); ?></span></button>  </td>
                    <td>
                        <?php echo esc_attr($source['quality']); ?>
                    </td>
                    <td>
                        <?php echo esc_attr($source['language']); ?>
                    </td>
                    <td>
                        <?php echo esc_attr($source['player']); ?>
                    </td>
                    <td>
                        <?php echo esc_attr($source['date']); ?>
                    </td>
                </tr>
                
                <?php
                
            }  
        
        ?>
        </tbody>
    </table>
    </div>
    </div>
    <?php
    
}