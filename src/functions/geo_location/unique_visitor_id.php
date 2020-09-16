<?php

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