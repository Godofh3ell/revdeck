<div class="pmpro-level-inner">
    
 
		<?php printf(
			'<h6 class="fs-small fw-500 uppercase al-center">%s</h6>',
			$level->name
		);?>
		<div class="price">
			<?php printf(
				'<h4  class="text-info al-center">%s</h4>',
				$cost_text
			);?>
       </div>
       
       
        <?php
		if( $level->description):
		printf(
			'<div class="description cl-heading">%s</div>',
			do_shortcode( $level->description )
		);
		endif;
		?>
		<div class="pmpro-plan-button al-center">
			<?php

			if ( ! $has_level ):

				printf(
					'<a class="%s" href="%s">%s</a>',
					'button button-custom',
					esc_url( pmpro_url( "checkout", "?level=" . $level->id, "https" ) ),
					esc_html__( 'Choose Plan', 'streamvid' )
				);

			else:

				if( pmpro_isLevelExpiringSoon( $user_level ) && $level->allow_signups ) {

					printf(
						'<a class="%s" href="%s">%s</a>',
						'button button-custom',
						esc_url( pmpro_url( "checkout", "?level=" . $level->id, "https" ) ),
						esc_html__( 'Renew', 'streamvid' )
					);

				} else {

					printf(
						'<a class="%s" href="%s">%s</a>',
						'button button-custom',
						esc_url( pmpro_url( "account" ) ),
						esc_html__('Your&nbsp;Level', 'streamvid' )
					);

				}

			endif;
        ?>    
		</div>
    
    
    </div>