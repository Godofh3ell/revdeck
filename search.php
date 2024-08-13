<?php

if( ! defined( 'ABSPATH' ) ){
    exit;
}
if(isset($_GET['post_type'])) {
    get_template_part( "archive-{$_GET['post_type']}" ); 
} else {
   get_template_part( 'index' ); 
}
