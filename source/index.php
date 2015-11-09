<?php
# 【・ヘ・?】 -- The main page of the heater control system
#  2015-11-09
#  ʕ•ᴥ•ʔ -- Morgan Aasdam
#  Public Domain

## Debug
error_reporting(E_ALL);
ini_set('display_errors', true);

## Variables
$string_data = file_get_contents("status.txt");
$heaterStatus = unserialize($string_data);

switch(trim($_GET['a'])){
	case "OFF":
		exec("sudo gpio mode 1 out");
		$heaterStatus = "OFF";
		break;
	case "ON":
		exec("sudo gpio mode 1 in");
		$heaterStatus = "ON";
		break;
	case "Scheduler":
		$heaterStatus = "SCHED";
		break;
}

## Saving Current heater status
$string_data = serialize($heaterStatus);
file_put_contents("status.txt", $string_data);

?>

<!DOCTYPE html> 
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Chaudière au Touvet</title> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
</head> 

<body> 

<div data-role="page">

	<div data-role="header">
		<h1>Bienvenue sur la page de controle de la chaudière</h1>
		<a href="schedule.php" data-icon="gear" class="ui-btn-right">Options</a>
	</div><!-- /header -->

	<div data-role="content">	
		<p><form action="index.php" method="get" data-ajax="false" >
			<input type="submit" name="a" value="OFF" <?php if($heaterStatus == "OFF") echo "data-theme=\"b\""; ?> >
			<input type="submit" name="a" value="ON" <?php if($heaterStatus == "ON") echo "data-theme=\"b\""; ?> >
			<input type="submit" name="a" value="Scheduler" <?php if($heaterStatus == "SCHED") echo "data-theme=\"b\""; ?> >
			</form></p>
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4><?php echo date("Y/m/d g:i:s"); ?></h4>
	</div><!-- /footer -->
	
</div><!-- /page -->

</body>
</html>
