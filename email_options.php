<?php
$starred_mail = !empty($_POST['star-check']) ? $_POST['star-check'] : array();
$archive_mail = !empty($_POST['archive-check']) ? $_POST['archive-check'] : array();
if (isset($_GET['option']) && !isset($_POST['reply'])) {
    if ($_GET['option'] == "Inbox" && !isset($_GET['token'])) {
        $inbox_query = "select * from mail_list where (reciever_email='{$email}' and mail_status='sent') and archived='no'";
        $inbox_output = $conn->query($inbox_query);
        if ($inbox_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Inbox", $inbox_query, $inbox_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>No mails in inbox</p></div>";
        }
        email_options($starred_mail, $archive_mail);
    } elseif ($_GET['option'] == "Unread" && !isset($_GET['token'])) {
        $unread_query = "select * from mail_list where (reciever_email='{$email}' and inbox_status='unread') and mail_status='sent'";
        $unread_output = $conn->query($unread_query);
        if ($unread_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Unread", $unread_query, $unread_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>All mails have been read already</p></div>";
        }
        email_options($starred_mail, $archive_mail);
    } elseif ($_GET['option'] == "Sent" && !isset($_GET['token'])) {
        $sent_query = "select * from mail_list where (sender_email='{$email}' and mail_status='sent') and archived='no'";
        $sent_output = $conn->query($sent_query);
        if ($sent_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Sent", $sent_query, $sent_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>No sent messages! <a href=\"email.php?page=Email&option=Compose\">Send</a> one now!</p></div>";
        }
        email_options($starred_mail, $archive_mail);
    } elseif ($_GET['option'] == "Draft" && !isset($_GET['token'])) {
        $draft_query = "select * from mail_list where sender_email='{$email}'and mail_status='draft'";
        $draft_output = $conn->query($draft_query);
        if ($draft_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Draft", $draft_query, $draft_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>No draft mails</p></div>";
        }
        email_options($starred_mail, $archive_mail);
    } elseif ($_GET['option'] == "Starred" && !isset($_GET['token'])) {
        $starred_query = "select * from mail_list where (sender_email='{$email}' OR reciever_email='{$email}') AND  starred='yes' AND mail_status='sent'";
        $starred_output = $conn->query($starred_query);
        if ($starred_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Starred", $starred_query, $starred_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>No starred mails</p></div>";
        }
        email_options($starred_mail, $archive_mail);
    } elseif ($_GET['option'] == "Archived" && !isset($_GET['token'])) {
        $archive_query = "select * from mail_list where (sender_email='{$email}' OR reciever_email='{$email}') AND mail_status='sent' AND archived='yes'";
        $archive_output = $conn->query($archive_query);
        if ($archive_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Archived", $archive_query, $archive_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>No archived mails</p></div>";
        }
        email_options($starred_mail, $archive_mail);
    } elseif ($_GET['option'] == "Trash" && !isset($_GET['token'])) {
        $trash_query = "select * from mail_list where (sender_email='{$email}' or reciever_email='{$email}') and mail_status='trash'";
        $trash_output = $conn->query($trash_query);
        if ($trash_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Trash", $trash_query, $trash_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>No deleted mails</p></div>";
        }
        email_options($starred_mail, $archive_mail);
    } elseif ($_GET['option'] == "Spam" && !isset($_GET['token'])) {
        $spam_query = "select * from mail_list where (reciever_email='$email' and mail_status='sent') and spam='yes'";
        $spam_output = $conn->query($spam_query);
        if ($spam_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Spam", $spam_query, $spam_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>No Spam mails</p></div>";
        }
        email_options($starred_mail, $archive_mail);
    }
    if ($_GET['option'] == "Search" && !isset($_GET['token'])) {
        // if (!empty($_POST['search'])) {
        $search_content = $_POST['search'];
        $search_query = "select * from mail_list where (reciever_email='$email' or sender_email='$email') and sender_email like '%$search_content%'";
        $search_output = $conn->query($search_query);
        if ($search_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Search", $search_query, $search_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>No results found</p></div>";
        }
    }
}

if (isset($_POST['send'])) {
    if (!empty($_POST['mail']) && !empty($_POST['subject'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $to_mail = $_POST['mail'];
            $subject = $_POST['subject'];
            $notes = $_POST['notes'];
            if (empty($notes)) {
                $spam = "yes";
            } else {
                $spam = "no";
            }
            $cc = !empty($_POST['cc']) ? $_POST['cc'] : "";
            $bcc = !empty($_POST['bcc']) ? $_POST['bcc'] : "";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            if (!empty($cc) && !empty($bcc)) {
                $headers = 'Cc:' . $cc . "\r\n";
                $headers .= 'Bcc:' . $bcc . "\r\n";
            }
            $updated_by = $user_details_result['username'];
            $created_by = $user_details_result['username'];
            if (mail($to_mail, $subject, $notes, $headers)) {
                $mail_status = "sent";
                $mail_no = strtoupper(substr($user_details_result['username'], 0, 2)) . random(5);
                echo "<div class=\"alert-message\"><p style=\" color:green;\"> Mail sent successfully</p></div>";
            } else {
                $mail_status = "draft";
                $mail_no = strtoupper(substr($user_details_result['username'], 0, 2)) . random(5);
                echo "<div class=\"alert-message\"><p style=\" color:red;\">mail not sent</p></div>";
            }
            $insert_query = $conn->prepare("insert into mail_list ( token_id, mail_no, sender_email, name, reciever_email, cc, bcc, subject, notes, date_of_sending, mail_status, spam,updated_by, created_by, updated_on) values(?,?,?,?,?,?,?,?,?,current_timestamp,?,?,?,?,current_timestamp)");
            $insert_query->bind_param("sssssssssssss", $token_id, $mail_no, $email, $user_details_result['name'], $to_mail, $cc, $bcc, $subject, $notes, $mail_status, $spam, $created_by, $updated_by);
            $insert_query->execute();
        } else {
            echo "<div class=\"alert-message\"><p style=\" color:red;\">Enter a valid email id</p></div>";
        }
    }
}
if (isset($_POST['save'])) {
    if (!empty($_POST)) {
        $update_details = "update user_details set username='{$_POST['user_name']}', name='{$_POST['name']}', date_of_birth='{$_POST['dob']}', phone_no='{$_POST['cell_number']}', updated_on = current_timestamp where email='{$result['email']}';";
        $conn->query($update_details);
    }
}
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location:user_login.php");
}
