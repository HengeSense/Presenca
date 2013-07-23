<?php

header('Content-Type:text/html; charset=UTF-8');
include_once("connection.php");

// Set the default time zone
date_default_timezone_set('America/Sao_Paulo');

// if ($globalDev != 1) {
// 	if ($_SERVER["HTTPS"] != "on") {
// 		header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
// 		exit();
// 	}
// }

include_once("core.php");
include_once("utils.php");
include_once("bcrypt.php");

$chave = "7e530ebc5e06ea3f693d4df12b06f5d0";

// Denied by dafault
$core->logado = true;

if (isset($_POST["user"]) && isset($_POST["password"])) {

	$enterprise = htmlentities(utf8_decode($_POST["enterprise"]));
	$user = htmlentities(utf8_decode($_POST["user"]));
	$password = htmlentities(utf8_decode($_POST["password"]));

	$result = $core->resourceForQuery("SELECT * FROM $core->tableUser WHERE `user`='$user' AND `enterpriseID`=$enterprise");
	
	if (mysql_num_rows ($result) != 0) {
		
		$hash = mysql_result($result, 0, "password");

		if (Bcrypt::check($password, $hash)) {

			$core->enterpriseID = mysql_result($result, 0, "enterpriseID");
			$core->user = mysql_result($result, 0, "user");
			$core->userID = mysql_result($result, 0, "id");
			$core->level = mysql_result($result, 0, "level");
			$core->group = mysql_result($result, 0, "groupID");
			
			// Create a unique random id for the given session
			do {
				$sessionKey = Bcrypt::hash($hash);
				$resultSession = $core->resourceForQuery("SELECT * FROM $core->tableUser WHERE `sessionKey`='$sessionKey'");
			} while (mysql_num_rows($resultSession) != 0);

			// When we find the id, we store it on our database
			$insert = $core->resourceForQuery("UPDATE $core->tableUser SET `sessionKey`='$sessionKey' WHERE `id`=$core->userID");

			// Only authenticate if the insertion was carried correctly
			if ($insert) {
				$core->logado = true;

				$filename = basename($_SERVER['PHP_SELF']);
				$path = str_replace($filename, '', $_SERVER['PHP_SELF']);

				setcookie($chave, $sessionKey, time() + 60*60*24*30, $path);
				header("Location: $path");
				exit;
			}
		}
	}

} elseif (isset($_COOKIE[$chave])) {

	$hash = htmlentities($_COOKIE[$chave]);
	$result = $core->resourceForQuery("SELECT * FROM $core->tableUser WHERE `sessionKey`='$hash'");

	if (mysql_num_rows($result) == 1) {
		$core->logado = true;

		$core->enterpriseID = mysql_result($result, 0, "enterpriseID");
		$core->user = mysql_result($result, 0, "user");
		$core->userID = mysql_result($result, 0, "id");
		$core->level = mysql_result($result, 0, "level");
		$core->group = mysql_result($result, 0, "groupID");
	}
}

/* SEMPRE RECEBEREMOS A VARIAVEL LOGADO COM O RESULt */

?>