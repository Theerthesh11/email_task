<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);
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
                <a href="user_login.php">USER LOGIN</a>
            </div>
            <h2 style="text-align: center;">GRAM MAIL ADMIN LOGIN</h2>
            <div class="form">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <label for="username">Username</label><br>
                    <input type="text" name="username" id="username"><br><br>
                    <label for="password">Password</label><br>
                    <input type="password" name="password" placeholder=""><br><br>
                    <div class="form-buttons">
                        <input type="submit" name="login" value="LOGIN">
                        <input type="reset" value="CLEAR">
                        <h6>Click here to register as <a href="admin_registeration page.php">Admin</a></h6>
                </form>
                <?php
                if (isset($_POST['login'])) {
                    if (!empty(($_POST['username']))) {
                        //validate username
                        //assigning sanitized and validate username to username variable 
                        if (preg_match("/^[a-zA-Z0-9 ]*$/", $_POST['username'])) {
                            $username = htmlspecialchars($_POST['username']);
                            $get_query = "select * from admin_details where username='{$username}';";
                            $get_query_output = $conn->query($get_query);
                            if ($get_query_output->num_rows == 0) {
                                echo "<h6 style=\"text-align: center; color:red;\">Kindly check if the username is correct</h6>";
                            }
                        } else {
                            echo "username must be a alphanumeric";
                        }
                    }
                    if (!empty(($_POST['password']))) {
                        //validate password
                        //assigning sanitized and validate password to password variable 
                        if (preg_match("/^[a-zA-Z0-9 ]*$/", $_POST['password'])) {
                            $password = htmlspecialchars($_POST['password']);
                            if ($get_query_output->num_rows > 0) {
                                $result = $get_query_output->fetch_assoc();
                                if (password_verify($password, $result['password'])) {
                                    $emp_id = $result['emp_id'];
                                    $username=$result['username'];
                                    $name = $result['name'];
                                    $role = $result['role'];
                                    $_SESSION['token_id'] = $result['token_id'];
                                    $activity = "";
                                    date_default_timezone_set('Asia/Kolkata');
                                    $login_time = date('y-m-d H:i:s');
                                    $activity_insert_query = "insert into login_activity (emp_id,username,name,role, activity, login_time) values('$emp_id','$username','$name','$role','$activity','$login_time')";
                                    $activity_insert_output = $conn->query($activity_insert_query);
                                    $login_update_query = "update admin_details set last_login=current_timestamp;";
                                    $login_update_output = $conn->query($login_update_query);
                                    $_SESSION['login_time'] = $login_time;
                                    header("location:admin_dashboard.php?page=I-Box Dashboard");
                                } else {
                                    echo "<h6 style=\"text-align: center; color:red;\">Incorrect password</h6>";
                                }
                            } else {
                                echo "<h6 style=\"text-align: center; color:red;\">User not found</h6>";
                            }
                        }
                    } else {
                        echo "<h6 style=\"text-align: center; color:red;\">Incorrect password</h6>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    </div>
</body>

</html>