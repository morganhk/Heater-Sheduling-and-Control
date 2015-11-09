<?php
# 【・ヘ・?】 -- The Cron Job for the Heating Scheduler
#  2015-11-09
#  ʕ•ᴥ•ʔ -- Morgan Aasdam
#  Public Domain

## Debug
error_reporting(E_ALL);
ini_set('display_errors', true);

## Variables
$string_data = file_get_contents("/var/www/html/status.txt");
$heaterStatus = unserialize($string_data);

## Functions
# Turn on Heater
function turnon(){
        exec("sudo gpio mode 1 in");
        echo "on";
}

# Turn off Heater
function turnoff(){
        exec("sudo gpio mode 1 out");
        echo "off";
}

## Main
switch($heaterStatus){
	case "OFF":
        turnoff();
		break;
	case "ON":
        turnon();
        break;
	case "SCHED":
        $string_data = file_get_contents("/var/www/html/schedule.txt");
        $array = unserialize($string_data);
        $today = date("N")-1;
        $thisHour = date("G");
        
        # Key used in Schedule
        echo $today.$thisHour;
        
        # Check Schedule
		if(isset($array["".$today.$thisHour]))turnon();
			else turnoff();
		break;
}



?>
