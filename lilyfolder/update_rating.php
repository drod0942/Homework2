<?php
session_start();
if(!isset($_SESSION["logged"])){
    header("Location: ../login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Rating</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        h1 {
            font-size: 24px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        .back-button {
            display: block;
            margin-top: 20px;
            text-align: center;
        }

        .back-button a {
            text-decoration: none;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .back-button a:hover {
            background-color: #555;
        }

    </style>
</head>
<body>
    <header>
        <h1>Update Rating</h1>
    </header>
    <div class="container">
    <p>You are logged in as user: 
        <?php  
            if(isset($_SESSION["user"])){
                echo $_SESSION["user"];
            }
        ?></p>
    <p><a href="logout.php">Log out</a></p>

<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include("../database.php");

    // if the add song rating button is clicked
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "SELECT * FROM ratings WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
    }
?>
    <form action="updateProcess.php" method="post"> <!-- Specify the action for the PHP script when implementing -->
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value = "<?php echo $row["song"]; ?>" placeholder="Song Title">
            
            <label for="artist">Artist:</label>
            <input type="text" id="artist" name="artist" value = "<?php echo $row["artist"]; ?>" placeholder="Artist Name">
            
            <label for="rating">New Rating:</label>
            <input type="text" id="rating" name="rating" value = "<?php echo $row["rating"]; ?>" placeholder="New Rating">
            <input type="hidden" name="id" value='<?php echo $row['id']; ?>'>
            <input type="submit" name="update" value="edit Rating">
        </form>

<?php


?>
       
    </div>

    <div class="back-button">
            <a href="index.php">Back to Home</a>
        </div>
</body>
</html>


