<div class="jws-tabs">
    <ul class="nav-tabs">
        <li><a href="#episodes" class="active"><?php echo esc_html__('Episodes','streamvid'); ?></a></li>
        <li><a href="#extras"><?php echo esc_html__('Extras','streamvid'); ?></a></li>
        <li><a href="#detail"><?php echo esc_html__('Detail','streamvid'); ?></a></li>
        <li><a href="#reviews"><?php echo esc_html__('Reviews','streamvid'); ?></a></li>
    </ul>
    <div class="tabs-content">
        <div id="episodes" class="active">
            <?php 
                get_template_part( 
                	    'template-parts/content/tv_shows/post','seasion'
                );
                get_template_part( 
                	    'template-parts/content/tv_shows/post','episodes'
                );
            ?>
        </div>
        <div id="detail">
            <?php 
                get_template_part( 
                	    'template-parts/content/tv_shows/post','tabs-detail'
                );
            ?>
        </div>
        <div id="extras">
            <?php 
                get_template_part( 
                	    'template-parts/content/global/post','videos'
                );
            ?>
        </div>
        <div id="reviews">
            <?php 
                get_template_part( 
                	    'template-parts/content/global/post','comments'
                );
            ?>
        </div>
    </div>

</div>