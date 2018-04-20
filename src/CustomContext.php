<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 20.04.18
 * Time: 11:27
 */

namespace App;


class CustomContext
{
    public static $backendGateway;

    public static function writeLog($s) {
        $logfile = fopen("/app/var/log/bla.txt", "a");
        fwrite($logfile, "$s\n");
        fclose($logfile);
    }

}