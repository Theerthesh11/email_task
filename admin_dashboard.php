<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);
require_once "admin_functions.php";
require_once "config.php";
$token_id = isset($_SESSION['token_id']) ? $_SESSION['token_id'] : header("location:admin_login.php");
$admin_details_query = "select * from admin_details where token_id='$token_id';";
$admin_details_output = $conn->query($admin_details_query);
if ($admin_details_output->num_rows > 0) {
    $admin_details = $admin_details_output->fetch_assoc();
    $emp_id = $admin_details['emp_id'];
    $login_time = isset($_SESSION['login_time']) ? $_SESSION['login_time'] : header("location:admin_login.php");
} else {
    header("location:admin_login.php");
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
    <link rel="stylesheet" href="admin.css">
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
                <a href="admin_dashboard.php?page=<?= $_GET['page'] ?>" style="color:rgb(114, 98, 255);">
                    <?= $page ?>
                </a>
            </div>
            <div class="profile">
                <?php require "profile_picture.php" ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="vertical-navigation-bar">
            <ul>
                <br><br>
                <li><a href="?page=I-Box Dashboard"><button <?= isset($_GET['page']) && $_GET['page'] === 'I-Box Dashboard' ? '" class="active"' : '' ?>>I-Box Dashboard</button></a></li>
                <li><a href="?page=Admin List"><button <?= isset($_GET['page']) && $_GET['page'] === 'Admin List' ? '" class="active"' : '' ?>>Admin list</button></a></li>
                <li><a href="?page=User List"><button <?= isset($_GET['page']) && $_GET['page'] === 'User List' ? '" class="active"' : '' ?>>User list</button></a></li>
                <li><a href="?page=Login Activity"><button <?= isset($_GET['page']) && $_GET['page'] === 'Login Activity' ? '" class="active"' : '' ?>>Login activity</button></a></li>
                <li><a href="?page=Admin"><button <?= isset($_GET['page']) && $_GET['page'] === 'Admin' ? '" class="active"' : '' ?>>Admin</button></a></li>
                <li><a href="?page=Access"><button <?= isset($_GET['page']) && $_GET['page'] === 'Access' ? '" class="active"' : '' ?>>Access</button></a></li>
            </ul>
        </div>
        <?php
        $activity = "";
        switch ($page) {
            case 'I-Box Dashboard':
                $activity .= "I-Box Dashboard";
        ?>
                <div class="dashboard-container">
                    <div class="dashboard-content">
                        <?php
                        if ($admin_details['ibox_dashboard'] == 1) {
                        ?>
                            <div class="report">
                                <h4>OVERALL REPORT</h4><br>
                            </div>
                            <div class="admin-dashboard-counts">
                                <div class="dashboard-count1">
                                    <h3>Total mails</h3>
                                    <?= total_ibox_mail() ?>
                                </div>
                                <div class="dashboard-count2">
                                    <a href="admin_dashboard.php?page=User List" style="display: block;padding: 10px 25px 40px 25px;margin: -10px;color:black">
                                        <h3>Total Users</h3>
                                        <?= total_users() ?>
                                    </a>
                                </div>
                                <div class="dashboard-count3">
                                    <a href="admin_dashboard.php?page=Admin List" style="display: block;padding: 10px 25px 40px 25px;margin: -10px;color:black">
                                        <h3>Total Admins</h3>
                                        <?= total_admins() ?>
                                    </a>
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
                                    <a href="admin_dashboard.php?page=User List" style="display: block;padding: 10px 25px 40px 25px;margin: -10px;color:black">
                                        <h3>Total Users</h3>
                                        <?= total_users("where MONTH(created_on)=" . date('m')) ?>
                                    </a>
                                </div>
                                <div class="dashboard-count3">
                                    <a href="admin_dashboard.php?page=Admin List" style="display: block;padding: 10px 25px 40px 25px;margin: -10px;color:black">
                                        <h3>Total Admins</h3>
                                        <?= total_admins("where MONTH(created_on)=" . date('m')) ?>
                                    </a>
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
                        } else {
            ?>
                <div class="restricted-access">
                    <h3>Access restricted</h3>
                    <img src="lock.jpg" alt="lock">
                </div>
            <?php
                        }
                        break;
                    case 'Admin List':
                        $activity .= "Admin List";
            ?><div class="dashboard-container">
                <div class="dashboard-content">
                    <?php
                        if ($admin_details['admin_list'] == 1) {
                    ?>
                        <form action="admin_dashboard.php?page=Admin List&page_no=<?= $_GET['page_no'] ?>" method="post">
                            <div class="access-options">
                                <div class="search">
                                    <input type="search" name="search" placeholder="abc@gmail.com">
                                    <input type="submit" name="search-btn" value="Search">
                                </div>
                            </div>
                            <div class="user_table">
                                <table class="user_list">
                                    <tr style="text-align: center;color:white; background:hsla(246, 100%, 73%, 1);box-shadow:3px 3px 6px rgb(215, 212, 255);">
                                        <th style="width: 10%;">EMP ID</th>
                                        <th style="width: 18%;">NAME</th>
                                        <th style="width: 20%;">EMAIL</th>
                                        <th style="width: 10%;">ROLE</th>
                                        <th style="width: 10%;">MOBILE NO</th>
                                        <th style="width: 10%;">DOB</th>
                                        <th style="width: 10%;">JOINED</th>
                                        <th style="width: 12%;">LAST LOGIN</th>
                                    </tr>
                                    <?= admin_details() ?>
                            </div>
                </div>
            </div>
        <?php
                        } else {
        ?>
            <div class="restricted-access">
                <h3>Access restricted</h3>
                <img src="lock.jpg" alt="lock">
            </div>
        <?php
                        }
                        // activity($activity, $emp_id, $login_time);
                        break;
                    case 'User List':
                        $activity .= "User List";
        ?><div class="dashboard-container">
            <div class="dashboard-content">
                <?php
                        if ($admin_details['user_list'] == 1) {
                ?>
                    <form action="admin_dashboard.php?page=User List&page_no=<?= $_GET['page_no'] ?>" method="post">
                        <div class="access-options">
                            <div class="search">
                                <input type="search" name="search" placeholder="abc@gmail.com">
                                <input type="submit" name="search-btn" value="Search">
                            </div>
                            <div class="grant-access">
                                <input type="submit" name="grant_delete_access" value="Grant Access">
                                <input type="submit" name="block_delete_access" value="Block Access"><br><br>
                            </div>
                        </div>
                        <table class="user_list">
                            <tr style="text-align: center;color:white; background:hsla(246, 100%, 73%, 1);">
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>DELETE</th>
                                <th>DOB</th>
                                <th>MOBILE NO</th>
                                <th>JOINED</th>
                                <th>LAST LOGIN</th>
                                <?php
                                if (!empty($_POST['view_count'])) {
                                ?>
                                    <th>SENT</th>
                                    <th>RECIEVED</th>
                                <?php
                                } else {
                                ?><th>SENT/RECIEVED</th>
                            </tr>
                        <?php
                                }
                                pagination_admin_activity("user_details", "User List", "last_login");
                            } else {
                        ?>
                    </form>
                    <div class="restricted-access">
                        <h3>Access restricted</h3>
                        <img src="lock.jpg" alt="lock">
                    </div>
                <?php
                            }
                            if (isset($_POST['grant_delete_access'])) {
                                $grant_access_query = "update user_details set trash_delete='yes' where token_id='{$_POST['delete_access']}';";
                                $grant_access_output = $conn->query($grant_access_query);
                            } elseif (isset($_POST['block_delete_access'])) {
                                $block_access_query = "update user_details set trash_delete='no' where token_id='{$_POST['delete_access']}';";
                                $block_access_output = $conn->query($block_access_query);
                            }
                            break;
                        case 'Login Activity':
                            // $activity.="I-Box Dashboard";
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
                                if ($super_admin_output->num_rows > 0) {
                                    $super_admin_result = $super_admin_output->fetch_assoc();
                                    if (password_verify($password, $super_admin_result['password'])) {
                            ?>
                                    <div class="user_table">
                                        <table class="user_list">
                                            <tr style="text-align: center;color:white; background:hsla(246, 100%, 73%, 1);box-shadow:3px 3px 6px rgb(215, 212, 255);">
                                                <th style="width: 10%;">EMP ID</th>
                                                <th style="width: 20%;">USERNAME</th>
                                                <th style="width: 20%;">ROLE</th>
                                                <th style="width: 30%;">ACTIVITY</th>
                                                <th style="width: 10%;">LOGIN TIME</th>
                                                <th style="width: 10%;">LOGOUT TIME</th>
                                            </tr>
                                            <?php
                                            login_activity();
                                            ?>
                                        </table>
                                    </div>
                        <?php

                                    } else {
                                        echo "wrong password";
                                    }
                                } else {
                                    echo ' <div class="restricted-access">
                        <h3>Access restricted</h3>
                        <img src="lock.jpg" alt="lock">
                    </div>';
                                }
                            }
                            // activity($activity, $emp_id, $login_time);
                            break;
                        case 'Admin':
                            $activity .= "Admin profile";
                        ?>
                        <div class="profile-container">
                            <div class="profile_picture">
                                <div>
                                    <h3>Profile</h3>
                                </div>
                                <?php
                                require "profile_picture.php";
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
                            $user_details_query = "select * from admin_details where token_id='$token_id';";
                            $output = $conn->query($user_details_query);
                            if ($output->num_rows > 0) {
                                $result = $output->fetch_assoc();
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
                                                header("location:admin_dashboard.php?page=Admin");
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
                        case 'Access':
                    ?>
                    <div class="access-container">
                        <div class="access-content">
                            <?php
                            if ($admin_details['access_page'] == 1) {
                            ?>
                                <form action="admin_dashboard.php?page=Access" method="post">
                                    <div class="access-options">
                                        <div class="search">
                                            <input type="search" name="search" placeholder="EST001">
                                            <input type="submit" name="search-btn" value="Search">
                                        </div>
                                        <div class="grant-access">
                                            <input type="submit" name="grant_access" value="Grant Access">
                                            <input type="submit" name="restrict_access" value="Restrict Access">
                                        </div>
                                    </div>
                                    <table class="access-table">
                                        <tr style="text-align: center;color:white; background:hsla(246, 100%, 73%, 1);box-shadow:3px 3px 6px rgb(215, 212, 255);">
                                            <th>EMP ID</th>
                                            <th>USERNAME</th>
                                            <th>NAME</th>
                                            <th>IBOX DASHBOARD</th>
                                            <th>ADMIN LIST</th>
                                            <th>USER LIST</th>
                                            <th>LOGIN ACTIVITY</th>
                                            <th>ACCESS PAGE </th>
                                        </tr>
                                        <?= admin() ?>

                                    </table>
                                </form>
                            <?php
                            } else {
                            ?>
                                <div class="restricted-access">
                                    <h3>Access restricted</h3>
                                    <img src="lock.jpg" alt="lock">
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
            <?php
                            //grant access submit function
                            if (isset($_POST['grant_access'])) {
                                //checks for ticked checkbox and assigns the value
                                $ibox_access = isset($_POST['ibox_access']) ? $_POST['ibox_access'] : array();
                                $admin_list_access = isset($_POST['admin_list_access']) ? $_POST['admin_list_access'] : array();
                                $user_list_access = isset($_POST['user_list_access']) ? $_POST['user_list_access'] : array();
                                $login_activity_access = isset($_POST['login_activity_access']) ? $_POST['login_activity_access'] : array();
                                $access_page_access = isset($_POST['access_page_access']) ? $_POST['access_page_access'] : array();
                                if (!empty($ibox_access)) {
                                    foreach ($ibox_access as $token) {
                                        $access_update_query = "update admin_details set ibox_dashboard=1, access_given_by='{$admin_details['username']}' where token_id='$token';";
                                        $access_update_output = $conn->query($access_update_query);
                                    }
                                }
                                if (!empty($admin_list_access)) {
                                    foreach ($admin_list_access as $token) {
                                        $access_update_query = "update admin_details set admin_list=1, access_given_by='{$admin_details['username']}' where token_id='$token';";
                                        $access_update_output = $conn->query($access_update_query);
                                    }
                                }
                                if (!empty($user_list_access)) {
                                    foreach ($user_list_access as $token) {
                                        $access_update_query = "update admin_details set user_list=1, access_given_by='{$admin_details['username']}' where token_id='$token';";
                                        $access_update_output = $conn->query($access_update_query);
                                    }
                                }
                                if (!empty($login_activity_access)) {
                                    foreach ($login_activity_access as $token) {
                                        $access_update_query = "update admin_details set login_activity=1, access_given_by='{$admin_details['username']}' where token_id='$token';";
                                        $access_update_output = $conn->query($access_update_query);
                                    }
                                }
                                if (!empty($access_page_access)) {
                                    foreach ($access_page_access as $token) {
                                        $access_update_query = "update admin_details set access_page=1, access_given_by='{$admin_details['username']}' where token_id='$token';";
                                        $access_update_output = $conn->query($access_update_query);
                                    }
                                }
                            }
                            if (isset($_POST['restrict_access'])) {
                                //
                                $ibox_access = isset($_POST['ibox_access']) ? $_POST['ibox_access'] : array();
                                $admin_list_access = isset($_POST['admin_list_access']) ? $_POST['admin_list_access'] : array();
                                $user_list_access = isset($_POST['user_list_access']) ? $_POST['user_list_access'] : array();
                                $login_activity_access = isset($_POST['login_activity_access']) ? $_POST['login_activity_access'] : array();
                                $access_page_access = isset($_POST['access_page_access']) ? $_POST['access_page_access'] : array();
                                if (!empty($ibox_access)) {
                                    foreach ($ibox_access as $token) {
                                        $access_update_query = "update admin_details set ibox_dashboard=0, access_given_by='{$admin_details['username']}' where token_id='$token';";
                                        $access_update_output = $conn->query($access_update_query);
                                    }
                                }
                                if (!empty($admin_list_access)) {
                                    foreach ($admin_list_access as $token) {
                                        $access_update_query = "update admin_details set admin_list=0, access_given_by='{$admin_details['username']}' where token_id='$token';";
                                        $access_update_output = $conn->query($access_update_query);
                                    }
                                }
                                if (!empty($user_list_access)) {
                                    foreach ($user_list_access as $token) {
                                        $access_update_query = "update admin_details set user_list=0, access_given_by='{$admin_details['username']}' where token_id='$token';";
                                        $access_update_output = $conn->query($access_update_query);
                                    }
                                }
                                if (!empty($login_activity_access)) {
                                    foreach ($login_activity_access as $token) {
                                        $access_update_query = "update admin_details set login_activity=0, access_given_by='{$admin_details['username']}' where token_id='$token';";
                                        $access_update_output = $conn->query($access_update_query);
                                    }
                                }
                                if (!empty($access_page_access)) {
                                    foreach ($access_page_access as $token) {
                                        $access_update_query = "update admin_details set access_page=0, access_given_by='{$admin_details['username']}' where token_id='$token';";
                                        $access_update_output = $conn->query($access_update_query);
                                    }
                                }
                            }
                            // if(isset($_POST['search-btn'])){
                            //     $search_content=!empty($_POST['search'])?$_POST['search']:"";
                            //     $search_query="select * from admin_details where "
                            // }
                            break;
                    }
                    // echo $activity;
                    // activity($activity, $emp_id, $login_time);
            ?>