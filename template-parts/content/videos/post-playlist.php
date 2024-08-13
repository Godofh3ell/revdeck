<?php 

$args = wp_parse_args( $args, array(
   'playlist' => $_GET['playlist'],
   'current_id'=>$id
) );

extract( $args );

$term = get_term( $playlist , 'videos_playlist' );


if(isset($term)) :

$status = get_term_meta( $playlist , 'status', true);
$thumbnail = get_term_meta( $playlist, 'playlist_image', true);
$count = $term->count;
$url = get_term_link( $term, $term->taxonomy );

?>

<div class="playlist-list">

        <?php 
        
          $args = wp_parse_args( $args, array(
                'post_type'         =>  'videos',
                'post_status'       =>  array( 'publish' ),
                'posts_per_page'    =>  -1,
                'orderby'           =>  'title',
                'order'             =>  'ASC',
                'tax_query'         =>  array(
                    array(
                        'taxonomy'  =>  $term->taxonomy,
                        'field'     =>  'term_id',
                        'terms'     =>  $playlist
                    )
                )
            ) );
            
            $posts = get_posts( $args );

          
                ?>
                <div class="playlist-header">
                    <h5><?php echo esc_html($term->name); ?></h5>
                    <div class="playlist-meta">
                        <?php 
                            $icon_class = $status == 'private' ? 'jws-icon-lock-key-fill' : 'jws-icon-globe-hemisphere-west-fill';
                            echo '<span><i class="'.$icon_class.'"></i>'.$status.'</span>';
                            printf( _n( '<span>%s video</span>', '<span>%s videos</span>', $count , 'streamvid' ), number_format_i18n( $count ) );
                        ?>
                    </div>
                </div>
                <div class="jws-videos-advanced-element jws-scrollbar">
                  <div class="videos-advanced-content layout4">
                    <?php
                    if( $posts ){
        				foreach ( $posts as $post ){
        
        					setup_postdata( $post );
                            $active = $current_id == get_the_ID() ? ' active' : '';
                            ?>
                            <div class="jws-videos-advanced-item<?php echo esc_attr($active); ?>" id="playlist-item-<?php echo get_the_ID(); ?>">
                                  
                                    <?php 
                                    
                                        get_template_part( 'template-parts/content/videos/layout/layout4' , '' , array('image_size'=>'150x90','playlist'=> $term->term_id) );
                                     
                                     ?>
                                                
                            </div>
                            <?php
                        }
                        
                        wp_reset_postdata();
                        
                    }
                    ?>
                   
                  </div>

                </div>
 </div>
<?php endif; ?>