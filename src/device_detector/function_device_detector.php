<?php

namespace Maszain;

use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Client\Browser;
use DeviceDetector\Parser\Device\DeviceParserAbstract;
use DeviceDetector\Parser\OperatingSystem;

DeviceParserAbstract::setVersionTruncation(DeviceParserAbstract::VERSION_TRUNCATION_NONE);

function DeviceDetection()
{
    $device       = new Class_Device_Detect();
    $dd           = new DeviceDetector($_SERVER['HTTP_USER_AGENT']);
    $dd->discardBotInformation();
    $dd->parse();

    $osFamily               = OperatingSystem::getOsFamily($dd->getOs('short_name'));
    $browserFamily          = Browser::getBrowserFamily($dd->getClient('short_name'));
    
    $result = array();
    $result['refferer']     = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '-';
    $result['user_agent']   = $dd->getUserAgent();
    $result['device_type']  = $dd->getDeviceName();
    $result['browser']      = $browserFamily !== false ? $browserFamily : 'Unknown';
    $result['os']           = $osFamily !== false ? $osFamily : 'Unknown';
    $result['is_bot']       = $dd->isBot();
    $result['ip_address']   = $device::ip();
    $result['is_mobile']    = $device::isMobile();
    $result['is_tablet']    = $device::isTablet();
    $result['is_phone']     = $device::isPhone();
    $result['is_desktop']   = $device::isComputer();
    $result['is_android']   = $result['os'] === 'Android' ? true : false;
    return $result;

}
