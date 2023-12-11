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
    if (isset($_POST[$button_name])) {
        echo $value1;
    } else {
        echo $value2;
    }
}

function dateconvertion($numericdate)
{
    $dateString = $numericdate;
    $date = new DateTime($dateString);
    $formattedDate = $date->format("d M y");
    return $formattedDate;
}
function row_color($i_status)
{
    global $bg_color, $color, $bold, $b_end;
    static $row = 1;
    if ($row % 2 == 0) {
        $bg_color = "background-color:white;";
    } else {
        $bg_color = "background-color:rgb(235, 233, 255);";
    }
    $row++;
    if ($i_status == "unread") {
        $bold = "<b>";
        $b_end = "</b>";
        $color = "color:black;";
    } else {
        $bold = "";
        $b_end = "";
        $color = "color:grey;";
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

function mail_list_display($sender_mail, $reciever_mail, $token, $m_no, $subject, $date)
{
    global $bold, $b_end, $bg_color, $color, $result;
?>
    <tr style="<?= $bg_color;$color ?>">
        <td style="width:10%;margin-left:20px;">
            <input type="checkbox" class="archive" name="archive-check[]" value="<?= $result['mail_no'] ?>">
            <input type="checkbox" class="star" name="star-check[]" value="<?= $result['mail_no'] ?>">
        </td>
        <td style="width:30%;">
            <a href="email.php?page=Email&token=<?= bin2hex($token) ?>&mailno=<?= $m_no ?>">
                <?= $bold . usermail_as_me($sender_mail, $reciever_mail) . $b_end ?>
            </a>
        </td>
        <td style="width:50%;">
            <a href="email.php?page=Email&token=<?= $token ?>&mailno=<?= $m_no ?>">
                <?= $subject ?>
            </a>
        </td>

        <td style="width:10%;">
            <a href="email.php?page=Email&token=<?= $token ?>&mailno=<?= $m_no ?>">
                <?= dateconvertion($date) ?>
            </a>
        </td>
    </tr>
<?php
}
?>