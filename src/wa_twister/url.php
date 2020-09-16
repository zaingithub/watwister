<?php

function get_current_url( $query = false )
{
    $uri = $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST'];
    if( !$query ) {
        $uri .= explode('?', $_SERVER['REQUEST_URI'], 2)[0];       
    } else {
        $uri .= $_SERVER['REQUEST_URI']; 
    }
    return $uri;
}