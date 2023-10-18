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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            background-color: #333;
            color: white;
            padding: 10px;
            margin: 0;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group {
            margin: 10px 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
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
            background-color: #4CAF50;
        }

        .alert {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin: 10px 0;
        }

        .login-link {
            text-align: center;
        }

        .login-link a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Music DB Sign Up!</h1>

    <p>Please fill in this form to sign up with us!</p>
    <div class="container">
        <?php
            //Catches any errors
            error_reporting(E_ALL); 
            ini_set('display_errors', 1);

            // checks if submit button was clicked
            if(isset($_POST["submit"])){
                $userName = $_POST["username"];
                $password = $_POST["password"];
                $passwordRepeat = $_POST["repeat_password"];

                // Hashes the password so it is secure
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // Checks every case and sees if there are any errors
                // If so, the form is cleared and the error is displayed
                $errors = array();

                if (empty($userName) OR empty($password) OR empty($passwordRepeat)) {
                    array_push($errors, "All fileds are required");
                }

                if (strlen($password) < 10) {
                    array_push($errors, "Password must be at least 10 characters long");
                }
                //checking if password match
                if ($password != $passwordRepeat) {
                    array_push($errors, "Passwords don't match");
                }

                // Checking if there are duplicate people with username in db
                require_once "database.php";
                $sql = "SELECT * FROM users WHERE username = '$userName'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount > 0) {
                    array_push($errors, "Username already exists...");
                }

                //Checking for errors in total
                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo("<div>$error</div>");
                    }
                }
                else{
                        // We will upload the data

                        require_once "database.php";
                        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

                        if ($prepareStmt) {
                            mysqli_stmt_bind_param($stmt,"ss",$userName, $passwordHash);
                            mysqli_stmt_execute($stmt);
                            echo "<div class='alert alert-success'>You are Registered!</div>";

                        }else{
                            die("Something Went Wrong...");
                        }
                    }

            }
        ?>
        <!-- Post Form Bc we are sending information -->
        <form action="registration.php" method="post">
            <div class="form-group">
                <label for="username">Username:
                <input type="text" name="username" id="username">
                </label>
            </div>
            <div class="form-group">
            <label for="password">Password:
                <input type="password" name="password" id="password">
                </label>
            </div>
            <div class="form-group">
            <label for="repeat_password">Repeat Password:
                <input type="password" name="repeat_password" id="repeat_password">
                </label>
            </div>
            <div class="form-group">
                <input type="submit" value="Register" name="submit">
            </div>
        </form>

        <p class="login-link">Already have an account? <a href="login.php">Login Here</a></p>
    </div>
</body>
</html>