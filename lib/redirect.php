<?php
function redirect($path){
    if(!headers_sent()){
        // php redirect
        die(header("Location: " . get_url($path)));
    }
    // javascript redirect
    echo "<script>window.location.href='" . get_url($path) . "';</script>";
    // metadata redirect (runs if javascript is disabled)
    echo "<noscript><meta http-equiv=\"refresh\" content=\"0;url=" . get_url($path) . "\"/></noscript>";
    die();
}