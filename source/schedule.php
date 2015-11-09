<?php 
# 【・ヘ・?】 -- Page that sets the schedule
#  2015-11-09
#  ʕ•ᴥ•ʔ -- Morgan Aasdam
#  Public Domain

## Debug
error_reporting(E_ALL);
ini_set('display_errors', true);

## Update Schedule
if (isset($_POST['sub']) && sizeof($_POST['sub']) > 0){
	$string_data = serialize($_POST);
	file_put_contents("schedule.txt", $string_data);
}

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
		<a href="index.php" data-icon="arrow-l" class="ui-btn-left">Retour</a>
	</div><!-- /header -->

	<div data-role="content">	
		<p><form action="schedule.php" method="post" data-ajax="false">
			<input type="submit" name="sub" value="Mettre à jour">
			<?php
				## Create Schedule
				$dow = array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
				$string_data = file_get_contents("schedule.txt");
				$array = unserialize($string_data);

				for ($i = 0; $i < 7; $i++){
					echo "<fieldset data-role=\"controlgroup\" data-type=\"horizontal\">";
					echo "<h3 class=\"ui-bar ui-bar-a ui-corner-all\">".$dow[$i]."</h3>";
					for ($j = 0; $j < 24; $j++){
						if ($j == 12) echo "</fieldset><fieldset data-role=\"controlgroup\" data-type=\"horizontal\">";
						echo "<input type=\"checkbox\" name=\"".$i.$j."\" id=\"".$i.$j."\"";
						if (isset($array["".$i.$j])) echo " checked";
						echo ">";
						echo "<label for=\"".$i.$j."\">".(($j<10)?"0".$j:$j).":00</label>";
				}
				echo "</fieldset>";
			}
		?>
		<input type="submit" name="sub" value="Mettre à jour">
	</form>
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4><?php echo date("Y/m/d g:i:s"); ?></h4>
	</div><!-- /footer -->
	
</div><!-- /page -->

</body>
</html>
