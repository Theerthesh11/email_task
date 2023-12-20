<?php
function random($length)
{
    $result = substr(str_shuffle('1234567890ABCDEF'), 0, $length);
    return $result;
}
function random_byte()
{
    return substr(str_shuffle('89AB'), 0, 1);
}

function recipient_name($to_mail)
{
    require 'config.php';
    $fetch_name_query = "select name from user_details where email='$to_mail';";
    $fetch_name_output = $conn->query($fetch_name_query);
    if ($fetch_name_output->num_rows > 0) {
        $fetch_name_result = $fetch_name_output->fetch_assoc();
        return $fetch_name_result['name'];
    } else {
        $name_find = strpos($to_mail, "@");
        $find_string = substr($to_mail, 0, $name_find);
        $reciever_name = preg_replace('/[0-9]+/', '', $find_string);
        return ucfirst($reciever_name);
    }
}
function total_mail($column_name, $addition = " ")
{
    global $email;
    require "config.php";
    $count_query = "select count($column_name) from mail_list where ($column_name='$email' $addition ;";
    $count_output = $conn->query($count_query);
    if ($count_output->num_rows > 0) {
        if ($result = $count_output->fetch_assoc()) {
            if ($result["count($column_name)"]) {
                echo "<p>" . $result["count($column_name)"] . "</p>";
            } else {
                return;
            }
        }
    } else {
        return;
    }
}

function trash_mail($column, $column_name, $column_name2, $addition = " ")
{
    global $email;
    require "config.php";
    $count_query = "select count($column) from mail_list where ($column_name='{$email}' or $column_name2='{$email}') and $addition";
    $count_output = $conn->query($count_query);
    if (!is_bool($count_output)) {
        if ($result = $count_output->fetch_assoc()) {
            if ($result["count($column)"] > 0) {
                echo "<p>" . $result["count($column)"] . "</p>";
            } else {
                return;
            }
        }
    } else {
        return;
    }
}

function name_setting($button_name, $value1, $value2)
{
    if (!empty($_GET['option'])) {
        if ($_GET['option'] == $button_name) {
            echo $value1;
        } else {
            echo $value2;
        }
    } else {
        if (isset($_POST[$button_name])) {
            echo $value1;
        } else {
            echo $value2;
        }
    }
}

function dateconvertion($numericdate)
{
    $dateString = $numericdate;
    $date = new DateTime($dateString);
    $formattedDate = $date->format("d M ");
    return $formattedDate;
}
function row_color($i_status)
{
    global $bg_color, $color;
    static $row = 1;
    if ($row % 2 == 0) {
        $row++;
        return $bg_color = "background-color:white;";
    } else {
        $row++;
        return $bg_color = "background-color:rgb(235, 233, 255);";
    }
    if ($i_status == "read") {
        $color = "color:grey;";
    } else {
        $color = "color:black;";
    }
}
function usermail_as_me($sender_mail, $reciever_mail, $sender_username, $reciever_username)
{
    global $email;
    // $fetch_username_query = "select * from mail_list where mail_no='';";
    if ($sender_mail == $email) {
        echo "me, " . $reciever_username;
    } elseif ($reciever_mail == $email) {
        echo $sender_username . ", me";
    }
}


