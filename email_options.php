<?php
$starred_mail = !empty($_POST['star-check']) ? $_POST['star-check'] : array();
$archive_mail = !empty($_POST['archive-check']) ? $_POST['archive-check'] : array();
if (!empty($_GET['option'])) {
    if ($_GET['option'] == "Inbox" && !isset($_GET['token'])) {
        $inbox_query = "select * from mail_list where (reciever_email='{$email}' and mail_status='sent') and archived='no';";
        $inbox_output = $conn->query($inbox_query);
        if ($inbox_output->num_rows > 0) {
            echo "<table>";
            while ($result = $inbox_output->fetch_assoc()) {
                row_color($result['inbox_status']);
                mail_list_display($result['sender_email'], $result['reciever_email'], $option, $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
            }
            echo "</table>";
        } else {
            echo "No mails in inbox";
        }
        email_options($starred_mail, $archive_mail);
    } elseif ($_GET['option'] == "Unread" && !isset($_GET['token'])) {
        $unread_query = "select * from mail_list where (reciever_email='{$email}' and inbox_status='unread') and mail_status='sent';";
        $unread_output = $conn->query($unread_query);
        if ($unread_output->num_rows > 0) {
            echo "<table>";
            while ($result = $unread_output->fetch_assoc()) {
                row_color($result['inbox_status']);
                mail_list_display($result['sender_email'], $result['reciever_email'], $option, $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
            }
            echo "</table>";
        } else {
            echo "All mails have been read already";
        }
        email_options($starred_mail, $archive_mail);
    } elseif ($_GET['option'] == "Sent" && !isset($_GET['token'])) {
        $sent_query = "select * from mail_list where (sender_email='{$email}' and mail_status='sent') and archived='no'";
        $sent_output = $conn->query($sent_query);
        if ($sent_output->num_rows > 0) {
            echo "<table>";
            while ($result = $sent_output->fetch_assoc()) {
                row_color($result['inbox_status']);
                mail_list_display($result['sender_email'], $result['reciever_email'], $option, $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
            }
            echo "</table>";
        } else {
            echo "No sent messages! <a href=\"email.php?page=Email&option=Compose\">Send</a> one now!";
        }
        email_options($starred_mail, $archive_mail);
    } elseif ($_GET['option'] == "Draft" && !isset($_GET['token'])) {
        $draft_query = "select * from mail_list where sender_email='{$email}'and mail_status='draft';";
        $draft_output = $conn->query($draft_query);
        if ($draft_output->num_rows > 0) {
            echo "<table>";
            while ($result = $draft_output->fetch_assoc()) {
                row_color($result['inbox_status']);
                mail_list_display($result['sender_email'], $result['reciever_email'], $option, $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
            }
            echo "</table>";
        } else {
            echo "No draft mails";
        }
        email_options($starred_mail, $archive_mail);
    } elseif ($_GET['option'] == "Starred" && !isset($_GET['token'])) {
        $starred_query = "select * from mail_list where (sender_email='{$email}' OR reciever_email='{$email}') AND  starred='yes' AND mail_status='sent';";
        $starred_output = $conn->query($starred_query);
        if ($starred_output->num_rows > 0) {
            echo "<table>";
            while ($result = $starred_output->fetch_assoc()) {
                row_color($result['inbox_status']);
                mail_list_display($result['sender_email'], $result['reciever_email'], $option, $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
            }
            echo "</table>";
        } else {
            echo "No starred mails";
        }
        email_options($starred_mail, $archive_mail);
    } elseif ($_GET['option'] == "Archived" && !isset($_GET['token'])) {
        $archive_query = "select * from mail_list where (sender_email='{$email}' OR reciever_email='{$email}') AND mail_status='sent' AND archived='yes';";
        $archive_output = $conn->query($archive_query);
        if ($archive_output->num_rows > 0) {
            echo "<table>";
            while ($result = $archive_output->fetch_assoc()) {
                row_color($result['inbox_status']);
                mail_list_display($result['sender_email'], $result['reciever_email'], $option, $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
            }
            echo "</table>";
        } else {
            echo "No archived mails";
        }
        email_options($starred_mail, $archive_mail);
    } elseif ($_GET['option'] == "Trash" && !isset($_GET['token'])) {
        $trash_query = "select * from mail_list where (sender_email='{$email}' or reciever_email='{$email}') and mail_status='trash'";
        $trash_output = $conn->query($trash_query);
        if ($trash_output->num_rows > 0) {
            echo "<table>";
            while ($result = $trash_output->fetch_assoc()) {
                row_color($result['inbox_status']);
                mail_list_display($result['sender_email'], $result['reciever_email'], $option, $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
            }
            echo "</table>";
        } else {
            echo "No deleted mails";
        }
        email_options($starred_mail, $archive_mail);
    } elseif ($_GET['option'] == "Spam" && !isset($_GET['token'])) {
        $spam_query = "select * from mail_list where (reciever_email='$email' and mail_status='sent') and spam='yes';";
        $spam_output = $conn->query($spam_query);
        if ($spam_output->num_rows > 0) {
            echo "<table>";
            while ($result = $spam_output->fetch_assoc()) {
                row_color($result['inbox_status']);
                mail_list_display($result['sender_email'], $result['reciever_email'], $option, $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
            }
            echo "</table>";
        } else {
            echo "No Spam mails";
        }
        email_options($starred_mail, $archive_mail);
    }
    if ((isset($_POST['search-btn']))) {
        if (isset($_GET['search']) && !isset($_GET['token'])) {
            if (!empty($_POST['search'])) {
                $search_content = $_POST['search'];
                $search_query = "select * from mail_list where sender_email like '%$search_content%'";
                $search_output = $conn->query($search_query);
                if ($search_output->num_rows > 0) {
                    echo "<table>";
                    while ($result = $search_output->fetch_assoc()) {
                        row_color($result['inbox_status']);
                        mail_list_display($result['sender_email'], $result['reciever_email'], $option, $result['token_id'], $result['mail_no'], $result['subject'], $result['date_of_sending']);
                    }
                    echo "</table>";
                } else {
                    echo "No results found";
                }
            } else {
                echo "No results founds";
            }
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
            // $headers = 'Cc:' . $cc . "\r\n";
            // $headers .= 'Bcc:' . $bcc . "\r\n";
            $updated_by = $user_details_result['username'];
            $created_by = $user_details_result['username'];
            if (!mail($to_mail, $subject, $notes)) {
                $mail_status = "sent";
                $mail_no = "TH031";
                echo "<div class=\"email-form\"><p style=\" color:green;\"> Mail sent successfully</p></div>";
            } else {
                $mail_status = "draft";
                $mail_no = "TH078";
                echo "<p style=\" color:red;\">mail not sent</p>";
            }
            $insert_query = $conn->prepare("insert into mail_list ( token_id, mail_no, sender_email, name, reciever_email, cc, bcc, subject, notes, date_of_sending, mail_status, spam,updated_by, created_by, updated_on) values(?,?,?,?,?,?,?,?,?,current_timestamp,?,?,?,?,current_timestamp)");
            $insert_query->bind_param("sssssssssssss", $token_id, $mail_no, $email, $user_details_result['name'], $to_mail, $cc, $bcc, $subject, $notes, $mail_status, $spam, $created_by, $updated_by);
            $insert_query->execute();
        } else {
            echo "<p style=\" color:red;\">Enter a valid email id</p>";
        }
    }
}
