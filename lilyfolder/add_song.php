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
    <style>
        /* Adding styling to the body html document */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        header {
            color: black;
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
        }
        /* Adding styling to the overall container */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        /* Adding styling to the labels for each input typing box */
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        /* Adding styling to the login typing fields */
        input[type="text"],
        input[type="number"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-btn {
            text-align: center;
        }

        input[type="submit"] {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .back-button {
            text-align: center;
            margin-top: 20px;
        }

        .back-button a {
            text-decoration: none;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .back-button a:hover {
            background-color: #555;
        }
    </style>
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
    <div class="back-button">
        <a href="index.php">Back to Home</a>
    </div>
</body>
</html>