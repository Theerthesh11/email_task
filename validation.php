<?php
$email = "example@email.com";

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email is valid.";
} else {
    echo "Email is not valid.";
}
?>
<?php
$name = "John Doe";

if (preg_match("/^[a-zA-Z0-9 ]*$/", $name)) {
    echo "Name is valid.";
} else {
    echo "Name is not valid.";
}
?>
<?php
$mobileNumber = "1234567890";

if (preg_match("/^[0-9]{10}$/", $mobileNumber)) {
    echo "Mobile number is valid.";
} else {
    echo "Mobile number is not valid.";
}
?>
<?php
$dateOfBirth = "1990-01-01";

if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $dateOfBirth) && strtotime($dateOfBirth) !== false) {
    echo "Date of Birth is valid.";
} else {
    echo "Date of Birth is not valid.";
}
?>
<?php
$text = "Hello World";

// You can customize the validation based on your specific requirements
if (!empty($text)) {
    echo "Text is valid.";
} else {
    echo "Text is not valid.";
}
?>
