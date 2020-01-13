<?php
header( 'Content-Type: text/html; charset=utf-8' );
date_default_timezone_set('Europe/Moscow');
$ip = $_SERVER['REMOTE_ADDR'];
$time = date("H.i");
$list = "dispatchers-online.txt";
$i = 0;

if (isset($_GET['nick'])) {
	
	$nick = $_GET["nick"];
	$TMP_WAS_ADDED = false;
	if (!file_exists($list)){
		while ($i < 10){
			$array[$i] = Array(
				"time" => "null",
				"ip" => "null",
				"nick" => "null"
			);
			$i++;
		}
		$json = json_encode($array);
		$file = fopen($list, "a");
		$result = fwrite($file,$json); 
		fclose($file);
	}

	$list_info = file_get_contents($list);
	$tmp = json_decode($list_info, true);
	
			$i = 0;
			while ($i < 10) {
				if ($tmp[$i]["time"] != $time) {
					$array[$i] = Array(
						"time" => "null",
						"ip" => "null",
						"nick" => "null"
					);
				}
				else {
					if ($tmp[$i]["nick"] == $nick) {$TMP_WAS_ADDED = true;}
					$array[$i] = Array(
						"time" => $tmp[$i]["time"],
						"ip" => $tmp[$i]["ip"],
						"nick" => $tmp[$i]["nick"]
					);
				}
				$i++;
			}
		
	unlink($list);
	$json = json_encode($array);
	$file = fopen($list, "a");
	$result = fwrite($file,$json); 
	fclose($file);

			
		if ($TMP_WAS_ADDED != true) {
			
			$i = 0;

			$list_info = file_get_contents($list);
			$array = json_decode($list_info, true);
			
			
			while ($i < 10) {
				
					if ($tmp[$i]["nick"] == "null" and $TMP_WAS_ADDED != true) {
						$array[$i] = Array(
							"time" => $time,
							"ip" => $ip,
							"nick" => $nick
						);
						$TMP_WAS_ADDED = true;
					}
					$i++;
				}
		
			unlink($list);
			$json = json_encode($array);
			$file = fopen($list, "a");
			$result = fwrite($file,$json); 
			fclose($file);
		}
		
			$i = 0;
			$list_info = file_get_contents($list);
			$array = json_decode($list_info, true);
			while ($i < 10) {
				if ($array[$i]['nick'] != "null") {
				echo '['.$array[$i]["ip"].'] '.$array[$i]["nick"].'<br>';
				}
				$i++;
			}
}
?>