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
</head>
<body>
    <!-- Displays who is logged in -->
    <p>You are logged in as user: 
        <?php  
            if(isset($_SESSION["user"])){
                echo $_SESSION["user"];
            }
        ?></p>
    <p><a href="logout.php">Log out</a></p>

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


<p><a href="add_song.php">Add New Song Rating</a></p>
    
    <h2>List of Songs</h2>
    
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