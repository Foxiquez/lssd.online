<?php
$ip = $_SERVER['REMOTE_ADDR'];
$marks = Array(
"120C",
"120L",
"121L",
"120S",
"121S",
"122S",
"123S",
"120",
"121",
"122",
"123",
"124",
"125",
"126",
"127",
"128",
"129",
"8120L",
"8120S",
"8120",
"8121",
"8122",
"240C",
"240L",
"240S",
"240W",
"241W",
"240R",
"241R",
"240Q",
"240K9",
"240K/A",
"A60C",
"A60L",
"A60S",
"A60",
"A61"
);
if (isset($_GET['action'])){
		$i = 0;
		if ($_GET['action'] == 'SetCoords' and isset($_GET['mark']) and isset($_GET['driverName']) and isset($_GET['passangerName']) and isset($_GET['passangerSecondName']) and isset($_GET['passangerThirdName']) and isset($_GET['type']) and isset($_GET['x']) and isset($_GET['y'])){
			$json = file_get_contents("tmp.json");
			$json = json_decode($json);

			$mark = $_GET['mark'];
			$driverName = $_GET['driverName'];
			$passangerName = $_GET['passangerName'];
			$passangerSecondName = $_GET['passangerSecondName'];
			$passangerThirdName = $_GET['passangerThirdName'];
			$type = $_GET['type'];
			$x = $_GET['x'];
			$y = $_GET['y'];
			$needHelp = $_GET['needHelp'];
			while ($i < 37){
				$tmp = json_decode($json[$i], true);
				
				if ($marks[$i] ==  $mark){
				$marks[$i] = Array(
						"mark" => "$mark",
						"driver" => "$driverName",
						"passanger" => "$passangerName",
						"passanger_second" => "$passangerSecondName",
						"passanger_third" => "$passangerThirdName",
						"needHelp" => "$needHelp",
						"type" => "$type",
						"x" => "$x",
						"y" => "$y",
						"ip" => "$ip",
				);
				}
				else {
					if (file_exists("tmp.json")){
						$marks[$i] = Array(
								"mark" => $marks[$i],
								"driver" => $tmp["driver"],
								"passanger" => $tmp["passanger"],
								"passanger_second" => $tmp["passanger_second"],
								"passanger_third" => $tmp["passanger_third"],
								"needHelp" => $tmp["needHelp"],
								"type" => $tmp["type"],
								"x" => $tmp["x"],
								"y" => $tmp["y"],
								"ip" => $tmp["ip"]
						);
					}
					else {
						$marks[$i] = Array(
								"mark" => "null",
								"driver" => "null",
								"passanger" => "null",
								"passanger_second" => "null",
								"passanger_third" => "null",
								"needHelp" => "null",
								"type" => "null",
								"x" => "null",
								"y" => "null",
								"ip" => "null"
						);
					}
				}
				$marks[$i] = json_encode($marks[$i]);
				$i++;
			}
			unlink("tmp.json");
			$json = json_encode($marks);
			$file = fopen("tmp.json", "a");
			$result = fwrite($file,$json); 
			fclose($file);
		}
		else if ($_GET['action'] == 'DelCoords' and isset($_GET['mark'])){
			$json = file_get_contents("tmp.json");
			$json = json_decode($json);

			$mark = $_GET['mark'];
			while ($i < 37){
				$tmp = json_decode($json[$i], true);
				
				if ($marks[$i] ==  $mark){
				$marks[$i] = Array(
						"mark" => "$mark",
						"driver" => "null",
						"passanger" => "null",
						"passanger_second" => "null",
						"passanger_third" => "null",
						"needHelp" => "null",
						"type" => "null",
						"x" => "null",
						"y" => "null",
						"ip" => "null"
				);
				}
				else {
					if (file_exists("tmp.json")){
						$marks[$i] = Array(
								"mark" => $marks[$i],
								"driver" => $tmp["driver"],
								"passanger" => $tmp["passanger"],
								"passanger_second" => $tmp["passanger_second"],
								"passanger_third" => $tmp["passanger_third"],
								"needHelp" => $tmp["needHelp"],
								"type" => $tmp["type"],
								"x" => $tmp["x"],
								"y" => $tmp["y"],
								"ip" => $tmp["ip"]
						);
					}
					else {
						$marks[$i] = Array(
								"mark" => "null",
								"driver" => "null",
								"passanger" => "null",
								"passanger_second" => "null",
								"passanger_third" => "null",
								"needHelp" => "null",
								"type" => "null",
								"x" => "null",
								"y" => "null",
								"ip" => "null"
						);
					}
				}
				$marks[$i] = json_encode($marks[$i]);
				$i++;
			}
			unlink("tmp.json");
			$json = json_encode($marks);
			$file = fopen("tmp.json", "a");
			$result = fwrite($file,$json); 
			fclose($file);
		}
}
?>