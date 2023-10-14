<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <h1>Music DB Sign Up!</h1>

    <p>Please fill in this form to sign up with us!</p>
    <div class="container">
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
            if(isset($_POST["submit"])){
                $userName = $_POST["username"];
                $password = $_POST["password"];
                $passwordRepeat = $_POST["repeat_password"];

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $errors = array();

                if (empty($userName) OR empty($password) OR empty($passwordRepeat)) {
                    array_push($errors, "All fileds are required");
                }

                if (strlen($password) < 8) {
                    array_push($errors, "Password must be at least 8 characters long");
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

        <p>Already have an account? <a href="#">Login Here</a></p>
    </div>
</body>
</html>