<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);
include 'config.php';
include 'email_function.php';
$token_id = isset($_SESSION['token_id']) ? hex2bin($_SESSION['token_id']) : header("location:user_login.php");
$user_details_query = "select * from user_details where token_id='$token_id';";
// echo $token_id;
$user_details_output = $conn->query($user_details_query);
if (!is_bool($user_details_output)) {
    $user_details_result = $user_details_output->fetch_assoc();
    $email = $user_details_result['email'];
}
$page = isset($_GET['page']) ? $_GET['page'] : 'Email';
$option = empty($_GET['option']) ? '' : $_GET['option'];
$page_no = empty($_GET['page_no']) ? '1' : $_GET['page_no'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="1"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inboxflow</title>
    <link rel="stylesheet" href="email.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css">
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
                <a href="email.php?page=<?= $page ?>" style="color:rgb(114, 98, 255);">
                    <?= $page ?>
                </a>
                <?php
                if (!empty($option)) {
                ?>
                    <a href="email.php?page=<?= $page ?>&option=<?= $option ?>" style="color:rgb(114, 98, 255);">
                        <?= " | " .  $option ?>
                    </a>
                <?php
                }
                ?>
            </div>
            <div class=" profile">
                <?php require_once "profile_picture.php" ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="vertical-navigation-bar">
            <ul>
                <br><br>
                <li><a href="?page=Dashboard"><button <?= isset($_GET['page']) && $_GET['page'] === 'Dashboard' ? '" class="active"' : '' ?>><img class="icon" src="icons/dashboard.png" alt="">Dashboard</button></a></li>
                <li><a href="?page=Email"><button <?= isset($_GET['page']) && $_GET['page'] === 'Email' ? '" class="active"' : '' ?>>Email</button></a></li>
                <li><a href="?page=Chat"><button <?= isset($_GET['page']) && $_GET['page'] === 'Chat' ? '" class="active"' : '' ?>>Chat</button></a></li>
                <li><a href="?page=User"><button <?= isset($_GET['page']) && $_GET['page'] === 'User' ? '" class="active"' : '' ?>>User</button></a></li>
                <li><a href="?page=Calender"><button <?= isset($_GET['page']) && $_GET['page'] === 'Calender' ? '" class="active"' : '' ?>>Calender</button></a></li>
            </ul>
        </div>
        <?php
        $get_user_details = "select * from user_details where token_id='$token_id';";
        $output = $conn->query($get_user_details);
        $result = $output->fetch_assoc();
        switch ($page) {
            case 'Dashboard':
        ?>
                <div class="dashboard-container">
                    <div class="dashboard-content">
                        <div class="dashboard-counts">
                            <div class="dashboard-count1">
                                <h3>Total mails sent</h3>
                                <?= total_mail("sender_email", "and mail_status='sent') and archived='no'") ?>
                            </div>
                            <div class="dashboard-count2">
                                <h3>Total mails recieved</h3>
                                <?= total_mail("reciever_email", "and mail_status='sent')") ?>
                            </div>
                            <div class="dashboard-count3">
                                <h3>First login</h3>
                                <?= dateconvertion($result['created_on']) ?>
                            </div>
                            <div class="dashboard-count4">
                                <h3>Last login</h3>
                                <?= dateconvertion($result['last_login']) ?>
                            </div>
                            <div class="dashboard-count5">
                                <h3>Last profile update</h3>
                                <?= dateconvertion($result['updated_on']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                break;
            case 'Email':
            ?>
                <div class="email-container">
                    <div class="email-navigation-bar">

                        <div class="compose-btn">
                            <a href="email.php?page=Email&option=Compose"><button>Compose</button></a>
                        </div>
                        <div class="email-options">
                            <div>
                                <a href="email.php?page=Email&option=Inbox"><button <?= isset($_GET['option']) && $_GET['option'] === 'Inbox' ? 'class="option_active"' : '' ?>><i class="bi bi-inboxes"></i>Inbox</button></a>
                            </div>
                            <div class="email-count">
                                <?= total_mail("reciever_email", "and mail_status='sent') and (archived='no' and inbox_status='unread');") ?>
                            </div>
                            <div><a href="email.php?page=Email&option=Unread"><button <?= isset($_GET['option']) && $_GET['option'] === 'Unread' ? 'class="option_active"' : '' ?>>Unread</button></a></div>
                            <div class="email-count">
                                <?= total_mail("reciever_email", " and inbox_status='unread') and mail_status='sent'") ?>
                            </div>
                            <div><a href="email.php?page=Email&option=Sent"><button <?= isset($_GET['option']) && $_GET['option'] === 'Sent' ? 'class="option_active"' : '' ?>>Sent</button></a></div>
                            <div class="email-count">
                            </div>
                            <div><a href="email.php?page=Email&option=Draft"><button <?= isset($_GET['option']) && $_GET['option'] === 'Draft' ? 'class="option_active"' : '' ?>>Draft</button></a></div>
                            <div class="email-count">
                                <?= total_mail("sender_email", "and mail_status='draft')") ?>
                            </div>
                            <div><a href="email.php?page=Email&option=Starred"><button <?= isset($_GET['option']) && $_GET['option'] === 'Starred' ? 'class="option_active"' : '' ?>>Starred</button></a></div>
                            <div class="email-count">
                                <?= total_mail("sender_email", "or reciever_email='{$email}') and (starred='yes' and mail_status='sent') and inbox_status='unread';") ?>
                            </div>
                            <div><a href="email.php?page=Email&option=Spam"><button <?= isset($_GET['option']) && $_GET['option'] === 'Spam' ? 'class="option_active"' : '' ?>>Spam</button></a></div>
                            <div class="email-count">
                                <?= total_mail("reciever_email", "and mail_status='sent') and (spam='yes');") ?>
                            </div>
                            <div><a href="email.php?page=Email&option=Archived"><button <?= isset($_GET['option']) && $_GET['option'] === 'Archived' ? 'class="option_active"' : '' ?>>Archive</button></a></div>
                            <div class="email-count">
                                <?= total_mail("sender_email", "or reciever_email='{$email}') and (mail_status='sent' and archived='yes') and inbox_status='unread';") ?>
                            </div>
                            <div><a href="email.php?page=Email&option=Trash"><button <?= isset($_GET['option']) && $_GET['option'] === 'Trash' ? 'class="option_active"' : '' ?>>Trash</button></a></div>
                            <div class="email-count">
                                <?= trash_mail("mail_no", "reciever_email", "sender_email", "(mail_status='trash' and inbox_status='unread');") ?>
                            </div>
                        </div>
                        <hr>
                        </form><br>
                    </div>
                    <?php
                    ?>
                    <div class="mail-list">
                        <?php
                        if (isset($_GET['option']) && $_GET['option'] == "Compose" || isset($_POST['reply'])) {
                        ?>
                            <div class="email_form">
                                <form action="email.php?page=Email" method="post">
                                    <input type="submit" name="send" value="Send mail">
                                    <input type="reset" value="Clear"><br><br>
                                    <label for="mail">TO:</label><br>
                                    <input type="text" id="mail" name="mail" value="<?php
                                                                                    if (!empty($_POST['sender_email']) && !($_GET['option'] == "Sent")) {
                                                                                        $text_box_value = $_POST['sender_email'];
                                                                                    } elseif (empty($_POST['reciever_email'])) {
                                                                                        $text_box_value = "";
                                                                                    } else {
                                                                                        $text_box_value = $_POST['reciever_email'];
                                                                                    }
                                                                                    echo $text_box_value;
                                                                                    ?>" required><br><br>
                                    <label for="cc" style="margin-right:16px;">CC:</label>
                                    <input type="text" id="cc" name="cc"><br><br>
                                    <label for="bcc" style="margin-right:16px;">BCC:</label>
                                    <input type="text" id="bcc" name="bcc"><br><br>
                                    <label for="subject">SUBJECT:</label>
                                    <input type="text" id="subject" name="subject" required><br><br><br>
                                    <textarea name="notes" placeholder="Type here..."></textarea><br><br>
                                </form>
                            </div>
                            <!-- <div class="mail-list-table"> -->
                        <?php
                        } else {
                        ?>
                            <div class="mail-list-options">
                                <div>
                                    <form action="email.php?page=Email&option=<?= $option ?>" method="post">
                                        <input type="submit" name="<?= name_setting('Starred', 'unstar', 'star') ?>" value="<?= name_setting('Starred', 'Unstar', 'Star') ?>">
                                        <input type="submit" name="<?= name_setting('Archived', 'unarchive', 'archive') ?>" value=" <?= name_setting('Archived', 'Unarchive', 'Archive') ?>">
                                        <input type="submit" name="<?= name_setting('Trash', 'restore', 'delete') ?>" value="<?= name_setting('Trash', 'Restore', 'Delete') ?>">
                                        <input type="submit" name="mark_as_read" value="Mark as read" style="width: 100px;">
                                    </form>
                                </div>
                                <div>
                                    <form action="email.php?page=Email&option=Search" method="post">
                                        <input type="search" name="search" placeholder="search mail">
                                        <input type="submit" name="search-btn" value="Search">
                                    </form>
                                </div><br><br>
                            </div>
                        <?php
                        }
                        include "email_options.php";
                        ?>
                        <?php
                        include 'config.php';
                        $token_id = isset($_GET['token']) ? base64_decode(urldecode($_GET['token'])) : "";
                        $mail_no = isset($_GET['mailno']) ? $_GET['mailno'] : "";
                        if (!empty($token_id) && !empty($mail_no)) {
                            $select_query = "select * from mail_list where mail_no ='$mail_no' and token_id='$token_id';";
                            $mark_as_read = "update mail_list set inbox_status=\"read\" where mail_no='{$mail_no}' and token_id='{$token_id}'";
                            $select_query_output = $conn->query($select_query);
                            $conn->query($mark_as_read);
                            $display_result = $select_query_output->fetch_assoc();
                        ?>
                            <div class="mail-display">
                                <form action="email.php?page=Email&option=Compose" method="post">
                                    <div class="mail-display-options">
                                        <div>
                                            <a href="email.php?page=Email&option=<?= $option ?>&page_no=<?= $page_no ?>">Back</a>
                                        </div>
                                        <div>
                                            <input type="submit" name="reply" value="Reply">
                                            <input type="submit" name="forward" value="Forward"><br>
                                        </div>
                                    </div>
                                    <label>From:</label>
                                    <input type="text" name="sender_email" id="sender_email" value="<?= $display_result['sender_email'] ?>" readonly>
                                    <br><br>
                                    <label>To:</label>
                                    <input type="text" name="reciever_email" id="reciever_email" value="<?= $display_result['reciever_email'] ?>" readonly><br><br>
                                    <label>Subject:</label>
                                    <input type="text" name="mail_subject" id="subject" value="<?= $display_result['subject'] ?>" readonly><br><br>
                                    <?php
                                    if (empty($display_result['cc']) && empty($display_result['bcc'])) {
                                    } else {
                                    ?>
                                        <label>Cc:</label>
                                        <input type="text" name="Cc" id="cc" value="<?= $display_result['cc'] ?>" readonly><br><br>
                                        <label>Bcc:</label>
                                        <input type="text" name="Bcc" id="bcc" value="<?= $display_result['bcc'] ?>" readonly><br><br>
                                    <?php
                                    }
                                    ?>
                                    <br>
                                    <textarea name="mail_body" readonly><?= $display_result['notes'] ?></textarea><br><br>

                                </form>
                            </div>
                    </div>

                    </table>
                <?php
                        }
                        break;
                    case 'Chat':
                ?>
                <div class="chat-container">
                    <div class="chat-content">
                        <?php
                        echo "<h2>Chat will be available soon</h2>";
                        ?>
                    </div>
                </div>
            <?php
                        break;

                    case 'User':
                        require 'email_options.php';
            ?>
                <div class="profile-container">
                    <div class="profile_picture">
                        <div>
                            <h3>Profile</h3>
                        </div>
                        <?php require "profile_picture.php" ?>
                    </div>
                    <?php

                        if (!isset($_POST['edit'])) {
                    ?>
                        <div class="user_details">
                            <form action="email.php?page=User" enctype="multipart/form-data" method="post">
                                <input type="submit" name="edit" value="Edit">
                                <input type="submit" name="logout" value="Log out"><br><br>
                                <label for="username">Username</label>
                                <input type="text" id="username" name="user_name" value="<?= $result['username'] ?>" readonly><br><br>
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" value="<?= $result['name'] ?>" readonly><br><br>
                                <label for="dob">Date of birth</label>
                                <input type="text" id="dob" name="dob" value="<?= $result['date_of_birth'] ?>" readonly><br><br>
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" value="<?= $result['email'] ?>" readonly><br><br>
                                <label for="cell_number">Mobile number</label>
                                <input type="text" id="cell_number" name="cell_number" value="<?= $result['phone_no'] ?>" readonly><br><br>
                            </form>
                        </div>
                    <?php
                        }
                        if (isset($_POST['edit'])) {
                    ?>
                        <div class="user_details">
                            <form action="email.php?page=User" enctype="multipart/form-data" method="post">
                                <input type="file" name="file" id="fileInput" style="display: none;">
                                <label for="fileInput" style="color:rgb(114, 98, 255)">Update profile
                                    picture</label>
                                <input type="submit" name="save" value="Save"><br><br>
                                <label for="username">Username</label>
                                <input type="text" id="username" name="user_name" value="<?= $result['username'] ?>" readonly><br><br>
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" value="<?= $result['name'] ?>"><br><br>
                                <label for="dob">Date of birth</label>
                                <input type="date" id="dob" name="dob" value="<?= $result['date_of_birth'] ?>"><br><br>
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" value="<?= $result['email'] ?>" readonly><br><br>
                                <label for="cell_number">Mobile number</label>
                                <input type="text" id="cell_number" name="cell_number" value="<?= $result['phone_no'] ?>"><br><br>
                            </form>
                        </div>
                </div>
            <?php
                        }
                        break;
                    case 'Calender':
            ?>
            <div class="dashboard-container">
                <div class="dashboard-content">
                    <h4>calender will be available soon</h4>
                </div>
            </div>
    <?php
                        break;
                }
    ?>
    </form>
                </div>
    </div>
    </div>
</body>

</html>