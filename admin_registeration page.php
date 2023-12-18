<?php
session_start();
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
                <A href="user_login.php">USER LOGIN</a>
            </div>
            <h2 style="text-align: center;">GRAM MAIL ADMIN REGISTER</h2>
            <div class="form">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <label for="employee_id">Employee ID</label>
                    <input type="text" name="emp_id" id="employee_id" placeholder=""><br><br>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder=""><br><br>
                    <label for="role">Role</label>
                    <select name="role" id="role">
                        <option value="admin">ADMIN</option>
                        <option value="superadmin">SUPERADMIN</option>
                    </select><br><br>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder=""><br><br>
                    <label for="phone_no">Phone number</label>
                    <input type="text" name="phone_no" id="phone_no" placeholder=""><br><br>
                    <label for="dateofbirth">DOB</label>
                    <input type="date" name="dateofbirth" required><br><br>
                    <label for="username">User name</label>
                    <input type="text" name="username" id="username" placeholder=""><br><br>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder=""><br><br>
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" name="confirm-password" id="password"><br><br>
                    <div class="form-buttons">
                        <input type="submit" value="REGISTER" name="register">
                        <input type="reset" value="CLEAR"><br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include 'config.php';
    $name = "";
    $email = "";
    $password = "";
    $username = "";
    $phone_no = "";
    $dob = "";
    $created_by = "";
    $updated_by = "";

    if (isset($_POST['register'])) {
        if (!empty(($_POST['emp_id']))) {
            $emp_id = $_POST['emp_id'];
        }
        if (!empty(($_POST['email']))) {
            //validate email

            //assigning validate email to email variable 
            $_SESSION['email'] = $_POST['email'];
        }
        if (!empty(($_POST['role']))) {
            //validate name

            //assigning validate name to name variable 
            $role = $_POST['role'];
        }
        if (!empty(($_POST['name']))) {
            //validate name

            //assigning validate name to name variable 
            $name = $_POST['name'];
            $created_by = $name;
            $updated_by = $name;
        }
        if (!empty(($_POST['phone_no']))) {
            //validate phone_no

            //assigning validate phone_no to phone_no variable 
            $phone_no = $_POST['phone_no'];
        }
        if (!empty(($_POST['username']))) {
            //validate username

            //assigning validate username to username variable 
            $username = $_POST['username'];
            $get_query = "select * from mail_list where username='$username';";
            $get_query_output = $conn->query($get_query);
            if ($get_query_output->num_rows > 0) {
                echo "username already exist <br>";
            } else {
                echo "username is valid <br>";
            }
        }
        if (!empty(($_POST['password']))) {
            //validate password

            //assigning validate password to password variable 
            $password = $_POST['password'];
        }
        if (!empty($_POST['confirm-password'])) {
            //validate password

            //assigning validate password to password variable
            if ($password == $_POST['confirm-password']) {
                $password = $_POST['password'];
            } else {
                echo "Password doesn't match";
            }
        }
        $get_query = "select token_id from user_details where email='{$email}';";
        $get_query_output = $conn->query($get_query);
        if (is_bool($get_query)) {
            $result = $get_query_output->fetch_assoc();
            $token_id = $result['token_id'];
        } elseif (!empty($_POST['dateofbirth'])) {
            $dob = $_POST['dateofbirth'];
            // $year = substr($dob, 2, 2);
            // $month = substr($dob, 5, 2);
            // switch ($month) {
            //     case '01':
            //         $month = 'JAN';
            //         break;
            //     case '02':
            //         $month = 'FEB';
            //         break;
            //     case '03':
            //         $month = 'MAR';
            //         break;
            //     case '04':
            //         $month = 'APR';
            //         break;
            //     case '05':
            //         $month = 'MAY';
            //         break;
            //     case '06':
            //         $month = 'JUN';
            //         break;
            //     case '07':
            //         $month = 'JUL';
            //         break;
            //     case '08':
            //         $month = 'AUG';
            //         break;
            //     case '09':
            //         $month = 'SEP';
            //         break;
            //     case '10':
            //         $month = 'OCT';
            //         break;
            //     case '11':
            //         $month = 'NOV';
            //         break;
            //     case '12':
            //         $month = 'DEC';
            //         break;
            // }
            // $date = substr($dob, 8, 9);
            function random($length)
            {
                $result = substr(str_shuffle('1234567890ABCDEF'), 0, $length);
                return $result;
            }
            function random_byte()
            {
                return substr(str_shuffle('89AB'), 0, 1);
            }
            $_SESSION['token_id'] = hex2bin(random(8) . $date . random(2) . "4" . random(3) . random_byte() . random(3) . random(14) . $year);
            // echo $_SESSION['token_id'];
        }
        $register_query = "insert into admin_details (token_id, emp_id, email, role, name, date_of_birth, username, password, phone_no,last_login, created_by, created_on, updated_by, updated_on) values(unhex({$_SESSION['token_id']}), '$emp_id', '{$_SESSION['email']}','$role','$name','$dob' ,'$username', '$password', '$phone_no',current_timestamp ,'$created_by', current_timestamp, '$updated_by', current_timestamp);";
        if ($conn->query($register_query)) {
            header("location:admin_dashboard.php");
        } else {
            echo "Registeration unsuccessfull";
        }
    }

    ?>
</body>

</html>