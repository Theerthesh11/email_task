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
                    </div>
                </form>

            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['login'])) {
        if (!empty(($_POST['username']))) {
            //validate username

            //assigning sanitized and validate username to username variable 
            $username = $_POST['username'];
            $get_query = "select * from admin_details where username='{$username}';";
            $get_query_output = $conn->query($get_query);
            if (is_bool($get_query_output)) {
            }
        }
        if (!empty(($_POST['password']))) {
            //validate password

            //assigning sanitized and validate password to password variable 
            $password = $_POST['password'];
            $result = $get_query_output->fetch_assoc();
            if ($result['password'] == $password) {
                $emp_id = $result['emp_id'];
                $activity = "";
                $date = date("Y/m/d");
                $time = date("h:i:sa");
                $insert_query = "insert into login_activity (emp_id, activity, date, time) values('{$emp_id}','{$activity}','{$date}','{$time}')";
                $insert__output = $conn->query($insert_query);
                header("location:admin_dashboard.php");
            } else {
                echo "incorrect password";
            }
        }
    }
    ?>
</body>

</html>