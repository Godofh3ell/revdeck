<?php $id = get_the_ID(); ?>
<div class="jws-tool">

    <?php if(function_exists('jws_like_button')) jws_like_button('movies',$id); ?>
    <?php if(function_exists('jws_share_button')) jws_share_button(); ?>
    <?php if(function_exists('jws_watchlist_button')) jws_watchlist_button($id); ?>
</div>

 <?php if(function_exists('jws_download_button')) jws_download_button(); ?>