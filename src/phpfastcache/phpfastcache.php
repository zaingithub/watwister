<?php
// phpFastCache Library
require_once(dirname(__FILE__) . "/phpfastcache/3.0.0/phpfastcache.php");

// OK, setup your cache
phpFastCache::$config = array(
    "storage"       =>  "cookie", // auto, files, sqlite, apc, cookie, memcache, memcached, predis, redis, wincache, xcache
    "default_chmod" => 0777, 
	"htaccess"      => true,

    // path to cache folder, leave it blank for auto detect
	"path"          =>  $_SERVER["DOCUMENT_ROOT"] . "/wp-content",
    "securityKey"   =>  "cache",

    // MEMCACHE

	"memcache"        =>  array(
		array("127.0.0.1",11211,1),
		//  array("new.host.ip",11211,1),
	),

    // REDIS
	"redis"         =>  array(
		"host"      => "127.0.0.1",
		"port"      =>  "",
		"password"  =>  "",
		"database"  =>  "",
		"timeout"   =>  ""
	),

	"extensions"    =>  array(),


    /*
     * Fall back when old driver is not support
     */
    "fallback"  => "files",

);


// temporary disabled phpFastCache
phpFastCache::$disabled = false;



