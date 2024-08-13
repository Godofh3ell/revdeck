<?php 
$id = get_the_ID();
$years = get_post_meta($id , 'videos_years' , true);
$time = get_post_meta($id , 'videos_time' , true);
$badge = get_post_meta($id , 'videos_badge' , true);

$comment_global = jws_ci_comment_rating_get_average_ratings($id);
$imdb = get_post_meta($id , 'videos_imdb' , true);
$view = jws_get_videos_view(); 
$rating_number = get_comments_number($id);

  
?>

<div class="jws-meta-info">

<div class="jws-raring-result">
    <span data-star="<?php echo esc_attr($comment_global); ?>" style="width:<?php echo ( ( $comment_global / 5 ) * 100 ); ?>%"></span>
</div>

<?php if(!empty($imdb)) : ?>
    <div class="jws-imdb">
        <?php echo esc_html($imdb); ?>
    </div>
<?php endif; ?>

<div class="jws-view">

<?php echo sprintf( _n( '<i class="jws-icon-eye"></i> %s View', '<i class="jws-icon-eye"></i> %s Views', $view, 'streamvid' ), $view );  ?>

</div>


<div class="jws-comment-number">

   <?php echo '<i class="jws-icon-chat-dots"></i>'.$rating_number; ?>

</div>

</div>

<div class="jws-meta-info2">
    <?php 
        echo !empty($years) ? '<span class="video-years">'.$years.'</span>' : '';
        echo !empty($time) ? '<span class="video-time">'.$time.'</span>' : '';
        echo !empty($badge) ? '<span class="video-badge">'.$badge.'</span>' : '';
    ?>
</div>

<div class="jws-category">
    <?php echo jws_get_cat_list('movies_cat',' ', $id); ?>
</div>