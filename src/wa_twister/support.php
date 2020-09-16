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

if( !function_exists('do_set') ) {
  function do_set($array, $key, $and_null=false, $default=null) {
    if ( $and_null ) {
      if( is_array($array) ) {
        if ( isset($array[$key]) && !empty($array[$key]) ) :
         return $array[$key];
        endif;
      } elseif ( is_object($array) ) {
        if ( isset($array->$key) && !empty($array->$key) ) :
         return $array->$key;
        endif;
      }
    } else {
      if( is_array($array) ) {
        if ( isset($array[$key]) ) :
         return $array[$key];
        endif;
      } elseif ( is_object($array) ) {
        if ( isset($array->$key) ) :
         return $array->$key;
        endif;
      }
    }
    if( $default ) :
     return $default;
    endif;
    return false;
  }
}