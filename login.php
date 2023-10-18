<!-- Checks whether a user is already logged in, if so, it throws them to index.php -->
<?php
session_start();
if(isset($_SESSION["logged"])){
    header("Location: ./lilyfolder/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
<h1>Welcome to Music DB!</h1>

<h2>Login</h2>

<p>Please fill your credentials to login.</p>
    <div class="container">
    <?php
    
        //catches any errors
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        //check if login btn is pressed
        if (isset($_POST["login"])) {

            // Gets input from the form submitted
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Checking if credentials exist
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if ($user) {
                // Now that we know username exists, check if password matches
                if (password_verify($password, $user["password"])) {

                    //start a new session 
                    session_start();
                    $_SESSION["user"] = $username;
                    $_SESSION["logged"] = "yes";
                    header("Location: ./lilyfolder/index.php");
                    die();
                } else {
                    echo "<div>Password doesn't match!</div>";
                }
            }
            else {
                echo "<div>Username doesn't exist! Sign up now!</div>";
            }
        }
        //Used minor AI help was used
?>

        <form action="login.php" method="post">
            <div class="form-group">
            <label for="username">Enter Username:
                <input type="text" name="username" id="username">
                </label>
            </div>
            <div class="form-group">
            <label for="password">Enter Password:
                <input type="password" name="password" id="password">
                </label>
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login">
            </div>
        </form>
    </div>
    <p>Don't have an account? <a href="registration.php">Sign-Up Here</a></p>

</body>
</html>