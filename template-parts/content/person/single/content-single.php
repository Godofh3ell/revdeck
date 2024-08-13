<?php 

$args = array(
   'image_size' => 'full',
);

?>
<div class="row">

<div class="col-xl-2 col-lg-3 col-12">

<?php 

get_template_part( 
  'template-parts/content/person/post','info',$args
);


?>

</div>

<div class="col-xl-10 col-lg-9 col-12">
<div class="person-content">
    <h1 class="jws-title h4 hidden_mobile"><?php echo get_the_title(); ?></h1>
    <div class="post-content">
    <h6><?php echo esc_html__('Biography','streamvid'); ?></h6>
    <?php the_content();?>
    </div>
</div>
<?php 

get_template_part( 
  'template-parts/content/person/post','know',$args
);


?>

</div>


</div>