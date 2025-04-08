<?php 
include "includes/title.php";
session_start();
?>
<!DOCTYPE html>
<!--Aidan Scott-->
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Music - Ajei">
		<meta name="keywords" content="Music,Guitar,Song,Album,Solo,Artist">
		<title>AJEI<?php if(isset($title)) {echo " &mdash; $title";} ?></title>
        <link rel="stylesheet" href="styles/mainStyles.css">
        <link rel="stylesheet" href="styles/home.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans+Extra+Condensed:ital,wght@0,1..1000;1,1..1000&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: Sofia Sans Extra Condensed;
            }
        </style>
    </head>
    <body>
        <header>
            <a href="index.php"><img src="media/images/ajei_logo_dark.png" alt="AJEI Logo"></a>
        </header>
    <?php require "includes/menu.php";?>
        