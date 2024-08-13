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
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<?php  
    global $jws_option; 
?>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
      
<div id="page" class="site">
    <?php 
    
        if(isset($jws_option['404-off-header']) && !$jws_option['404-off-header']) {
           jws_header();  
        }

    ?>
	<div id="content" class="site-content">
    <?php 
        
    if(isset($jws_option['404-off-titlebar']) && !$jws_option['404-off-titlebar']) {
        jws_title_bar();  
    }
      
   
?>