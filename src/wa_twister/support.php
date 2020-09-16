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