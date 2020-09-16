<?php

require_once __DIR__ . '/phpfastcache/phpfastcache.php';

$folders = glob( __DIR__ . '\functions\*' , GLOB_ONLYDIR);

foreach($folders as $folder) {
    $files = glob( $folder . '/*.php');
    if($files) {
        foreach ($files as $file) {
            require_once $file;
        }        
    } 
}