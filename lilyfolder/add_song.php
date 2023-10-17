<?php
session_start();
if(!isset($_SESSION["logged"])){
    header("Location: ../login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a new song</title>
</head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../database.php");

// if the add song rating button is clicked
if (isset($_POST["addSong"])) {
    $username = $_SESSION["user"];
    $song = mysqli_real_escape_string($conn, $_POST["title"]);
    $artist = mysqli_real_escape_string($conn, $_POST["artist"]);
    $rating = mysqli_real_escape_string($conn, $_POST["rating"]);

    // Check if the user has already rated this song
    $checkSql = "SELECT * FROM ratings WHERE song = ? LIMIT 1";
    $checkStmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($checkStmt, "s", $song);
    mysqli_stmt_execute($checkStmt);
    $result = mysqli_stmt_get_result($checkStmt);

    if (mysqli_num_rows($result) > 0) {
        // User has already rated this song, display an error
        echo "This song has already been rated!";
    } 
    // Check if $rating is within the valid range (1 to 5)
    else if ($rating < 1 || $rating > 5) {
        echo "Rating must be between 1 to 5";
    }else {
        // Insert the new rating
        $insertSql = "INSERT INTO ratings (username, artist, song, rating) VALUES (?, ?, ?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertSql);
        mysqli_stmt_bind_param($insertStmt, "sssi", $username, $artist, $song, $rating);

        if (mysqli_stmt_execute($insertStmt)) {
            $_SESSION["create"] = "Song Rating Added Succesfully!";
            header("Location: index.php");
            die();            
        } else {
            die("Something went wrong");
        }
    }
}




// Some GPT assistance used
?>
    <div class="container">
    <p>You are logged in as user: 
        <?php  
            if(isset($_SESSION["user"])){
                echo $_SESSION["user"];
            }
        ?></p>
    <p><a href="logout.php">Log out</a></p>
    <header>
        <h1>Add a new song!</h1>
        <p><a href="index.php">Go Back</a></p>
    </header>
    <form action="add_song.php" method="post">

        <div class="form-group">
            <label for="title">Enter Song Title:
                <input type="text" name="title" id="title">
                </label>
            </div>
            <div class="form-group">
            <label for="artist">Enter Song Artist:
                <input type="text" name="artist" id="artist">
                </label>
            </div>
            <div class="form-group">
            <label for="rating">Enter Song Rating (1 - 5):
                <input type="number" name="rating" id="rating">
                </label>
            </div>
            <div class="form-btn">
                <input type="submit" value="Submit Song Rating" name="addSong">
        </div>

    </form>


    </div>
</body>
</html>