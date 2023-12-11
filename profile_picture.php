<?php
require_once "config.php";
$user_details_query = "select * from user_details where token_id='$token_id'";
$output = $conn->query($user_details_query);
if (!is_bool($output)) {
    $result = $output->fetch_assoc();
    echo "<div>";
    if ($result['profile_status'] == 0) {
        $tkn_id = bin2hex($token_id);
        echo "<a href=\"?page=User\">";
        echo "<img src='Uploads/profile" . $tkn_id . ".jpg'>";
    } else {
        echo "<a href=\"?page=User\">";
        echo "<img src='Uploads/profiledefault.jpg'>";
    }
    echo "</a>";
    echo "</div>";
}
