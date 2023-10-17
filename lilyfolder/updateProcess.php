<?php
session_start();
if(!isset($_SESSION["logged"])){
    header("Location: ../login.php");
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../database.php");

// if the add song rating button is clicked
if (isset($_POST["update"])) {
    $username = $_SESSION["user"];
    $song = mysqli_real_escape_string($conn, $_POST["title"]);
    $artist = mysqli_real_escape_string($conn, $_POST["artist"]);
    $rating = mysqli_real_escape_string($conn, $_POST["rating"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
 
    // Check if $rating is within the valid range (1 to 5)
    if ($rating < 1 || $rating > 5) {
        echo "Rating must be between 1 to 5";
    }
    else {
        // Insert the new rating
        $sql = "UPDATE ratings SET artist ='$artist', song ='$song', rating='$rating' WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            $_SESSION["update"] = "Song Rating Updated Succesfully!";
            header("Location: index.php");
            die();
        } else {
            die("Something went wrong");
        }
    }
}
