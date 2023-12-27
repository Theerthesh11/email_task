<?php
//stores the value of the checked checkbox in this array
//starred_mail array stores the value of star-check
$starred_mail = !empty($_POST['star-check']) ? $_POST['star-check'] : array();
//checkbox_value array stores the values of check (checkbox)
//This array is passed into archive,trash,delete,mark_as_read
$checkbox_value = !empty($_POST['check']) ? $_POST['check'] : array();
//fetching data from db for options in email page
if (isset($_GET['option']) && !isset($_POST['reply'])) {
    //fetches data from db when option in url has Inbox as value
    if ($_GET['option'] == "Inbox" && !isset($_GET['token'])) {
        $inbox_query = "select * from mail_list where (reciever_email='{$email}' and mail_status='sent') and (archived='no' and spam='no')";
        $inbox_output = $conn->query($inbox_query);
        if ($inbox_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Inbox", $inbox_query, $inbox_output, $page_no);
            echo "</form></table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>No mails in inbox</p></div>";
        }
        email_options($starred_mail, $checkbox_value);
    }//fetches data from db when option in url has Unread as value 
    elseif ($_GET['option'] == "Unread" && !isset($_GET['token'])) {
        $unread_query = "select * from mail_list where (reciever_email='{$email}' and inbox_status='unread') and mail_status='sent'";
        $unread_output = $conn->query($unread_query);
        if ($unread_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Unread", $unread_query, $unread_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>All mails have been read already</p></div>";
        }
        email_options($starred_mail, $checkbox_value);
    }//fetches data from db when option in url has Sent as value
    elseif ($_GET['option'] == "Sent" && !isset($_GET['token'])) {
        $sent_query = "select * from mail_list where (sender_email='{$email}' and mail_status='sent') and archived='no'";
        $sent_output = $conn->query($sent_query);
        if ($sent_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Sent", $sent_query, $sent_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>No sent messages! <a href=\"email.php?page=Email&option=Compose\">Send</a> one now!</p></div>";
        }
        email_options($starred_mail, $checkbox_value);
    }//fetches data from db when option in url has Draft as value
    elseif ($_GET['option'] == "Draft" && !isset($_GET['token'])) {
        $draft_query = "select * from mail_list where sender_email='{$email}'and mail_status='draft'";
        $draft_output = $conn->query($draft_query);
        if ($draft_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Draft", $draft_query, $draft_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>No draft mails</p></div>";
        }
        email_options($starred_mail, $checkbox_value);
    }//fetches data from db when option in url has Starred as value
    elseif ($_GET['option'] == "Starred" && !isset($_GET['token'])) {
        $starred_query = "select * from mail_list where (sender_email='{$email}' OR reciever_email='{$email}') AND  starred='yes' AND mail_status='sent'";
        $starred_output = $conn->query($starred_query);
        if ($starred_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Starred", $starred_query, $starred_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>No starred mails</p></div>";
        }
        email_options($starred_mail, $checkbox_value);
    }//fetches data from db when option in url has Archived as value
    elseif ($_GET['option'] == "Archived" && !isset($_GET['token'])) {
        $archive_query = "select * from mail_list where (sender_email='{$email}' OR reciever_email='{$email}') AND mail_status='sent' AND archived='yes'";
        $archive_output = $conn->query($archive_query);
        if ($archive_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Archived", $archive_query, $archive_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>No archived mails</p></div>";
        }
        email_options($starred_mail, $checkbox_value);
    }//fetches data from db when option in url has Trash as value
    elseif ($_GET['option'] == "Trash" && !isset($_GET['token'])) {
        $trash_query = "select * from mail_list where (sender_email='{$email}' or reciever_email='{$email}') and mail_status='trash'";
        $trash_output = $conn->query($trash_query);
        if ($trash_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Trash", $trash_query, $trash_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>No deleted mails</p></div>";
        }
        email_options($starred_mail, $checkbox_value);
    }//fetches data from db when option in url has Spam as value
    elseif ($_GET['option'] == "Spam" && !isset($_GET['token'])) {
        $spam_query = "select * from mail_list where (reciever_email='$email' and mail_status='sent') and spam='yes'";
        $spam_output = $conn->query($spam_query);
        if ($spam_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Spam", $spam_query, $spam_output, $page_no);
            echo "</table></div>";
        } else {
            echo "<div class=\"alert-message\"><p>No Spam mails</p></div>";
        }
        email_options($starred_mail, $checkbox_value);
    }
    //fetches data according to search content
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
    }//fetches record from db which has attachment
    if (isset($_POST['attachment'])) {
        $attachment_query = "select * from mail_list where (reciever_email='$email' or sender_email='$email') and attachment_name is not null";
        $attachment_query_output = $conn->query($attachment_query);
        if ($attachment_query_output->num_rows > 0) {
            echo "<div class=\"table-container\"><table>";
            pagination("Attachment", $attachment_query, $attachment_query_output, $page_no);
            echo "</table></div>";
        }
    }
}
//mail sending code
if (isset($_POST['send'])) {
    if (!empty($_POST['mail']) && !empty($_POST['subject'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $to_mail = $_POST['mail'];//stores recipient mail
            $recipient_name = recipient_name($to_mail);
            $subject = $_POST['subject'];//stores user entered subject
            $notes = $_POST['notes'];//stores user entered notes content
            if (empty($notes)) {
                $spam = "yes";
            } else {
                $spam = "no";
            }
            $cc = !empty($_POST['cc']) ? $_POST['cc'] : "";
            $bcc = !empty($_POST['bcc']) ? $_POST['bcc'] : "";
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";

            // Add the message part
            $body = "--boundary\r\n";
            $body .= "Content-Type: text/plain; charset=iso-8859-1\r\n";
            $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $body .= $notes . "\r\n";
            $attachment_path = null;
            $attachment_name = "";
            if (!empty($_FILES['file']['name'])) {
                // print_r($_FILES);
                $uploadFolder = 'Attachments/' . $token_id . '/';
                if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
                    $tmpName = $_FILES['file']['tmp_name'];
                    $fileName = $_FILES['file']['name'];
                    move_uploaded_file($tmpName, $uploadFolder . $fileName);
                }
                // Add the attachment part
                $attachment_path = $uploadFolder . $fileName;
                $file_contents = file_get_contents($attachment_path);
                $encoded_attachment = chunk_split(base64_encode($file_contents));

                $body .= "--boundary\r\n";
                $body .= "Content-Type: application/octet-stream; name=\"" . $fileName . "\"\r\n";
                $body .= "Content-Transfer-Encoding: base64\r\n";
                $body .= "Content-Disposition: attachment; filename=\"" . $fileName . "\"\r\n\r\n";
                $body .= $encoded_attachment . "\r\n";
            }

            // End the boundary
            $body .= "--boundary--";
            if (!empty($cc) && !empty($bcc)) {
                $headers = 'Cc:' . $cc . "\r\n";
                $headers .= 'Bcc:' . $bcc . "\r\n";
            }
            $updated_by = $user_details_result['username'];//stores the username
            $created_by = $user_details_result['username'];
            //mail function to send the stored data
            if (mail($to_mail, $subject, $body, $headers)) {
                $mail_status = "sent";
                //generates unique mail_no for each mail
                $mail_no = strtoupper(substr($user_details_result['username'], 0, 2)) . random(5);
                echo "<div class=\"alert-message\"><p style=\" color:green;\"> Mail sent successfully</p></div>";
            } else {
                //stores as draft if mail not sent
                $mail_status = "draft";
                //generates unique mail_no for each mail
                $mail_no = strtoupper(substr($user_details_result['username'], 0, 2)) . random(5);
                echo "<div class=\"alert-message\"><p style=\" color:red;\">mail not sent</p></div>";
            }
            //inserts the value into the mail_list table
            $insert_query = $conn->prepare("insert into mail_list ( token_id, mail_no, sender_email,sender_name, reciever_email,reciever_name, cc, bcc, subject, notes,attachment_name,attachment_path, date_of_sending, mail_status, spam,updated_by, created_by, updated_on) values(?,?,?,?,?,?,?,?,?,?,?,?,current_timestamp,?,?,?,?,current_timestamp)");
            $insert_query->bind_param("ssssssssssssssss", $token_id, $mail_no, $email, $user_details_result['name'], $to_mail, $recipient_name, $cc, $bcc, $subject, $notes, $fileName, $attachment_path, $mail_status, $spam, $created_by, $updated_by);
            $insert_query->execute();
        } else {
            echo "<div class=\"alert-message\"><p style=\" color:red;\">Enter a valid email id</p></div>";
        }
    }
}
//saves the changes made in user profile
if (isset($_POST['save'])) {
    if (!empty($_POST)) {
        $update_details = "update user_details set username='{$_POST['user_name']}', name='{$_POST['name']}', date_of_birth='{$_POST['dob']}', phone_no='{$_POST['cell_number']}', updated_on = current_timestamp where email='{$result['email']}';";
        $conn->query($update_details);
    }
}
//logout button's code
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location:user_login.php");
}
