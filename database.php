<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "music_db";

// Retusn true or falls if there is any errors connecting with the database
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("SOmething Went Wrong...");
}

?>