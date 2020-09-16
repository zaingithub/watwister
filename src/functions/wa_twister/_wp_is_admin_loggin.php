<?php

if(!function_exists('is_admin_logged_in')){
  function is_admin_logged_in()
  {
      return ( is_user_logged_in() && current_user_can( 'manage_options' ) );
  }
}