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
    <title>Delete Rating</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
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

        h1 {
            font-size: 24px;
        }

        p {
            font-size: 18px;
        }

        .confirmation-box {
            text-align: center;
            margin-top: 20px;
        }

        .confirmation-message {
            font-size: 20px;
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
        <h1>Delete Rating</h1>
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
        if (isset($_POST['delete']) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM ratings WHERE id=$id";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["delete"] = "Song Rating Deleted Succesfully!";
                header("Location: index.php");
            }
            
        }
        ?>
        <h1>Confirm Deletion</h1>
        <p>Are you sure you want to delete this rating?</p>

        <form action="delete_rating.php?id=<?php echo $_GET['id'] ?>" method="post">
            <input type="submit" name="delete" value="Yes">
            <a href="index.php">No</a>
        </form>


        <div class="back-button">
            <a href="index.php">Back to Home</a>
        </div>
    </div>
</body>
</html>
