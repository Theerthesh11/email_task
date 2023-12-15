<?php

function total_mail($column_name, $addition = " ")
{
    global $email;
    require "config.php";
    $count_query = "select count($column_name) from mail_list where ($column_name='{$email}' $addition ;";
    $count_output = $conn->query($count_query);
    if (!is_bool($count_output)) {
        if ($result = $count_output->fetch_assoc()) {
            if ($result["count($column_name)"] > 0) {
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
function row_color($i_status, $sent = "")
{
    global $bg_color, $color, $bold, $b_end;
    static $row = 1;
    if ($row % 2 == 0) {
        $bg_color = "background-color:white;";
    } else {
        $bg_color = "background-color:rgb(235, 233, 255);";
    }
    $row++;
    if ($i_status == "read") {
        $bold = "";
        $b_end = "";
        $color = "color:grey;";
    } else {
        $bold = "<b>";
        $b_end = "</b>";
        $color = "color:black;";
    }
}
function usermail_as_me($sender_mail, $reciever_mail)
{
    global $email, $result;
    if ($sender_mail == $email) {
        echo "me, " . $result['name'];
    } elseif ($reciever_mail == $email) {
        echo $result['name'] . ", me";
    }
}

function mail_list_display($sender_mail, $reciever_mail, $option, $token, $m_no, $subject, $date)
{
    global $bold, $b_end, $bg_color, $color, $result;
?>
    <tr class="mail-line" style="<?= $bg_color;
                                    $color ?>">
        <td style="width:10%;margin-left:20px;">
            <input type="checkbox" name="archive-check[]" value="<?= $result['mail_no'] ?>" class="archive">
            <input type="checkbox" name="star-check[]" value="<?= $result['mail_no'] ?>" <?= $result['starred'] == 'no' ? 'class="star"' : 'class="stared"' ?>>
        </td>
        <td style="width:30%;">
            <a href="email.php?page=Email&option=<?= $option ?>&token=<?= bin2hex($token) ?>&mailno=<?= $m_no ?>" style="<?= $color ?>">
                <?= $bold . usermail_as_me($sender_mail, $reciever_mail) . $b_end ?>
            </a>
        </td>
        <td style="width:50%;">
            <a href="email.php?page=Email&option=<?= $option ?>&token=<?= bin2hex($token) ?>&mailno=<?= $m_no ?>" style="<?= $color ?>">
                <?= $subject ?>
            </a>
        </td>

        <td style="width:10%;">
            <a href="email.php?page=Email&option=<?= $option ?>&token=<?= bin2hex($token) ?>&mailno=<?= $m_no ?>" style="margin-right:20px;<?= $color ?>">
                <?= dateconvertion($date) ?>
            </a>
        </td>
    </tr>
<?php
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
?>