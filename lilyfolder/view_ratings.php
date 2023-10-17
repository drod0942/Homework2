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
    <title>View Rating</title>
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

        .rating-container {
            text-align: center;
            margin-top: 20px;
        }

        .rating {
            font-size: 36px;
            color: #ff9900;
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
        <h1>View Rating</h1>
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
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                include("../database.php");
                $sql = "SELECT * FROM ratings WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
        ?>
                <p>Username: </p>
                <h1><?php echo $row["username"];?></h1>

                <p>Artist: </p>
                <h1><?php echo $row["artist"];?></h1>
                
                <p>Song: </p>
                <h1><?php echo $row["song"];?></h1>

                <div class="rating-container">
                    <p>Song Rating</p>
                    <span class="rating"><?php echo $row["rating"];?></span>
                </div>

                <?php
            }
            
        ?>

        <div class="back-button">
            <a href="index.php">Back to Home</a>
        </div>
    </div>
    
</body>

</html>

