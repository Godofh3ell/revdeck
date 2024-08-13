<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
    return;
}

?>
<div id="reviews" class="jws-Reviews comments-area">
    
    <div id="review_form_wrapper">
        <div id="review_form">
            <?php 
            
           
                
                $commenter = wp_get_current_commenter();

                $comment_form = array(
                    'title_reply'          => have_comments() ? __( 'Add a review', 'streamvid' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'streamvid' ), get_the_title() ),
                    'title_reply_to'       => __( 'Leave a Reply to %s', 'streamvid' ),
                    'title_reply_before'   => '<h5 id="reply-title" class="comment-reply-title">',
                    'title_reply_after'    => '</h5>',
                    'comment_notes_after'  => '',
                    'fields'               => array(
                        	'author' =>
                        	'<p class="comment-form-author col-xl-6 col-12"><label class="form-label">' . esc_html__('Name *','streamvid') . '</label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" aria-required="true"/></p>',
                        	'email' =>
                        	'<p class="comment-form-email col-xl-6 col-12"><label class="form-label">' . esc_html__('Email *','streamvid') . '</label><input id="email" name="email"  type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" aria-required="true"/></p>',
                    ),
                    'label_submit'  => __( 'Submit', 'streamvid' ),
                    'logged_in_as'  => '',
                    'comment_field' => '',
                );

                if ( $account_page_url = wp_login_url() ) {
                    $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'streamvid' ), esc_url( $account_page_url ) ) . '</p>';
                }

               $comment_form['comment_field'] =  ' <div class="comment-rating-field">
                  <label>'.esc_html__('Your rating','streamvid').'</label>  
                  <div id="comment_rating_stars">
                        <i class="fa fa-star" data-rating="1"></i>
                        <i class="fa fa-star" data-rating="2"></i>
                        <i class="fa fa-star" data-rating="3"></i>
                        <i class="fa fa-star" data-rating="4"></i>
                        <i class="fa fa-star" data-rating="5"></i>
                    </div>
                    <input type="hidden" name="comment_rating" id="comment_rating" value="0" required>
                </div>';
                
                $object_id = get_queried_object_id();
                if(get_post_type($object_id) == 'episodes') {
                    $comment_form['comment_field'] .= '<input type="hidden" name="redirect_to" value="'.get_the_permalink($object_id).'">';
                }

                $comment_form['comment_field'] .= '<p class="comment-form-comment"><label class="form-label" for="comment">' . esc_html__( 'Your review', 'streamvid' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';

                comment_form( apply_filters( 'jws_movie_review_comment_form_args', $comment_form ) );
            ?>
        </div>
    </div>

    <div id="comments" class="comment_top">
        <?php if ( have_comments() ) : ?>
            <ol class="comment-list">
                <?php wp_list_comments( apply_filters( 'jws_movie_review_list_args', array( 'callback' => 'jws_custom_review' ) ) ); ?>
            </ol>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
                echo '<nav class="jws-pagination-number">';
                paginate_comments_links( apply_filters( 'jws_comment_pagination_args', array(
                    'prev_text' => '<i class="jws-icon-caret-double-right"></i>',
                    'next_text' => '<i class="jws-icon-caret-double-right"></i>',
                    'type'      => 'list',
                ) ) );
                echo '</nav>';
            endif; ?>

        <?php else : ?>

            <p class="jws-noreviews"><?php _e( 'There are no reviews yet.', 'streamvid' ); ?></p>

        <?php endif; ?>
    </div>

    <div class="clear"></div>
</div>
