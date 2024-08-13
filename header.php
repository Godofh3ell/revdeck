<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage streamvid
 * @since 1.0.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" >
	<meta name="viewport" content="width=device-width, initial-scale=1" >
	<link rel="profile" href="https://gmpg.org/xfn/11" >
	<?php wp_head(); ?>
</head>
<?php  
    global $jws_option; 
?>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>
   
<div id="page" class="site">
    <?php if(function_exists('jws_header')) jws_header();
    
     $header_side = get_post_meta( get_the_ID(), 'turn_on_header_sidebar', 1 );
     
     $header_side = $header_side ? $header_side : jws_theme_get_option('enable-header-side');
     
     if($header_side) : ?>
        <div class="header-side">
            <?php  Jws_Elementor::display_header_side(); ?>
        </div>
    <?php endif; ?>
	<div id="content" class="site-content">
    <?php 
        jws_title_bar();
  
?>