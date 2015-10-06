<?php

$server="localhost";
$baza="raspored";
$user="root";
$pass="000000";
$put="/Raspored/";

$con = new PDO("mysql:dbname=" . $baza . 
		";host=" . $server . 
		"", 
			$user, $pass);
$con->exec("SET CHARACTER SET utf8");
$con->exec("SET NAMES utf8");

session_start();
