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
                        if (preg_match("/^[a-zA-Z0-9 ]*$/", $_POST['username'])) {
                            $username = htmlspecialchars($_POST['username']);
                            $get_query = "select * from user_details where username='{$username}';";
                            $get_query_output = $conn->query($get_query);
                            if ($get_query_output->num_rows == 0) {
                                echo "<h6 style=\"text-align: center; color:red;\">Kindly check if the username is correct</h6>";
                            }
                        } else {
                            echo "<h6 style=\"text-align: center; color:red;\">Username must be a alphanumeric</h6>";
                        }
                    }
                    if (!empty(($_POST['password']))) {
                        //validate password
                        //assigning sanitized and validate password to password variable
                        if (preg_match("/^[a-zA-Z0-9 ]*$/", $_POST['password'])) {;
                            $password = htmlspecialchars($_POST['password']);
                            if ($get_query_output->num_rows > 0) {
                                $result = $get_query_output->fetch_assoc();
                                if (password_verify($password, $result['password'])) {
                                    $_SESSION['token_id'] = $result['token_id'];
                                    $last_login = "update user_details set last_login=current_timestamp where token_id='{$_SESSION['token_id']}';";
                                    $last_login_update = $conn->query($last_login);
                                    header("location:email.php?page=Email&option=Inbox");
                                } else {
                                    echo "<h6 style=\"text-align: center; color:red;\">Incorrect password</h6>";
                                }
                            }
                        } else {
                            echo "<h6 style=\"text-align: center; color:red;\">password must be a alphanumeric value</h6>";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>