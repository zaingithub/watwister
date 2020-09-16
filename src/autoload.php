<?php

$folders = glob( __DIR__ . '/*' , GLOB_ONLYDIR);

foreach($folders as $folder) {
    $files = glob( __DIR__ . '/'.$folder.'/*.php');
    if($files) {
        foreach ($files as $file) {
            require_once $file;
        }        
    } 
}