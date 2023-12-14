<?php
session_start();
include 'config.php';
include 'email_function.php';
$token_id = isset($_SESSION['token_id']) ? hex2bin($_SESSION['token_id']) : header("location:user_login.php");
$user_details_query = "select * from user_details where token_id='{$token_id}';";
$user_details_output = $conn->query($user_details_query);
if (!is_bool($user_details_output)) {
    $user_details_result = $user_details_output->fetch_assoc();
    $email = $user_details_result['email'];
}
// $email = "theertheshest@gmail.com";
$page = isset($_GET['page']) ? $_GET['page'] : 'Email';
$option = empty($_GET['option']) ? '' : $_GET['option'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="10"> -->
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
                <li><a href="?page=Dashboard"><button <?= isset($_GET['page']) && $_GET['page'] === 'Dashboard' ? '" class="active"' : '' ?>>Dashboard</button></a></li>
                <li><a href="?page=Email&option=Inbox"><button <?= isset($_GET['page']) && $_GET['page'] === 'Email' ? '" class="active"' : '' ?>>Email</button></a></li>
                <li><a href="?page=Chat"><button <?= isset($_GET['page']) && $_GET['page'] === 'Chat' ? '" class="active"' : '' ?>>Chat</button></a></li>
                <li><a href="?page=User"><button <?= isset($_GET['page']) && $_GET['page'] === 'User' ? '" class="active"' : '' ?>>User</button></a></li>
                <li><a href="?page=Calender"><button <?= isset($_GET['page']) && $_GET['page'] === 'Calender' ? '" class="active"' : '' ?>>Calender</button></a></li>
            </ul>
        </div>
        <?php
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
                            <?php
                            $get_user_details = "select * from user_details where token_id='{$token_id}';";
                            $output = $conn->query($get_user_details);
                            $result = $output->fetch_assoc();
                            ?>
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
                                <a href="email.php?page=Email&option=Inbox"><button <?= isset($_GET['option']) && $_GET['option'] === 'Inbox' ? 'class="option_active"' : '' ?>>Inbox</button></a>
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
                                <?= total_mail("sender_email", "and mail_status='sent') and archived='no'") ?>
                            </div>
                            <div><a href="email.php?page=Email&option=Draft"><button <?= isset($_GET['option']) && $_GET['option'] === 'Draft' ? 'class="option_active"' : '' ?>>Draft</button></a></div>
                            <div class="email-count">
                                <?= total_mail("sender_email", "and mail_status='draft')") ?>
                            </div>
                            <div><a href="email.php?page=Email&option=Starred"><button <?= isset($_GET['option']) && $_GET['option'] === 'Starred' ? 'class="option_active"' : '' ?>>Starred</button></a></div>
                            <div class="email-count">
                                <?= total_mail("sender_email", "or reciever_email='{$email}') and starred='yes' and mail_status='sent'") ?>
                            </div>
                            <div><a href="email.php?page=Email&option=Spam"><button <?= isset($_GET['option']) && $_GET['option'] === 'Spam' ? 'class="option_active"' : '' ?>>Spam</button></a></div>
                            <div class="email-count"></div>
                            <div><a href="email.php?page=Email&option=Archived"><button <?= isset($_GET['option']) && $_GET['option'] === 'Archived' ? 'class="option_active"' : '' ?>>Archive</button></a></div>
                            <div class="email-count">
                                <?= total_mail("sender_email", "or reciever_email='{$email}') and mail_status='sent' and archived='yes'") ?>
                            </div>
                            <div><a href="email.php?page=Email&option=Trash"><button <?= isset($_GET['option']) && $_GET['option'] === 'Trash' ? 'class="option_active"' : '' ?>>Trash</button></a></div>
                            <div class="email-count">
                                <?= trash_mail("mail_no", "reciever_email", "sender_email", "mail_status=\"trash\"") ?>
                            </div>
                        </div>
                        <hr>
                        </form><br>
                    </div>
                    <?php
                    ?>
                    <div class="mail-list">
                        <?php
                        if (isset($_GET['option']) && $_GET['option'] == "Compose") {
                        ?>
                            <div class="email_form">
                                <form action="email.php?page=Email" method="post">
                                    <input type="submit" name="send" value="Send mail">
                                    <input type="reset" value="Clear"><br><br>
                                    <label for="mail">TO:</label><br>
                                    <input type="text" id="mail" name="mail" required><br><br>
                                    <label for="cc" style="margin-right:16px;">CC:</label>
                                    <input type="text" id="cc" name="cc"><br><br>
                                    <label for="bcc" style="margin-right:16px;">BCC:</label>
                                    <input type="text" id="bcc" name="bcc"><br><br>
                                    <label for="subject">SUBJECT:</label>
                                    <input type="text" id="subject" name="subject" required><br><br><br>
                                    <textarea name="notes" placeholder="Type here..."></textarea><br><br>
                                </form>
                            </div>
                            <div class="mail-list-table">
                            <?php
                        } else {
                            ?>
                                <div class="mail-list-options">
                                    <div>
                                        <form action="email.php?page=Email&option=<?= $option ?>" method="post">
                                            <input type="submit" name="<?= name_setting('Starred', 'Unstar', 'Star') ?>" value="<?= name_setting('Starred', 'Unstar', 'Star') ?>">
                                            <input type="submit" name="<?= name_setting('Archived', 'Unarchive', 'Archive') ?>" value=" <?= name_setting('Archived', 'Unarchive', 'Archive') ?>">
                                            <input type="submit" name="<?= name_setting('Trash', 'Restore', 'Delete') ?>" value="<?= name_setting('Trash', 'Restore', 'Delete') ?>">
                                            <input type="submit" name="mark_as_read" value="Mark as read" style="width: 100px;">
                                    </div>
                                    <div>
                                        <input type="search" name="search" placeholder="search mail">
                                        <input type="submit" name="search-btn" value="Search">
                                    </div><br><br>
                                </div>
                            <?php
                        }
                        require "email_options.php";
                            ?>
                            <div class="mail-list">
                                <div class="mail-display">
                                    <?php
                                    include 'config.php';
                                    $token_id = isset($_GET['token']) ? hex2bin($_GET['token']) : "";
                                    $mail_no = isset($_GET['mailno']) ? $_GET['mailno'] : "";
                                    if (!empty($token_id) && !empty($mail_no)) {
                                    ?><div>
                                            <form action="email.php?page=Email" method="post">
                                                <a href="email.php?page=Email&option=<?= $option ?>"><button>Back</button></a>
                                                <a href=""><button>Reply</button></a>
                                                <a href=""><button>Forward</button></a>
                                            </form>
                                        </div>
                                        <?php
                                        $select_query = "select * from mail_list where mail_no ='$mail_no' and token_id='$token_id';";
                                        $mark_as_read = "update mail_list set inbox_status=\"read\" where mail_no='{$mail_no}' and token_id='{$token_id}'";
                                        $select_query_output = $conn->query($select_query);
                                        $conn->query($mark_as_read);
                                        $result = $select_query_output->fetch_assoc();
                                        ?>
                                        <label>From:</label>
                                        <input type="text" name="sender_email" id="sender_email" value="<?= $result['sender_email'] ?>" readonly>
                                        <br><br>
                                        <label>To:</label>
                                        <input type="text" name="reciever_email" id="reciever_email" value="<?= $result['reciever_email'] ?>" readonly><br><br>
                                        <label>Subject:</label>
                                        <input type="text" name="mail_subject" id="subject" value="<?= $result['subject'] ?>" readonly><br><br>
                                        <?php
                                        if (empty($result['cc']) && empty($result['bcc'])) {
                                        } else {
                                        ?>
                                            <label>Cc:</label>
                                            <input type="text" name="Cc" id="cc" value="<?= $result['cc'] ?>" readonly><br><br>
                                            <label>Bcc:</label>
                                            <input type="text" name="Bcc" id="bcc" value="<?= $result['bcc'] ?>" readonly><br><br>
                                        <?php
                                        }
                                        ?>
                                        <br>
                                        <textarea name="mail_body" readonly><?= $result['notes'] ?></textarea><br><br>
                                </div>
                            </div>

                            </table>
                        <?php
                                    }
                                    break;
                                case 'Chat':
                        ?>
                        <div class="chat-conatiner">
                            <div class="chat-content">
                                <?php
                                    echo "<h2>Chat will be available soon</h2>";
                                ?>
                            </div>
                        </div>
                    <?php
                                    break;

                                case 'User':
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

                    ?>

                    <?php
                                    if (isset($_POST['save'])) {
                                        if (!empty($_POST)) {
                                            $update_details = "update user_details set username='{$_POST['user_name']}', name='{$_POST['name']}', date_of_birth='{$_POST['dob']}', phone_no='{$_POST['cell_number']}', updated_on = current_timestamp where email='{$result['email']}';";
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
                                                        $file_destination = "Uploads/$file_new_name";
                                                        move_uploaded_file($file_array['file_tmp_name'], $file_destination);
                                                        $image_query = "update user_details set profile_status=0 where token_id='{$token_id}'";
                                                        $image_query_output = $conn->query($image_query);
                                                        header("location:email.php?page=User");
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
                                    if (isset($_POST['logout'])) {
                                        session_unset();
                                        session_destroy();
                                        header("location:user_login.php");
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
                                default:
                                    header("location:email.php?page=Email");
                                    break;
                            }
            ?>
            </form>
                            </div>
                    </div>
                </div>
</body>

</html>