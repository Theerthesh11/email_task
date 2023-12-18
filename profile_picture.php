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
        echo "<img src='Uploads/user_profiles/profile" . $tkn_id . ".jpg'>";
    } else {
        echo "<a href=\"?page=User\">";
        echo "<img src='Uploads/profiledefault.jpg'>";
    }
    echo "</a>";
    echo "</div>";
}
if (isset($_POST['save'])) {
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
                    $file_destination = "Uploads/user_profiles/$file_new_name";
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
