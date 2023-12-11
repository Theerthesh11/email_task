<?php
require_once "admin_functions.php";
$token_id = isset($_SESSION['token_id']) ? hex2bin($_SESSION['token_id']) : "0a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
                $page = isset($_GET['page']) ? $_GET['page'] : 'i-box_dashboard';
                ?>
                <a href="admin_dashboard.php" style="color:rgb(114, 98, 255);">
                    <?= $page ?>
                </a>
            </div>
            <div class=" profile">
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
                <!-- <li><a href="?page=Calendar"><button>Calender</button></a></li> -->
            </ul>
        </div>
        <?php
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
                break;
            case 'Admin List':
            ?><div class="dashboard-container">
                    <div class="dashboard-content">
                        <div class="super-admin-login">
                            <?php
                            ?>
                            <form action="admin_dashboard.php?page=Admin List" method="post">
                                <label for="username">Username</label><br>
                                <input type="text" id="username" name="username" value=""><br>
                                <label for="password">Password</label><br>
                                <input type="password" id="password" name="password" value=""><br>
                                <input type="submit" name="login" value="LOG IN">
                                <input type="reset" value="CLEAR">
                            </form>
                        </div>
                        <?php
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

                                    <table class="user_list">
                                        <tr style="text-align: center;color:white; background:hsla(246, 100%, 73%, 1);">
                                            <td>SNO</td>
                                            <td>NAME</td>
                                            <td>EMAIL</td>
                                            <td>DOB</td>
                                            <td>MOBILE NO</td>
                                            <td>JOINED</td>
                                            <td>LAST LOGIN</td>
                                        </tr>
                            <?php
                                }
                            }
                        }
                            break;
                            case 'User List':
                            ?><div class="dashboard-container">
                                <div class="dashboard-content">
                                    <table class="user_list">
                                        <tr style="text-align: center;color:white; background:hsla(246, 100%, 73%, 1);">
                                            <!-- <td>SNO</td> -->
                                            <td>NAME</td>
                                            <td>EMAIL</td>
                                            <td>DOB</td>
                                            <td>MOBILE NO</td>
                                            <td>JOINED</td>
                                            <td>LAST LOGIN</td>
                                        </tr>
                                        <?php
                                        pagination("user_details");
                                        ?>
                                <?php
                                break;
                            case 'login_activity':
                                break;
                        }
