<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="mail.php" enctype="multipart/form-data" method="post">
        <input type="submit" name="send" value="Send mail">
        <input type="reset" value="Clear"><br><br>
        <input type="file" name="file"><br><br>
        <label for="mail">TO:</label><br>
        <input type="text" id="mail" name="mail" value="" required><br><br>
        <label for="cc" style="margin-right:16px;">CC:</label>
        <input type="text" id="cc" name="cc"><br><br>
        <label for="bcc" style="margin-right:16px;">BCC:</label>
        <input type="text" id="bcc" name="bcc"><br><br>
        <label for="subject">SUBJECT:</label>
        <input type="text" id="subject" name="subject" required><br><br><br>
        <textarea name="notes" placeholder="Type here..."></textarea><br><br>
    </form>
</body>

</html>
<?php
if (isset($_POST['send'])) {
    if (!empty($_POST['mail']) && !empty($_POST['subject'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $to_mail = $_POST['mail'];
            // $recipient_name = recipient_name($to_mail);
            $subject = $_POST['subject'];
            $notes = $_POST['notes'];
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

            // Add the attachment part
            $attachment_name = $_FILES['file']['name'];
            $attachment_path = "Uploads/attachments/".$attachment_name;
            $file_contents = file_get_contents($attachment_path);
            $encoded_attachment = chunk_split(base64_encode($file_contents));

            $body .= "--boundary\r\n";
            $body .= "Content-Type: application/octet-stream; name=\"" . $attachment_name . "\"\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n";
            $body .= "Content-Disposition: attachment; filename=\"" . $attachment_name . "\"\r\n\r\n";
            $body .= $encoded_attachment . "\r\n";

            // End the boundary
            $body .= "--boundary--";

            if (!empty($cc) && !empty($bcc)) {
                $headers = 'Cc:' . $cc . "\r\n";
                $headers .= 'Bcc:' . $bcc . "\r\n";
            }
            // $updated_by = $user_details_result['username'];
            // $created_by = $user_details_result['username'];
            if (mail($to_mail, $subject, $body, $headers)) {
                // $mail_status = "sent";
                // $mail_no = strtoupper(substr($user_details_result['username'], 0, 2)) . random(5);
                echo "<div class=\"alert-message\"><p style=\" color:green;\"> Mail sent successfully</p></div>";
            } else {
                // $mail_status = "draft";
                // $mail_no = strtoupper(substr($user_details_result['username'], 0, 2)) . random(5);
                echo "<div class=\"alert-message\"><p style=\" color:red;\">mail not sent</p></div>";
            }
            // $insert_query = $conn->prepare("insert into mail_list ( token_id, mail_no, sender_email,sender_name, reciever_email,reciever_name, cc, bcc, subject, notes, date_of_sending, mail_status, spam,updated_by, created_by, updated_on) values(?,?,?,?,?,?,?,?,?,current_timestamp,?,?,?,?,current_timestamp)");
            // $insert_query->bind_param("ssssssssssssss", $token_id, $mail_no, $email, $user_details_result['name'], $to_mail, $recipient_name, $cc, $bcc, $subject, $notes, $mail_status, $spam, $created_by, $updated_by);
            // $insert_query->execute();
        } else {
            echo "<div class=\"alert-message\"><p style=\" color:red;\">Enter a valid email id</p></div>";
        }
    }
}
