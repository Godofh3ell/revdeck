<?php 
$args = wp_parse_args( $args, array(
    'image_size'   =>  'full',
    'post_id'   =>  get_the_ID()
) );
extract( $args );
$know = get_post_meta($post_id , 'know' , true);
$gender = get_post_meta($post_id , 'gender' , true);
$birthday = get_post_meta($post_id , 'birthday' , true);
$address = get_post_meta($post_id , 'address' , true);
$know_as = get_post_meta($post_id , 'know_as' , true);
if(!empty($birthday)) {
    $birthday = date("d-m-Y", strtotime($birthday));
}
?>
<div class="post-media">
    <?php     
        $attach_id = get_post_thumbnail_id($post_id);
        $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
        echo !empty($image) ? $image : '';

    ?>
</div>

<h1 class="jws-title h4 hidden_tablet hidden_dektop"><?php echo get_the_title(); ?></h1>

<?php if(function_exists('jws_share_buttons')) jws_share_buttons(); ?>

<div class="person-info">
<h5>


<?php echo apply_filters( 'person_info_heading', esc_html__('Personal Info','streamvid') ); ?>

</h5>
<div class="person-info-field fs-small">


<?php


if(!empty($know)) {
    printf(
        '<div class="info-field"><h6 class="fs-small">%s</h6>%s</div>',
        esc_html__( 'Know for','streamvid' ),
        $know
    );
    
}

if(!empty($gender)) {
    printf(
        '<div class="info-field"><h6 class="fs-small">%s</h6>%s</div>',
        esc_html__( 'Gender','streamvid' ),
        $gender
    );
    
}

if(!empty($birthday)) {
    printf(
        '<div class="info-field"><h6 class="fs-small">%s</h6>%s</div>',
        esc_html__( 'Birthday','streamvid' ),
        $birthday
    );
    
}

if(!empty($address)) {
    printf(
        '<div class="info-field"><h6 class="fs-small">%s</h6>%s</div>',
        esc_html__( 'Place of Birth','streamvid' ),
        $address
    );
    
}

if(!empty($know_as)) {
    
printf(
        '<div class="info-field"><h6 class="fs-small">%s</h6>%s</div>',
        esc_html__( 'Also Known As','streamvid' ),
        $know_as
);  
    
}



 ?>


</div>


</div>