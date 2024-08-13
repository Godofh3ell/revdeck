<?php wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true ); ?>

<div class="row">

   
    
    <div class="col-xl-9">
        <?php
        
        
        do_action('streamvid/movies/player');
        get_template_part( 
           'template-parts/content/global/post','sources' , 'list'
        );
        get_template_part( 
              'template-parts/content/movies/post','tabs'
        ); 
        get_template_part( 
              'template-parts/content/movies/post','related'
        );
         
         
         ?>    
    </div>
    
   <div class="col-xl-3">
   <div class="jws_sticky_move">
    <?php
  
        $sidebar = jws_theme_get_option('select-sidebar-movies') ;    
        
        echo do_shortcode('[hf_template id="' . $sidebar . '"]');
        
     ?>
    </div>
  </div>

</div>