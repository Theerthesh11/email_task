<?php
function total_ibox_mail($addition = "")
{
    require "config.php";
    $total_mail_query = "select count(id) from mail_list $addition;";
    $total_mail_output = $conn->query($total_mail_query);
    if (!is_bool($total_mail_output)) {
        $total_mail_result = $total_mail_output->fetch_assoc();
        echo $total_mail_result['count(id)'];
    }
}

function total_users($addition = "")
{
    require "config.php";
    $total_user_query = "select count(id) from user_details $addition;";
    $total_user_output = $conn->query($total_user_query);
    if (!is_bool($total_user_output)) {
        $total_user_result = $total_user_output->fetch_assoc();
        echo $total_user_result['count(id)'];
    }
}

function total_admins($addition = "")
{
    require "config.php";
    $total_admin_query = "select count(id) from admin_details $addition;";
    $total_admin_output = $conn->query($total_admin_query);
    if (!is_bool($total_admin_output)) {
        $total_admin_result = $total_admin_output->fetch_assoc();
        echo $total_admin_result['count(id)'];
    }
}


function pagination($table_name, $query = "select * from user_details")
{
    require "config.php";
    $query = "select * from $table_name";
    $results_per_page = 12;
    $result = $conn->query($query);
    $number_of_result = mysqli_num_rows($result);
    $number_of_page = ceil($number_of_result / $results_per_page);
    if (!isset($_GET['page_no'])) {
        $page_no = 1;
    } else {
        $page_no = $_GET['page_no'];
    }
    $page_first_result = ($page_no - 1) * $results_per_page;
    $user_details_query =  "$query LIMIT " . $page_first_result . ',' . $results_per_page;
    $user_details_output = $conn->query($user_details_query);
    while ($user_details_result = $user_details_output->fetch_assoc()) {
        static $row = 1;
        if ($row % 2 == 0) {
            $bg_color = "background-color:rgb(235, 233, 255);";
        } else {
            $bg_color = "background-color:white;";
        }
?>
        <tr style="<?= $bg_color; ?>">
            <td style="width:20%;margin-left:20px;">
                <?= $user_details_result['name'] ?>
            </td>
            <td style="width:28%;">
                <?= $user_details_result['email'] ?>
            </td>
            <td style="width:13%;">
                <?= $user_details_result['date_of_birth'] ?>
            </td>
            <td style="width:13%;">
                <?= $user_details_result['phone_no'] ?>
            </td>
            <td style="width:13%;">
                <?= $user_details_result['created_on'] ?>
            </td>
            <td style="width:13%;">
                <?= $user_details_result['last_login'] ?>
            </td>
        </tr>
<?php
        $row++;
    }
    for ($page_no = 1; $page_no <= $number_of_page; $page_no++) {
        echo '<a href = "admin_dashboard.php?page=User List&page_no=' . $page_no . '">' . $page_no . ' </a>';
    }
}
