<?php
$pass = '123';
$hash_pass = password_hash($pass, PASSWORD_DEFAULT);
echo $hash_pass;
?>