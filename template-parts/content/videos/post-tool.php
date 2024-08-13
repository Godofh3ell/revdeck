<div class="jws-tool">

    <?php 
    
    if(function_exists('jws_like_button')) jws_like_button('videos',get_the_ID());
    if(function_exists('jws_watchlist_button')) jws_watchlist_button(get_the_ID());
    if(function_exists('jws_share_button')) jws_share_button();
    
    ?> 
</div>