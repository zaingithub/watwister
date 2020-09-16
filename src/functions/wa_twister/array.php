<?php

if( !function_exists('do_set') )
{
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

if(!function_exists('list_to_array'))
{
  function list_to_array( $data, $separator="\n" )
  {
    $output = [];
    if( !empty($data) ) {
      $data   = str_replace("\r", "", $data);
      $output = array_map('trim', explode($separator, $data));
    }
    return $output;
  }
}

function make_array_arranged( $a, $b ) {
	if ($a == 0 || $b == 0) {
		return abs(max(abs($a), abs($b)));
	}
	$r = $a % $b;
	return ($r != 0) ? make_array_arranged($b, $r) : abs($b);
}

function make_array_arranged_by_priority( $array, $a = 0 ) {
	$b = array_pop( $array );
	return ( $b === null ) ? (int) $a : make_array_arranged_by_priority( $array, make_array_arranged( $a, $b ) );
}

function to_json_response( $response )
{
	header('Content-Type: application/json');
    if( is_array($response) ) {
        echo json_encode($response);
        exit();
    }
    if( is_object($response) ) {
        echo json_encode( (array) $response );
        exit();
    }
	echo $response;
    exit();
	
}