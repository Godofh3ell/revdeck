<button data-modal-jws="#form_content_popup">
    <?php 
        if(!empty($settings['icon']['value'])) {
          \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );  
        }else {
          echo '<i aria-hidden="true" class="jws-icon-magnifying-glass"></i>';  
        }
    ?>
</button>