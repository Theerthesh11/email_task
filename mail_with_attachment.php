<?php
$to = "recipient@example.com";
$subject = "Your Subject";
$message = "Hello, this is the body of the email.";

// Set the content type and boundary for the email
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";

// Add the message part
$body = "--boundary\r\n";
$body .= "Content-Type: text/plain; charset=iso-8859-1\r\n";
$body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$body .= $message . "\r\n";

// Add the attachment part
$attachment_path = "/path/to/your/file.txt";
$attachment_name = "file.txt";
$file_contents = file_get_contents($attachment_path);
$encoded_attachment = chunk_split(base64_encode($file_contents));

$body .= "--boundary\r\n";
$body .= "Content-Type: application/octet-stream; name=\"" . $attachment_name . "\"\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n";
$body .= "Content-Disposition: attachment; filename=\"" . $attachment_name . "\"\r\n\r\n";
$body .= $encoded_attachment . "\r\n";

// End the boundary
$body .= "--boundary--";

// Send the email
$mail_success = mail($to, $subject, $body, $headers);

if ($mail_success) {
    echo "Email sent successfully.";
} else {
    echo "Error sending email.";
}
?>