function email_options($starred_mail, $archive_mail)
{
    require "config.php";
    if (isset($_POST['star'])) {
        foreach ($starred_mail as $mail_number) {
            $star_query = "update mail_list set starred='yes' where mail_no='$mail_number';";
            $star_output = $conn->query($star_query);
        }
    } elseif (isset($_POST['archive'])) {
        foreach ($archive_mail as $mail_number) {
            $archive_query = "update mail_list set archived='yes' where mail_no='$mail_number';";
            $archive_output = $conn->query($archive_query);
        }
    } elseif (isset($_POST['delete'])) {
        foreach ($archive_mail as $mail_number) {
            $delete_query = "update mail_list set mail_status='trash' where mail_no='$mail_number';";
            $delete_output = $conn->query($delete_query);
        }
    } elseif (isset($_POST['mark_as_read'])) {
        foreach ($archive_mail as $mail_number) {
            $mark_as_read_query = "update mail_list set inbox_status='read' where mail_no='$mail_number';";
            $mark_as_read_output = $conn->query($mark_as_read_query);
        }
    } elseif (isset($_POST['unarchive'])) {
        foreach ($archive_mail as $mail_number) {
            $unarchive_query = "update mail_list set archived='no' where mail_no='$mail_number';";
            $unarchive_query_output = $conn->query($unarchive_query);
        }
    } elseif (isset($_POST['unstar'])) {
        foreach ($starred_mail as $mail_number) {
            $unstar_query = "update mail_list set starred='no' where mail_no='$mail_number';";
            $unstar_output = $conn->query($unstar_query);
        }
    } elseif (isset($_POST['restore'])) {
        foreach ($archive_mail as $mail_number) {
            $restore_query = "update mail_list set mail_status='sent' where mail_no='$mail_number'";
            $restore_output = $conn->query($restore_query);
        }
    }
}
function pagination($page, $query, $result, $page_number)
{
    global $email;
    require "config.php";
    $results_per_page = 10;
    $number_of_result = $result->num_rows;
    $number_of_page = ceil($number_of_result / $results_per_page);
    if (!isset($_GET['page_no'])) {
        $page_no = 1;
    } else {
        $page_no = $_GET['page_no'];
    }
    $page_first_result = ($page_no - 1) * $results_per_page;
    $pagination_query =  "$query LIMIT " . $page_first_result . ',' . $results_per_page;
    $pagination_output = $conn->query($pagination_query);
    if ($pagination_output->num_rows > 0) {
        while ($pagination_result = $pagination_output->fetch_assoc()) {
            static $row = 1;
            if ($row % 2 == 0) {
                $row++;
                $bg_color = "background-color:white;";
            } else {
                $row++;
                $bg_color = "background-color:rgb(235, 233, 255);";
            }
            if ($pagination_result['inbox_status'] == "read") {
                $color = "color:grey;";
            } elseif ($pagination_result['sender_email'] == $email) {
                $color = "color:grey;";
            } else {
                $color = "color:black;";
            }
?>
            <tr class="mail-line" style="<?= $bg_color;
                                            $color ?>">
                <td style="width:10%;margin-left:20px;">
                    <input type="checkbox" name="check[]" value="<?= $pagination_result['mail_no'] ?>" class="archive">
                    <input type="checkbox" name="star-check[]" value="<?= $pagination_result['mail_no'] ?>" <?= $pagination_result['starred'] == 'no' ? 'class="star"' : 'class="stared"' ?>>
                </td>
                <td style="width:30%;">
                    <a href="email.php?page=Email&option=<?= $page ?>&page_no=<?= $page_number ?>&token=<?= urlencode(base64_encode($pagination_result['token_id']))  ?>&mailno=<?= $pagination_result['mail_no'] ?>" style="<?= $color ?>">
                        <?= usermail_as_me($pagination_result['sender_email'], $pagination_result['reciever_email'], $pagination_result['sender_name'], $pagination_result['reciever_name']) ?>
                    </a>
                </td>
                <td style="width:50%;">
                    <a href="email.php?page=Email&option=<?= $page ?>&page_no=<?= $page_number ?>&token=<?= urlencode(base64_encode($pagination_result['token_id'])) ?>&mailno=<?= $pagination_result['mail_no'] ?>" style="<?= $color ?>">
                        <?= $pagination_result['subject'] ?>
                    </a>
                </td>

                <td style="width:10%;">
                    <a href="email.php?page=Email&option=<?= $page ?>&page_no=<?= $page_number ?>&token=<?= urlencode(base64_encode($pagination_result['token_id'])) ?>&mailno=<?= $pagination_result['mail_no'] ?>" style="margin-right:20px;<?= $color ?>">
                        <?= dateconvertion($pagination_result['date_of_sending']) ?>
                    </a>
                </td>
            </tr>
<?php
        }
    }
    echo '<div class="result-page-numbers"><div class="page_numbers">';
    for ($page_no = 1; $page_no <= $number_of_page; $page_no++) {
        echo '<button><a href = "email.php?page=Email&option=' . $page . '&page_no=' . $page_no . '"> ' .  $page_no . ' </a></button>';
    }
    echo "</div><br>";
    if ($page == "Search") {
        echo '<div class="results">Search results(' . $result->num_rows . ')</div>';
    }
    echo '</div><br>';
}

?>