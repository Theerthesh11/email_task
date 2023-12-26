<?php
session_start();
require "email_function.php";
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
            <div class="form">
                <h2 style="text-align: center;">INBOXFLOW REGISTER</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder=""><br><br>
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
                    <input type="password" name="confirm-password" id="password" placeholder=""><br><br>
                    <div class="form-buttons">
                        <input type="submit" value="REGISTER" name="register">
                        <input type="reset" value="CLEAR"><br><br>
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
                        if (!empty(($_POST['email']))) {
                            //validate email
                            //assigning sanitized and validate email to email variable 
                            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                                $_SESSION['email'] = $_POST['email'];
                                echo $_SESSION['email'];
                            } else {
                                echo "<h6 style=\"text-align: center; color:red;\">Enter a valid email</h6>";
                            }
                        }
                        if (!empty($_POST['name'])) {
                            //validate name
                            //assigning sanitized and validate name to name variable 
                            if (preg_match("/^[a-zA-Z ]*$/", $_POST['name'])) {
                                $name = $_POST['name'];
                                echo $name;
                                $created_by = $name;
                                $updated_by = $name;
                            } else {
                                echo "<h6 style=\"text-align: center; color:red;\">Name is not valid</h6>";
                            }
                        }
                        if (!empty($_POST['phone_no'])) {
                            //validate phone_no
                            if (preg_match("/^[0-9]{10}$/", $_POST['phone_no'])) {
                                $phone_no = $_POST['phone_no'];
                                echo $phone_no;
                            } else {
                                echo "<h6 style=\"text-align: center; color:red;\">Mobile number is not valid</h6>";
                            }
                        }
                        if (!empty($_POST['username'])) {
                            //validate username
                            //assigning sanitized and validate username to username variable 
                            if (preg_match("/^[a-zA-Z0-9 ]*$/", $_POST['username'])) {
                                $username = $_POST['username'];
                                $get_query = "select * from user_details where username='{$username}';";
                                $get_query_output = $conn->query($get_query);
                                print_r($get_query_output);
                                echo $username;
                                // if () {
                                //     echo "username already exist <br>";
                                // } else {
                                //     echo "username is valid <br>";
                                // }
                            } else {
                                echo "<h6 style=\"text-align: center; color:red;\">Invalid username</h6>";
                            }
                        }
                        if (!empty($_POST['password'])) {
                            //validate password
                            //assigning sanitized and validate password to password variable 
                            if (preg_match("/^[a-zA-Z0-9 ]*$/", $_POST['password'])) {
                                $password = $_POST['password'];
                                echo $password;
                            } else {
                                echo "<h6 style=\"text-align: center; color:red;\">Enter a password containing alphanumeric values</h6>";
                            }
                        }
                        if (!empty($_POST['confirm-password'])) {
                            //validate password
                            //assigning sanitized and validate password to password variable
                            if (preg_match("/^[a-zA-Z0-9 ]*$/", $_POST['confirm-password'])) {
                                if ($password == $_POST['confirm-password']) {
                                    $hash_password = password_hash($password, PASSWORD_DEFAULT);
                                    echo $password;
                                } else {
                                    echo "<h6 style=\"text-align: center; color:red;\">Password doesn't match</h6>";
                                }
                            } else {
                                echo "<h6 style=\"text-align: center; color:red;\">Enter a password containing alphanumeric values</h6>";
                            }
                        }
                        if (!empty($_POST['dateofbirth'])) {
                            if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $_POST['dateofbirth']) && strtotime($_POST['dateofbirth']) !== false) {
                                $dob = $_POST['dateofbirth'];
                                $year = substr($dob, 2, 2);
                                $date = substr($dob, 8, 9);
                                echo $dob;
                                $_SESSION['token_id'] = random(8) . $date . random(2) . "4" . random(3) . random_byte() . random(3) . random(14) . $year;
                                echo $_SESSION['token_id'];
                            } else {
                                echo "<h6 style=\"text-align: center; color:red;\">Date of Birth is not valid</h6>";
                            }
                        }
                        $register_query = "insert into user_details (token_id, email, name, date_of_birth, username, password, phone_no,last_login, created_by, created_on, updated_by, updated_on) values(UNHEX('{$_SESSION['token_id']}'), '{$_SESSION['email']}', '$name','$dob' ,'$username', '$hash_password', '$phone_no',current_timestamp, '$created_by', current_timestamp, '$updated_by', current_timestamp);";
                        if ($conn->query($register_query)) {
                            // echo "Registeration successfull</h6>";
                            mkdir("Attachments/".$_SESSION['token_id']);
                            header("location:email.php?page=Email&option=Inbox");
                        } else {
                            echo "<h6 style=\"text-align: center; color:red;\">Registeration unsuccessfull</h6>";
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>