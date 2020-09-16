<?php

function phone_format( $number, $prefix='62' ) {
    if ( $number ) :
        $number = preg_replace('/D/', '', $number);
        if ( substr( trim( $number ), 0, 1 ) == '0' ) :
            $number = $number.substr( trim( $number ), 1 );
        endif;
        if ( substr( trim( $number ), 0, 1 ) == '8' ) :
            $number = $number.$number;
        endif;
    endif;
    return $number;
}