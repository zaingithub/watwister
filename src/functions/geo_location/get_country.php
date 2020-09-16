<?php

function get_visitor_ip_address()
{
    $device   = new \Maszain\Class_Device_Detect();
    return $device::ip();   
}

function get_visitor_country_id_from_file( $ip = null ) {
    $ip      = ( !$ip ) ? get_visitor_ip_address() : $ip;
	$numbers = preg_split( "/\./", $ip );
	$ip_ID   = 'unknown';    
    $ip_file = dirname( __DIR__ , 2) . '/ip/'.$numbers[0].'.php';    
	if ( isset( $numbers[0] ) && $numbers[0] && file_exists( $ip_file ) ) {
		include_once $ip_file;
		$code = ( $numbers[0] * 16777216 ) + ( $numbers[1] * 65536 ) + ( $numbers[2] * 256 ) + ( $numbers[3] );
		foreach ( $ranges as $key => $value ) {
			if ( $key <= $code ) {
				if( $ranges[$key][0] >= $code ) {
					$ip_ID = $ranges[$key][1];
					break;
				}
			}
		}
	}    
	return $ip_ID;
}

function get_visitor_country_id_from_geoplugin( $ip, $as_id = true )
{
    $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
    if( $as_id ) {
        if(property_exists($ipdat, 'geoplugin_countryCode')) {
            return $ipdat->geoplugin_countryCode;
        }
    }
    return $ipdat;
}

function get_visitor_country( $ip ) {
    $country = '';
	if ( isset( $_SERVER["HTTP_CF_IPCOUNTRY"] ) && $_SERVER["HTTP_CF_IPCOUNTRY"] ) {
		$country = $_SERVER["HTTP_CF_IPCOUNTRY"];
	}
	else {
        if ( in_array( $ip , array('::1', '127.0.0.1', 'localhost') ) || $_SERVER['HTTP_HOST'] === 'localhost' ) {
            $country = 'localhost';
        }
        else {
            $country = get_visitor_country_id_from_file( $ip );
        }
	}
  return $country;
}