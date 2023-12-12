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
                <a href="email.php" style="color:rgb(114, 98, 255);">
                    <?= $page ?>
                </a>
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
                <li><a href="?page=Dashboard"><button>Dashboard</button></a></li>
                <li><a href="?page=Email"><button>Email</button></a></li>
                <li><a href="?page=Chat"><button>Chat</button></a></li>
                <li><a href="?page=User"><button>User</button></a></li>
                <li><a href="?page=Calendar"><button>Calender</button></a></li>
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
                        <form action="email.php?page=Email" method="post">
                            <div class="compose-btn">
                                <input type="submit" name="compose" value="Compose"><br>
                            </div>
                            <div class="email-options">
                                <div>
                                    <input type="submit" name="inbox" value="Inbox">
                                </div>
                                <div class="email-count">
                                    <?= total_mail("reciever_email", "and mail_status='sent') and archived='no'") ?>
                                </div>
                                <div><input type="submit" name="unread" value="Unread"></div>
                                <div class="email-count">
                                    <?= total_mail("reciever_email", " and inbox_status='unread') and mail_status='sent'") ?>
                                </div>
                                <div><input type="submit" name="sent" value="Sent"></div>
                                <div class="email-count">
                                    <?= total_mail("sender_email", "and mail_status='sent') and archived='no'") ?>
                                </div>
                                <div><input type="submit" name="draft" value="Draft"></div>
                                <div class="email-count">
                                    <?= total_mail("sender_email", "and mail_status='draft')") ?>
                                </div>
                                <div><input type="submit" name="starred" value="Starred"></div>
                                <div class="email-count">
                                    <?= total_mail("sender_email", "or reciever_email='{$email}') and starred='yes' and mail_status='sent'") ?>
                                </div>
                                <div><input type="submit" name="spam" value="Spam"></div>
                                <div class="email-count"></div>
                                <div><input type="submit" name="archived" value="Archived"></div>
                                <div class="email-count">
                                    <?= total_mail("sender_email", "or reciever_email='{$email}') and mail_status='sent' and archived='yes'") ?>
                                </div>
                                <div><input type="submit" name="trash" value="Trash"></div>
                                <div class="email-count">
                                    <?= trash_mail("mail_no", "reciever_email", "sender_email", "mail_status=\"trash\"") ?>
                                </div>
                            </div>
                            <hr>
                        </form><br>
                    </div>
                    <div class="mail-list">
                        <?php
                        if (!isset($_POST['compose'])) {
                        ?>
                            <div class="mail-list-options">
                                <div>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                        <input type="submit" name="<?= name_setting('starred', 'unstar', 'star') ?>" value="<?= name_setting('starred', 'Unstar', 'Star') ?>">
                                        <input type="submit" name="<?= name_setting('archived', 'unarchive', 'archive') ?>" value=" <?= name_setting('archived', 'Unarchive', 'Archive') ?>">
                                        <input type="submit" name="<?= name_setting('trash', 'restore', 'delete') ?>" value="<?= name_setting('trash', 'Restore', 'Delete') ?>">
                                        <input type="submit" name="mark_as_read" value="Mark as read" style="width: 100px;">
                                </div>
                                <div>
                                    <input type="search" name="search" placeholder="search mail">
                                    <input type="submit" name="search-btn" value="search">
                                </div><br><br>
                            </div>
                        <?php
                        } elseif (isset($_POST['compose'])) {
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
                        }
                        if (isset($_POST['send'])) {
                            if (!empty($_POST['mail']) && !empty($_POST['subject']) && !empty($_POST['notes'])) {
                                if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                                    $to_mail = $_POST['mail'];
                                    $subject = $_POST['subject'];
                                    $notes = $_POST['notes'];
                                    $cc = !empty($_POST['cc']) ? $_POST['cc'] : "";
                                    $bcc = !empty($_POST['bcc']) ? $_POST['bcc'] : "";
                                    // $headers = 'Cc:' . $cc . "\r\n";
                                    // $headers .= 'Bcc:' . $bcc . "\r\n";
                                    if (mail($to_mail, $subject, $notes)) {
                                        $mail_status = "sent";
                                        $mail_no = "TH031";
                                        $updated_by = $user_details_result['username'];
                                        $created_by = $user_details_result['username'];
                                        $insert_query = $conn->prepare("insert into mail_list ( token_id, mail_no, sender_email, name, reciever_email, cc, bcc, subject, notes, date_of_sending, mail_status,updated_by, created_by, updated_on) values(?,?,?,?,?,?,?,?,?,current_timestamp,?,?,?,current_timestamp)");
                                        $insert_query->bind_param(
                                            "ssssssssssss",
                                            $token_id,
                                            $mail_no,
                                            $email,
                                            $user_details_result['name'],
                                            $to_mail,
                                            $cc,
                                            $bcc,
                                            $subject,
                                            $notes,
                                            $mail_status,
                                            $created_by,
                                            $updated_by
                                        );
                                        $insert_query->execute();
                                        echo "<div class=\"email-form\"><p style=\" color:green;\"> Mail sent successfully</p></div>";
                                    } else {
                                        echo "<p style=\" color:red;\">mail not sent</p>";
                                    }
                                } else {
                                    echo "<p style=\" color:red;\">Enter a valid email id</p>";
                                }
                            }
                        }
                        if (isset($_POST['inbox'])) {
                            $inbox_query = "select * from mail_list where (reciever_email='{$email}' AND mail_status='sent') AND archived='no';";
                            $inbox_output = $conn->query($inbox_query);
                            echo "<table>";
                            while ($result = $inbox_output->fetch_assoc()) {
                                row_color($result['inbox_status']);
                                mail_list_display($result['sender_email'], $result['reciever_email'], $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
                            }
                            echo "</table>";
                        }
                        if (isset($_POST['unread'])) {
                            $unread_query = "select * from mail_list where (reciever_email='{$email}' and inbox_status='unread') and mail_status='sent';";
                            echo "<table>";
                            $unread_query_output = $conn->query($unread_query);
                            while ($result = $unread_query_output->fetch_assoc()) {
                                row_color($result['inbox_status']);
                                mail_list_display($result['sender_email'], $result['reciever_email'], $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
                            }
                            echo "</table>";
                        }
                        if (isset($_POST['sent'])) {
                            $sent_query = "select * from mail_list where (sender_email='{$email}' and mail_status='sent') and archived='no'";
                            echo "<table>";
                            $sent_query_output = $conn->query($sent_query);
                            while ($result = $sent_query_output->fetch_assoc()) {
                                row_color($result['inbox_status']);
                                mail_list_display($result['sender_email'], $result['reciever_email'], $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
                            }
                            echo "</table>";
                        } elseif (isset($_POST['draft'])) {
                            $draft_query = "select * from mail_list where sender_email='{$email}'and mail_status='draft';";
                            echo "<table>";
                            $draft_query_output = $conn->query($draft_query);
                            while ($result = $draft_query_output->fetch_assoc()) {
                                row_color($result['inbox_status']);
                                mail_list_display($result['sender_email'], $result['reciever_email'], $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
                            }
                            echo "</table>";
                        } elseif (isset($_POST['starred'])) {
                            $starred_query = "select * from mail_list where (sender_email='{$email}' OR reciever_email='{$email}') AND  starred='yes' AND mail_status='sent';";
                            echo "<table>";
                            $starred_query_output = $conn->query($starred_query);
                            while ($result = $starred_query_output->fetch_assoc()) {
                                row_color($result['inbox_status']);
                                mail_list_display($result['sender_email'], $result['reciever_email'], $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
                            }
                            echo "</table>";
                        } elseif (isset($_POST['archived'])) {
                            $archive_query = "select * from mail_list where (sender_email='{$email}' OR reciever_email='{$email}') AND mail_status='sent' AND archived='yes';";
                            echo "<table>";
                            $archive_query_output = $conn->query($archive_query);
                            while ($result = $archive_query_output->fetch_assoc()) {
                                row_color($result['inbox_status']);
                                mail_list_display($result['sender_email'], $result['reciever_email'], $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
                            }
                            echo "</table>";
                        } elseif (isset($_POST['trash'])) {
                            $trash_query = "select * from mail_list where (sender_email='{$email}' or reciever_email='{$email}') and mail_status='trash'";
                            echo "<table>";
                            $trash_query_output = $conn->query($trash_query);
                            while ($result = $trash_query_output->fetch_assoc()) {
                                row_color($result['inbox_status']);
                                mail_list_display($result['sender_email'], $result['reciever_email'], $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
                            }
                            echo "</table>";
                        }
                        if (isset($_POST['search-btn'])) {
                            $search_content = !empty($_POST['search']) ? $_POST['search'] : "";
                            $search_query = "select * from mail_list where sender_email like '%$search_content%'";
                            $search_output = $conn->query($search_query);
                            echo "<table>";
                            while ($result = $search_output->fetch_assoc()) {
                                row_color($result['inbox_status']);
                                mail_list_display($result['sender_email'], $result['reciever_email'], $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
                            }
                        }
                            ?>
                            <div class="mail-list">
                                <div class="mail-display">
                                    <?php
                                    include 'config.php';
                                    $token_id = isset($_GET['token']) ? hex2bin($_GET['token']) : "";
                                    $mail_no = isset($_GET['mailno']) ? $_GET['mailno'] : "";
                                    if (!empty($token_id) && !empty($mail_no)) {
                                    ?>
                                        <form action="email.php?page=Email" method="post">
                                            <a href="email.php?page=Email"><button>
                                                    << </button></a><br><br>
                                        </form>
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
                                    $starred_mail = !empty($_POST['star-check']) ? $_POST['star-check'] : "";
                                    $archive_mail = !empty($_POST['archive-check']) ? $_POST['archive-check'] : "";
                                    if (isset($_POST['star'])) {
                                        foreach ($starred_mail as $mail_number) {
                                            $star_query = "update mail_list set starred='yes' where mail_no='$mail_number';";
                                            $star_output = $conn->query($star_query);
                                        }
                                    } elseif (isset($_POST['archive'])) {
                                        foreach ($archive_mail as $mail_number) {
                                            $archive_query = "update mail_list set archived='yes' where mail_no='$mail_number';";
                                            $archive_output = $conn->query($archive_query);
                                        }
                                    } elseif (isset($_POST['delete'])) {
                                        foreach ($archive_mail as $mail_number) {
                                            $delete_query = "update mail_list set mail_status='trash' where mail_no='$mail_number';";
                                            $delete_output = $conn->query($delete_query);
                                        }
                                    } elseif (isset($_POST['mark_as_read'])) {
                                        foreach ($archive_mail as $mail_number) {
                                            $mark_as_read_query = "update mail_list set inbox_status='read' where mail_no='$mail_number';";
                                            $mark_as_read_output = $conn->query($mark_as_read_query);
                                        }
                                    } elseif (isset($_POST['unarchive'])) {
                                        foreach ($archive_mail as $mail_number) {
                                            $unarchive_query = "update mail_list set archived='no' where mail_no='$mail_number';";
                                            $unarchive_query_output = $conn->query($unarchive_query);
                                        }
                                    } elseif (isset($_POST['unstar'])) {
                                        foreach ($starred_mail as $mail_number) {
                                            $unstar_query = "update mail_list set starred='no' where mail_no='$mail_number';";
                                            $unstar_output = $conn->query($unstar_query);
                                        }
                                    } elseif (isset($_POST['restore'])) {
                                        foreach ($archive_mail as $mail_number) {
                                            $restore_query = "update mail_list set mail_status='sent' where mail_no='$mail_number'";
                                            $restore_output = $conn->query($restore_query);
                                        }
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
                            }
            ?>
            </form>
                            </div>
                    </div>
                </div>
</body>

</html>