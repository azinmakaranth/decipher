<?php

$result = mysqli_connect("localhost","angelawhite","littlepussy","decipher18") or die('Am dead');

$sql = "CREATE TABLE IF NOT EXISTS `wrong` (
		  `no` int(2) NOT NULL AUTO_INCREMENT,
		  `path` varchar(100) DEFAULT NULL,
		   `current` int(2) NOT NULL,UNIQUE KEY `no` (`no`)
	);";
$ref = $result->query($sql);
if(!ref) die('Theeeernnn');
$sql = "CREATE TABLE IF NOT EXISTS `correct` (
		  `no` int(2) NOT NULL AUTO_INCREMENT,
		  `path` varchar(100) DEFAULT NULL,
		   `current` int(2) NOT NULL,UNIQUE KEY `no` (`no`)
	);";
$ref = $result->query($sql);


$sql = "CREATE TABLE IF NOT EXISTS `levels` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` varchar(200) DEFAULT NULL,
		  `als` varchar(200) DEFAULT NULL,
		  `title` varchar(1000) DEFAULT NULL,
		  `contents` varchar(1000) DEFAULT NULL,
		  `answer` varchar(1000) DEFAULT NULL,
		  `stat` int(11) DEFAULT NULL,
		  `misc` varchar(200) DEFAULT NULL,
		  UNIQUE KEY `id` (`id`)
	)";
$ref = $result->query($sql);


$sql = "CREATE TABLE IF NOT EXISTS `users` (
		  `fbuid` varchar(25) NOT NULL,
		  `name` varchar(200) DEFAULT NULL,
		  `level` int(11) DEFAULT NULL,
		  `passtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  `mob` varchar(20) DEFAULT NULL,
		  `college` varchar(200) DEFAULT NULL,
		  `email` varchar(200) DEFAULT NULL,
		  `role` int(11) DEFAULT NULL,
		  `validation` varchar(200) DEFAULT NULL,
		  `validated` int(11) DEFAULT NULL,
		  UNIQUE KEY `id` (`fbuid`)
	);";
$ref = $result->query($sql);


$sql = "CREATE TABLE IF NOT EXISTS `logs` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `user` varchar(200) DEFAULT NULL,
		  `val` varchar(2000) DEFAULT NULL,
		  `level` int(11) DEFAULT NULL,
		  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
		  UNIQUE KEY `id` (`id`)
	);";
$ref = $result->query($sql);


$sql = "CREATE TABLE IF NOT EXISTS `accesslogs` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `ip` varchar(20) DEFAULT NULL,
		  `user` varchar(200) DEFAULT NULL,
		  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
		  UNIQUE KEY `id` (`id`)
	);";
$ref = $result->query($sql);

?>
