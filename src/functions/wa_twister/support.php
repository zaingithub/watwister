<?php

if( !function_exists('dd') )
{
    function dd()
    {
        echo "<pre>";
        print_r(func_get_args());
        exit();       
    }    
}

function console_log( $data )
{
    if( is_array($data) ) {
        $data = json_encode($data);
    }
    else if( is_object($data) ) {
        $data = json_encode( (array) $data );
    }
    echo '<script>';
    echo 'console.log('. $data .')';
    echo '</script>';
}