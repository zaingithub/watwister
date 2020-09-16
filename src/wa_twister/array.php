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

if(!function_exists('visitor_unique_id'))
{
  function visitor_unique_id($ip=null)
  {
      $useragent    = do_set($_POST, 'user_agent', true, $_SERVER['HTTP_USER_AGENT']);      
      $unique_id    = $useragent.$_SERVER['SERVER_ADDR'].$_SERVER['SERVER_ADDR'];
      if( !$ip ) {
          $device   = new \Maszain\Class_Device_Detect();
          $ip       = $device::ip();
      }
      $unique_id    = $unique_id . $ip;
      return md5($unique_id);

  }
}