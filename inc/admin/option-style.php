<?php global $jws_option;
        $bg_btn_color = (isset($jws_option['button-bgcolor']) && $jws_option['button-bgcolor']) ? $jws_option['button-bgcolor'] : '#9e61ff';
        
  	    $jws_modified_variables['shadow_button'] = $bg_btn_color;
        
  
        $body_overlay = (isset($jws_option['bg_body']['background-color']) && !empty($jws_option['bg_body']['background-color']))  ? $jws_option['bg_body']['background-color'] : '#00031c';
     
      
  	    $jws_modified_variables['body_overlay'] = $body_overlay;
    