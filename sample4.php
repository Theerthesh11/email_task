<?php
$pass = '1234';
$hash_pass = password_hash($pass, PASSWORD_DEFAULT);
echo $hash_pass;
// $name_find = strpos($to_mail, "@");
// $find_string = substr($to_mail, 0, $name_find);
// $reciever_username = preg_replace('/[0-9]+/', '', $find_string);
// echo $reciever_username;
