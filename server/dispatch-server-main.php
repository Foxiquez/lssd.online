<?php
header( 'Content-Type: text/html; charset=utf-8' );
date_default_timezone_set('Europe/Moscow');
$server = 'sql170.main-hosting.eu';
$user = 'u261360762_gaba';
$pass = 'J17TTdjj1Tt5';
$tabl = 'u261360762_lssd';
$date = date("[Y-m-d H:i]");
$ip = $_SERVER['REMOTE_ADDR'];
$version = "0.3";
$log_txt = file_get_contents('log.txt');
if (isset($_GET['action'])) {
	if (isset($_GET['nick']) and $_GET['action'] == "CheckIfExist"){
		$nick = str_replace("_", " ", $_GET['nick']);
		$db = mysqli_connect($server, $user, $pass, $tabl);
		$q = mysqli_query($db,"SELECT username FROM phpbb_users WHERE username = '$nick'");
		$result = mysqli_fetch_array($q);
		if ($result) echo '//EXIST//'; else echo '//NULL//';
		mysqli_close($db);
	}
	else if (isset($_GET['nick']) and isset($_GET['pass']) and $_GET['action'] == "CheckPass"){
		$nick = str_replace("_", " ", $_GET['nick']);
		$db = mysqli_connect($server, $user, $pass, $tabl);
		$q = mysqli_query($db,"SELECT user_password FROM phpbb_users WHERE username = '$nick'");
		$result = mysqli_fetch_array($q);
		if (password_verify($_GET['pass'], $result[0])) {
			$q = mysqli_query($db,"SELECT user_id FROM phpbb_users WHERE username = '$nick'");
			$result = mysqli_fetch_array($q);
			$nick = $result[0];
			$q = mysqli_query($db,"SELECT group_id FROM phpbb_user_group WHERE user_id = '$result[0]'");
			$result = mysqli_fetch_all($q);
			$number = $result[1];
			if ($number[0] == 27) { echo '//VALID//HAVE//'; } else echo '//VALID//NOT//';
		} else {
			echo '//INVALID//';
		}
		mysqli_close($db);
	}
	else if (isset($_GET['nick']) and $_GET['action'] == "HavePerm"){
		$nick = str_replace("_", " ", $_GET['nick']);
		$db = mysqli_connect($server, $user, $pass, $tabl);
		$q = mysqli_query($db,"SELECT user_password FROM phpbb_users WHERE username = '$nick'");
		$result = mysqli_fetch_array($q);
		if (password_verify($_GET['pass'], $result[0])) {
			echo '//VALID//';
		} else {
			echo '//INVALID//';
		}
		mysqli_close($db);
	}
	else if (isset($_GET['dispatch']) and $_GET['action'] == "DelLog"){
		unlink("log.txt");
		$nick = $_GET['dispatch'];
		$newInfo = "$date"."[$ip]"." $nick, очищен лог действий.<br>";
		$file = fopen("log.txt", "a");
		$result = fwrite($file,$newInfo); 
		fclose($file);
	}
	else if (isset($_GET['dispatch']) and $_GET['action'] == "DelTMP"){
		unlink("tmp.json");
		unlink("log.txt");
		$nick = $_GET['dispatch'];
		$newInfo = "$date"."[$ip]"." $nick, очищена временная память сервера.<br>".$log_txt;
		$file = fopen("log.txt", "a");
		$result = fwrite($file,$newInfo); 
		fclose($file);
	}
	else if ($_GET['action'] == "getTXT"){
		echo $log_txt;
	}
	else if ($_GET['action'] == "version"){
		echo $version;
	}
	else if ($_GET['action'] == "CheckUseRadio" and isset($_GET['nick'])){
		$nick = str_replace("_", " ", $_GET['nick']);
		$db = mysqli_connect($server, $user, $pass, $tabl);
		$q = mysqli_query($db,"SELECT user_id FROM `phpbb_users` WHERE username = '$nick'");
		$id = mysqli_fetch_array($q);
		$q = mysqli_query($db,"SELECT pf_sis_use_radio FROM `phpbb_profile_fields_data` WHERE `user_id` = '$id[0]'");
		$result = mysqli_fetch_array($q);
		if ($result[0] == 1) {
			echo '//USE//';
		}
		else {
			echo '//NOT//';
		}
		mysqli_close($db);
	}
	else if ($_GET['action'] == "getID" and isset($_GET['nick'])){
		$nick = str_replace("_", " ", $_GET['nick']);
		$db = mysqli_connect($server, $user, $pass, $tabl);
		if (isset($_GET['nick_passanger']) and isset($_GET['nick_second_passanger'])) {
			$q = mysqli_query($db,"SELECT user_id FROM `phpbb_users` WHERE username = '$nick'");
			$id_one = mysqli_fetch_array($q);
			
			$nick_passanger = str_replace("_", " ", $_GET['nick_passanger']);
			$q = mysqli_query($db,"SELECT user_id FROM `phpbb_users` WHERE username = '$nick_passanger'");
			$id_two = mysqli_fetch_array($q);
			if (!$id_two) { $id_two[0] = "000"; }
			
			$nick_second_passanger = str_replace("_", " ", $_GET['nick_second_passanger']);
			$q = mysqli_query($db,"SELECT user_id FROM `phpbb_users` WHERE username = '$nick_second_passanger'");
			$id_three = mysqli_fetch_array($q);
			if (!$id_three) { $id_three[0] = "000"; }
			
			echo "//$id_one[0]//$id_two[0]//$id_three[0]//";
		}
		else if (isset($_GET['nick_passanger']) and !isset($_GET['nick_second_passanger'])) {
			$q = mysqli_query($db,"SELECT user_id FROM `phpbb_users` WHERE username = '$nick'");
			$id_one = mysqli_fetch_array($q);
			
			$nick_passanger = str_replace("_", " ", $_GET['nick_passanger']);
			$q = mysqli_query($db,"SELECT user_id FROM `phpbb_users` WHERE username = '$nick_passanger'");
			$id_two = mysqli_fetch_array($q);
			if (!$id_two) { $id_two[0] = "000"; }
			
			echo "//$id_one[0]//$id_two[0]//";
		}
		else {
			$q = mysqli_query($db,"SELECT user_id FROM `phpbb_users` WHERE username = '$nick'");
			$id = mysqli_fetch_array($q);
			echo $id[0]; 
			if (!$id) echo "000";
		}
		mysqli_close($db);
	}
}
	elseif (isset($_GET['log'])) {
		if ($_GET['log'] == "AutorizeLog" and isset($_GET['nick'])){
			unlink("log.txt");
			$nick = str_replace("_", " ", $_GET['nick']);
			$newInfo = "$date"."[$ip]"." $nick, авторизация в скрипте.<br>".$log_txt;
			$file = fopen("log.txt", "a");
			$result = fwrite($file,$newInfo); 
			fclose($file);
		}
		elseif ($_GET['log'] == "AutorizeLogFail" and isset($_GET['nick'])){
			unlink("log.txt");
			$nick = str_replace("_", " ", $_GET['nick']);
			$newInfo = "$date"."[$ip]"." $nick, неудачная авторизация в скрипте.<br>".$log_txt;
			$file = fopen("log.txt", "a");
			$result = fwrite($file,$newInfo); 
			fclose($file);
		}
		else if ($_GET['log'] == "StartOfWatchLog" and isset($_GET['nickDriver']) and isset($_GET['nickPassanger']) and isset($_GET['mark']) and isset($_GET['jetonDriver']) and isset($_GET['jetonPassanger']) and isset($_GET['type'])){
			unlink("log.txt");
			$mark = $_GET['mark'];
			$type = $_GET['type'];
			
			if ($type == "patrol") {
				$type = "патрульный экипаж.";
			}
			else if ($type == "seb") {
				$type = "SEB.";
			}
			else if ($type == "aero") {
				$type = "Air экипаж.";
			}
			else if ($type == "det") {
				$type = "экипаж детективного бюро.";
			}
			else if ($type == "dvr") {
				$type = "ДВР.";
			}
			else $type = "патрульный экипаж.";

			$nickDriver = str_replace("_", " ", $_GET['nickDriver']);
			$nickPassanger = str_replace("_", " ", $_GET['nickPassanger']);
			$jetonDriver = $_GET['jetonDriver'];
			$jetonPassanger = $_GET['jetonPassanger'];
			
			if (($nickPassanger == "null" or $nickPassanger == "not") and ($jetonPassanger == "null" or $jetonPassanger == "not") and !isset($_GET['nickSecondPassanger']) and !isset($_GET['jetonSecondPassanger'])) {
				$newInfo = "$date"."[$ip]"." #$jetonDriver $nickDriver, начал(а) смену как $mark, $type<br>".$log_txt;
			}
			else if (($nickPassanger != "null" and $nickPassanger != "not") and ($jetonPassanger != "null" and $jetonPassanger != "not") and isset($_GET['nickSecondPassanger']) and isset($_GET['jetonSecondPassanger'])) {
				$nickSecondPassanger = str_replace("_", " ", $_GET['nickSecondPassanger']);
				$jetonSecondPassanger = $_GET['jetonSecondPassanger'];
				if (isset($_GET['nickThirdPassanger']) and isset($_GET['jetonThirdPassanger'])) {
					$nickThirdPassanger = str_replace("_", " ", $_GET['nickThirdPassanger']);
					$jetonThirdPassanger = $_GET['jetonThirdPassanger'];
					$newInfo = "$date"."[$ip]"." #$jetonDriver $nickDriver & #$jetonPassanger $nickPassanger & #$jetonSecondPassanger $nickSecondPassanger & #$jetonThirdPassanger $nickThirdPassanger, начали смену как $mark, $type<br>".$log_txt;
				}
				else { $newInfo = "$date"."[$ip]"." #$jetonDriver $nickDriver & #$jetonPassanger $nickPassanger & #$jetonSecondPassanger $nickSecondPassanger, начали смену как $mark, $type<br>".$log_txt; }
			}
			$file = fopen("log.txt", "a");
			$result = fwrite($file,$newInfo); 
			fclose($file);
		}
		else if ($_GET['log'] == "EndOfWatchLog" and isset($_GET['mark'])){
			unlink("log.txt");
			$mark = $_GET['mark'];
			$newInfo = "$date"."[$ip]"." $mark, окончание патруля, снятие маркировки и отслеживания координат.<br>".$log_txt;
			$file = fopen("log.txt", "a");
			$result = fwrite($file,$newInfo); 
			fclose($file);
		}	
		else if ($_GET['log'] == "BK" and isset($_GET['mark']) and isset($_GET['nick'])){
			unlink("log.txt");
			$mark = $_GET['mark'];
			$nick = str_replace("_", " ", $_GET['nick']);
			$newInfo = "$date"."[$ip]"." $mark $nick, использована тревожная кнопка.<br>".$log_txt;
			$file = fopen("log.txt", "a");
			$result = fwrite($file,$newInfo); 
			fclose($file);
		}	
		else if ($_GET['log'] == "bkOff" and isset($_GET['mark']) and isset($_GET['nick'])){
			unlink("log.txt");
			$mark = $_GET['mark'];
			$nick = str_replace("_", " ", $_GET['nick']);
			$newInfo = "$date"."[$ip]"." $mark $nick, тревожная кнопка снята.<br>".$log_txt;
			$file = fopen("log.txt", "a");
			$result = fwrite($file,$newInfo); 
			fclose($file);
		}	
		else if ($_GET['log'] == "TrafficStop" and isset($_GET['mark']) and isset($_GET['markCar']) and isset($_GET['number']) and isset($_GET['desc'])){
			unlink("log.txt");
			$mark = $_GET['mark'];
			$markCar = $_GET['markCar'];
			$number = $_GET['number'];
			$desc = $_GET['desc'];
			if ($desc == "not") {
				$newInfo = "$date"."[$ip]"." $mark, 909 $markCar $number, дополнительное описание отсутствует.<br>".$log_txt;
			}
			else $newInfo = "$date"."[$ip]"." $mark, 909 $markCar $number, с дополнительным описанием.<br>".$log_txt;
			$file = fopen("log.txt", "a");
			$result = fwrite($file,$newInfo); 
			fclose($file);
		}	
	}
?>