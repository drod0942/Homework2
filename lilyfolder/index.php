<!-- Checks whether a user is not logged in, if so, they are thrown back to login -->
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
    <title>User Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .upper-cont {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: right;
        }

        h1 {
            color: black;
            padding: 10px;
        }

        p {
            margin: 0;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .action-links a {
            margin-right: 10px;
            text-decoration: none;
        }

        .action-links a:hover {
            color: #333;
            background-color: #f2f2f2;
        }

        .success-message {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin: 10px;
        }

        .btn {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
        }

        .btn2{
            float: right;
            text-decoration: none; 
            margin-right: 20px
        }

        .btn:hover {
            background-color: #4CAF50;
        }

    </style>
</head>
<body>

    <div class="upper-cont">
        <!-- Displays who is logged in -->
        <p style="float: left;">You are logged in as user: 
        <?php  
            if(isset($_SESSION["user"])){
                echo $_SESSION["user"];
            }
        ?></p>
        <a href="logout.php" class="btn">Log out</a>
    </div>


    <!-- Displays Success Messages after creating, updating, and deleting data -->
    <?php
        if (isset($_SESSION["create"])) {
            ?>
            <div>
                <?php
                    echo $_SESSION["create"];
                    unset($_SESSION["create"]);
                ?>
            </div>
            <?php
        }
    ?>
        <?php
        if (isset($_SESSION["update"])) {
            ?>
            <div>
                <?php
                    echo $_SESSION["update"];
                    unset($_SESSION["update"]);
                ?>
            </div>
            <?php
        }
    ?>
        <?php
        if (isset($_SESSION["delete"])) {
            ?>
            <div>
                <?php
                    echo $_SESSION["delete"];
                    unset($_SESSION["delete"]);
                ?>
            </div>
            <?php
        }
    ?>

<h1>Song Ratings</h1>


<p><a href="add_song.php" class="btn btn2">Add New Song Rating</a></p>
    
    <h2 style="margin-left: 10px;">List of Songs</h2>
    
    <table border="1">
        <thread>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Artist</th>
            <th>Song</th>
            <th>Rating</th>
            <th>Action</th>
        </tr>
        </thread>
        <!-- Add table rows with data here -->
        <tbody>
            <?php
            include("../database.php");
            $sql = "SELECT * FROM ratings";
            $result = mysqli_query($conn, $sql);

            // Get the username of the currently logged-in user
            $loggedInUser = $_SESSION["user"];
            
            while($row = mysqli_fetch_array($result)){
             ?>
                <tr>
                    <!-- Sets the Column names for the ratings table -->
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["username"] ?></td>
                    <td><?php echo $row["artist"] ?></td>
                    <td><?php echo $row["song"] ?></td>
                    <td><?php echo $row["rating"] ?></td>
                    <td>
                        <a href="view_ratings.php?id=<?php echo $row["id"] ?>">View</a>
                        <!-- Only allows logged in users to edit and delete their own songs -->
                        <?php
                            if ($loggedInUser == $row["username"]) {
                        ?>
                                <a href="update_rating.php?id=<?php echo $row["id"]?>">Update</a>
                                <a href="delete_rating.php?id=<?php echo $row["id"]?>">Delete</a>
                        <?php
                            }
                        ?>
                    </td>
                </tr>
             <?php  
            }

            ?>
        </tbody>
    </table>
    
</body>
</html>
</body>
</html>