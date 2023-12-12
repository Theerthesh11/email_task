<?php
session_start();
require_once "admin_functions.php";
require_once "config.php";
$token_id = isset($_SESSION['token_id']) ? $_SESSION['token_id'] : header("location:admin_login.php");
$admin_details_query = "select * from admin_details where token_id='$token_id';";
$admin_details_output = $conn->query($admin_details_query);
if (!is_bool($admin_details_output)) {
    $admin_details = $admin_details_output->fetch_assoc();
    $emp_id = $admin_details['emp_id'];
    $login_time = isset($_SESSION['login_time']) ? $_SESSION['login_time'] : header("location:admin_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="15"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="email.css">
</head>

<body>
    <div class="navigation-bar">
        <div class="top-navigation-bar-logo">
            <div class="logo">
                <img src="logo.png" alt="sitelogo">
            </div>
        </div>
        <div class="top-navigation-content">
            <div class="path">
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'I-Box Dashboard';
                ?>
                <a href="admin_dashboard.php" style="color:rgb(114, 98, 255);">
                    <?= $page ?>
                </a>
            </div>
            <div class="profile">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="vertical-navigation-bar">
            <ul>
                <br><br>
                <li><a href="?page=I-Box Dashboard"><button>I-Box Dashboard</button></a></li>
                <li><a href="?page=Admin List"><button>Admin list</button></a></li>
                <li><a href="?page=User List"><button>User list</button></a></li>
                <li><a href="?page=Login Activity"><button>Login activity</button></a></li>
                <li><a href="?page=Admin"><button>Admin</button></a></li>
            </ul>
        </div>
        <?php
        $activity = "";
        switch ($page) {
            case 'I-Box Dashboard':
        ?>
                <div class="dashboard-container">
                    <div class="dashboard-content">
                        <div class="report">
                            <h4>OVERALL REPORT</h4><br>
                        </div>
                        <div class="admin-dashboard-counts">
                            <div class="dashboard-count1">
                                <h3>Total mails</h3>
                                <?= total_ibox_mail() ?>
                            </div>
                            <div class="dashboard-count2">
                                <h3>Total Users</h3>
                                <?= total_users() ?>
                            </div>
                            <div class="dashboard-count3">
                                <h3>Total Admins</h3>
                                <?= total_admins() ?>
                            </div>
                        </div>
                        <div class="report">
                            <h4>MONTHLY REPORT (<?= date('M') ?>)</h4><br>
                        </div>
                        <div class="admin-dashboard-counts">
                            <div class="dashboard-count1">
                                <h3>Total mails</h3>
                                <?= total_ibox_mail("where MONTH(date_of_sending)=" . date('m')) ?>
                            </div>
                            <div class="dashboard-count2">
                                <h3>Total Users</h3>
                                <?= total_users("where MONTH(created_on)=" . date('m')) ?>
                            </div>
                            <div class="dashboard-count3">
                                <h3>Total Admins</h3>
                                <?= total_admins("where MONTH(created_on)=" . date('m')) ?>
                            </div>
                        </div>
                        <div class="report">
                            <h4>WEEKLY REPORT</h4>
                            <br>
                        </div>
                        <div class="admin-dashboard-counts">
                            <div class="dashboard-count1">
                                <h3>Total mails</h3>
                                <?= total_ibox_mail("where WEEK(date_of_sending)=" . date('W')) ?>
                            </div>
                            <div class="dashboard-count2">
                                <h3>Total Users</h3>
                                <?= total_users("where WEEK(created_on)=" . date('W')) ?>
                            </div>
                            <div class="dashboard-count3">
                                <h3>Total Admins</h3>
                                <?= total_admins("where WEEK(created_on)=" . date('W')) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                // activity($activity, $emp_id, $login_time);
                break;
            case 'Admin List':
            ?><div class="dashboard-container">
                    <div class="dashboard-content">
                        <div class="user_table">
                            <table class="user_list">
                                <tr style="text-align: center;color:white; background:hsla(246, 100%, 73%, 1);box-shadow:3px 3px 6px rgb(215, 212, 255);">
                                    <td style="width: 10%;">EMP ID</td>
                                    <td style="width: 20%;">NAME</td>
                                    <td style="width: 20%;">EMAIL</td>
                                    <td style="width: 10%;">ROLE</td>
                                    <td style="width: 10%;">MOBILE NO</td>
                                    <td style="width: 10%;">DOB</td>
                                    <td style="width: 10%;">JOINED</td>
                                    <td style="width: 10%;">LAST LOGIN</td>
                                </tr>
                                <?= admin_details() ?>
                        </div>
                    </div>
                </div>
            <?php
                activity($activity, $emp_id, $login_time);
                break;
            case 'User List':
            ?><div class="dashboard-container">
                    <div class="dashboard-content">
                        <table class="user_list">
                            <tr style="text-align: center;color:white; background:hsla(246, 100%, 73%, 1);">
                                <td>NAME</td>
                                <td>EMAIL</td>
                                <td>DOB</td>
                                <td>MOBILE NO</td>
                                <td>JOINED</td>
                                <td>LAST LOGIN</td>
                            </tr>
                        <?php
                        pagination("user_details", "User List", "last_login");
                        // activity($activity, $emp_id, $login_time);
                        break;
                    case 'Login Activity':
                        ?>
                            <div class="dashboard-container">
                                <div class="dashboard-content">
                                    <?php
                                    if (!isset($_POST['login'])) {
                                    ?><div class="super-admin-login">
                                            <h4>Super Admin Login</h4>
                                            <form action="admin_dashboard.php?page=Login Activity" method="post">
                                                <label for="username">Username</label><br>
                                                <input type="text" id="username" name="username" value=""><br><br>
                                                <label for="password">Password</label>
                                                <input type="password" id="password" name="password" value=""><br><br>
                                                <input type="submit" name="login" value="LOG IN">
                                                <input type="reset" value="CLEAR">
                                            </form>
                                        </div>
                                        <?php
                                    }
                                    if (isset($_POST['login'])) {
                                        require "config.php";
                                        $username = !empty($_POST['username']) ? $_POST['username'] : "";
                                        $password = !empty($_POST['password']) ? $_POST['password'] : "";
                                        $super_admin_details = "select username,password from admin_details where role='superadmin' and username='$username';";
                                        $super_admin_output = $conn->query($super_admin_details);
                                        if (!is_bool($super_admin_output)) {
                                            $super_admin_result = $super_admin_output->fetch_assoc();
                                            if ($password == $super_admin_result['password']) {
                                        ?>
                                                <div class="user_table">
                                                    <table class="user_list">
                                                        <tr style="text-align: center;color:white; background:hsla(246, 100%, 73%, 1);box-shadow:3px 3px 6px rgb(215, 212, 255);">
                                                            <td style="width: 10%;">EMP ID</td>
                                                            <td style="width: 20%;">NAME</td>
                                                            <td style="width: 20%;">ROLE</td>
                                                            <td style="width: 30%;">ACTIVITY</td>
                                                            <td style="width: 10%;">LOGIN TIME</td>
                                                            <td style="width: 10%;">LOGOUT TIME</td>
                                                        </tr>
                                                        <?php
                                                        login_activity();
                                                        ?>
                                                    </table>
                                                </div>
                                    <?php

                                            }
                                        }
                                    }
                                    // activity($activity, $emp_id, $login_time);
                                    break;
                                case 'Admin':
                                    ?>
                                    <div class="profile-container">
                                        <div class="profile_picture">
                                            <div>
                                                <h3>Profile</h3>
                                            </div>
                                            <?php
                                            require "config.php";
                                            $user_details_query = "select * from admin_details where token_id='$token_id'";
                                            $output = $conn->query($user_details_query);
                                            if (!is_bool($output)) {
                                                $result = $output->fetch_assoc();
                                                echo "<div>";
                                                if ($result['profile_status'] == 0) {
                                                    $tkn_id = bin2hex($token_id);
                                                    echo "<a href=\"?page=Admin\">";
                                                    echo "<img src='Uploads/admin/profile" . $tkn_id . ".jpg'>";
                                                } else {
                                                    echo "<a href=\"?page=Admin\">";
                                                    echo "<img src='Uploads/profiledefault.jpg'>";
                                                }
                                                echo "</a>";
                                                echo "</div>";
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (isset($_POST['logout'])) {
                                            $logout_query = "update login_activity set logout_time=current_timestamp where login_time='$login_time';";
                                            $logout_output = $conn->query($logout_query);
                                            session_unset();
                                            session_destroy();
                                            header("location:admin_login.php");
                                        }
                                        if (!isset($_POST['edit'])) {
                                        ?>
                                            <div class="user_details">
                                                <form action="admin_dashboard.php?page=Admin" enctype="multipart/form-data" method="post">
                                                    <input type="submit" name="edit" value="Edit">
                                                    <input type="submit" name="logout" value="Log out"><br><br>
                                                    <label for="emp_id">emp_id</label>
                                                    <input type="text" id="emp_id" name="emp_id" value="<?= $result['emp_id'] ?>" readonly><br><br>
                                                    <label for="email">Email</label>
                                                    <input type="text" id="email" name="email" value="<?= $result['email'] ?>" readonly><br><br>
                                                    <label for="name">Name</label>
                                                    <input type="text" id="name" name="name" value="<?= $result['name'] ?>" readonly><br><br>
                                                    <label for="username">Username</label>
                                                    <input type="text" id="username" name="username" value="<?= $result['username'] ?>" readonly><br><br>
                                                    <label for="dob">Date of birth</label>
                                                    <input type="text" id="dob" name="dob" value="<?= $result['date_of_birth'] ?>" readonly><br><br>
                                                    <label for="role">Role</label>
                                                    <input type="text" id="role" name="role" value="<?= $result['role'] ?>" readonly><br><br>
                                                    <label for="cell_number">Mobile number</label>
                                                    <input type="text" id="cell_number" name="cell_number" value="<?= $result['phone_no'] ?>" readonly><br><br>
                                                </form>
                                            </div>
                                        <?php
                                        }
                                        if (isset($_POST['edit'])) {
                                        ?>
                                            <div class="user_details">
                                                <form action="admin_dashboard.php?page=Admin" enctype="multipart/form-data" method="post">
                                                    <input type="file" name="file" id="fileInput" style="display: none;">
                                                    <label for="fileInput" style="color:rgb(114, 98, 255)">Update profile
                                                        picture</label>
                                                    <input type="submit" name="save" value="Save"><br><br>

                                                    <label for="name">Name</label>
                                                    <input type="text" id="name" name="name" value="<?= $result['name'] ?>"><br><br>
                                                    <label for="dob">Date of birth</label>
                                                    <input type="text" id="dob" name="dob" value="<?= $result['date_of_birth'] ?>"><br><br>
                                                    <label for="cell_number">Mobile number</label>
                                                    <input type="text" id="cell_number" name="cell_number" value="<?= $result['phone_no'] ?>"><br><br>
                                                </form>
                                            </div>
                                    </div>
                                <?php
                                        }

                                ?>

                        <?php
                                    if (isset($_POST['save'])) {
                                        if (!empty($_POST)) {
                                            $update_details = "update admin_details set name='{$_POST['name']}', date_of_birth='{$_POST['dob']}', phone_no='{$_POST['cell_number']}', updated_on = current_timestamp where email='{$result['email']}';";
                                            $conn->query($update_details);
                                        }
                                        if (!empty($_FILES['file'])) {
                                            $file = $_FILES['file'];
                                            $file_array = array("file_name" => $file['name'], "file_type" => $file['type'], "file_tmp_name" => $file['tmp_name'], "file_error" => $file['error'], "file_size" => $file['size']);
                                            $file_ext = explode(".", $file_array["file_name"]);
                                            $file_actual_ext = strtolower(end($file_ext));
                                            $allowed_ext = array('jpg', 'jpeg', 'png');
                                            if (in_array($file_actual_ext, $allowed_ext)) {
                                                if ($file_array['file_error'] == 0) {
                                                    if ($file_array['file_size'] < 10000000) {
                                                        $tkn_id = bin2hex($token_id);
                                                        $file_new_name = "profile" . $tkn_id . ".jpg";
                                                        $file_destination = "Uploads/admin/$file_new_name";
                                                        move_uploaded_file($file_array['file_tmp_name'], $file_destination);
                                                        $image_query = "update admin_details set profile_status=0 where token_id='{$token_id}'";
                                                        $image_query_output = $conn->query($image_query);
                                                        // header("location:email.php?page=User");
                                                    } else {
                                                        echo "Please upload a picture less than 1mb";
                                                    }
                                                } else {
                                                    echo "upload unsuccessfull!";
                                                }
                                            } else {
                                                echo "Image format must be jpg, jpeg, png";
                                            }
                                        }
                                    }
                                    // activity($activity, $emp_id, $login_time);
                                    break;
                            }
                            // activity($activity, $emp_id, $login_time);
                        ?>