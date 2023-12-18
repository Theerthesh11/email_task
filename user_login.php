<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin_registeration page.css">
</head>

<body>
    <div class="container">
        <div class="fraction_one">
            <img src="fraction_one.jpg" alt="">
        </div>
        <div class="fraction_two">
            <div class="nav-panel">
                <a href="admin_login.php">ADMIN LOGIN</a>
            </div>
            <h2 style="text-align: center;">GRAM MAIL LOGIN</h2>
            <div class="form">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <label for="username">Username</label><br>
                    <input type="text" name="username" id="username"><br><br>
                    <label for="password">Password</label><br>
                    <input type="password" name="password"><br><br>
                    <div class="form-buttons" style="text-align: center;">
                        <input type="submit" name="login" value="LOGIN">
                        <input type="reset" value="CLEAR">
                        <h6>New user? click here to <a href="registeration_login_page.php">register</a></h6>
                    </div>
                </form>
                <?php
                if (isset($_POST['login'])) {
                    if (!empty(($_POST['username']))) {
                        //validate username

                        //assigning sanitized and validate username to username variable 
                        $username = $_POST['username'];
                        $get_query = "select * from user_details where username='{$username}';";
                        $get_query_output = $conn->query($get_query);
                        if (is_bool($get_query_output)) {
                            echo "<h6 style=\"text-align: center; color:red;\">Kindly check if the username is correct</h6>";
                        }
                    }
                    if (!empty(($_POST['password']))) {
                        //validate password

                        //assigning sanitized and validate password to password variable 
                        $password = htmlspecialchars($_POST['password']);
                        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        if (!is_bool($get_query_output)) {
                            $result = $get_query_output->fetch_assoc();
                            if (password_verify($password, $result['password'])) {
                                $_SESSION['token_id'] = bin2hex($result['token_id']);
                                header("location:email.php?page=Email&option=Inbox");
                            } else {
                                echo "<h6 style=\"text-align: center; color:red;\">Incorrect password</h6>";
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>