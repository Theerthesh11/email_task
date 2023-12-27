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


function pagination_admin_activity($table_name, $page, $query = "select * from user_details")
{
    require "config.php";
    $query = "select * from $table_name";
    $results_per_page = 5;
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
            <td style="width:16%;margin-left:20px;"><?= $user_details_result['name'] ?></td>
            <td style="width:20%;"><?= $user_details_result['email'] ?></td>
            <td style="width:10%;text-align:center;"><input type="checkbox" name="delete_access" value="<?=$user_details_result['token_id']?>" ></td>
            <td style="width:11%;text-align:center"><?= $user_details_result['date_of_birth'] ?></td>
            <td style="width:11%;text-align:center"><?= $user_details_result['phone_no'] ?></td>
            <td style="width:11%;text-align:center"><?= $user_details_result['created_on'] ?></td>
            <td style="width:11%;text-align:center"><?= $user_details_result['last_login'] ?></td>
            <?php if (isset($_POST['view_count']) && $_POST['record_id'] == $user_details_result['token_id']) {
            ?>
                <td style="width: 5%;text-align:center"><?= total_mail("sender_email", $user_details_result['email'], "and mail_status='sent');")?></td>
                <td style="width: 5%;text-align:center"><?= total_mail("reciever_email", $user_details_result['email'], "and mail_status='sent');") ?></td>
        </tr>
    <?php
            } else {
    ?>
        <td style="width:8%;text-align:center">
            <form method='post' action='admin_dashboard.php?page=User List&page_no=<?=$page_no?>'>
                <input type='hidden' name='record_id' value="<?= $user_details_result['token_id'] ?>">
                <input type='submit' name='view_count' value='View count'>
            </form>
        </td>
    <?php
            }
            $row++;
        }
        echo '<div class="page_numbers">';
        for ($page_no = 1; $page_no <= $number_of_page; $page_no++) {
            echo '<button ><a href = "admin_dashboard.php?page=' . $page . '&page_no=' . $page_no . '">' .  $page_no . ' </a></button>';
        }
        echo "</div><br><hr><br>";
    }

    function admin_details()
    {
        require "config.php";
        $admin_details_query = "select * from admin_details;";
        $admin_details_output = $conn->query($admin_details_query);
        if ($admin_details_output->num_rows>0) {
            while ($admin_details_result = $admin_details_output->fetch_assoc()) {
                static $row = 1;
                if ($row % 2 == 0) {
                    $bg_color = "background-color:rgb(235, 233, 255);";
                } else {
                    $bg_color = "background-color:white;";
                }
    ?>
        <tr style="<?= $bg_color; ?>">
            <td style="text-align: center;"><?= $admin_details_result['emp_id'] ?></td>
            <td><?= $admin_details_result['name'] ?></td>
            <td><?= $admin_details_result['email'] ?></td>
            <td style="text-align: center;"><?= $admin_details_result['role'] ?></td>
            <td style="text-align: center;"><?= $admin_details_result['phone_no'] ?></td>
            <td style="text-align: center;"><?= $admin_details_result['date_of_birth'] ?></td>
            <td style="text-align: center;"><?= $admin_details_result['created_on'] ?></td>
            <td style="text-align: center;"><?= $admin_details_result['last_login'] ?></td>
        </tr>
    <?php
                $row++;
            }
        }
    }

    function login_activity()
    {
        require "config.php";
        $login_activity_query = "select * from login_activity;";
        $login_activity_output = $conn->query($login_activity_query);
        if ($login_activity_output->num_rows>0) {
            while ($login_activity_result = $login_activity_output->fetch_assoc()) {
                static $row = 1;
                if ($row % 2 == 0) {
                    $bg_color = "background-color:rgb(235, 233, 255);";
                } else {
                    $bg_color = "background-color:white;";
                }
    ?>
        <tr style="<?= $bg_color; ?>">
            <td><?= $login_activity_result['emp_id'] ?></td>
            <td><?= $login_activity_result['username'] ?></td>
            <td><?= $login_activity_result['role'] ?></td>
            <td><?= $login_activity_result['activity'] ?></td>
            <td><?= $login_activity_result['login_time'] ?></td>
            <td><?= $login_activity_result['logout_time'] ?></td>
        <?php
                $row++;
            }
        }
    }

    function activity($activity, $emp_id, $login_time)
    {
        require "config.php";
        $activity_query = "update login_activity set activity = CONCAT(activity, '$activity') WHERE emp_id='$emp_id' and login_time='$login_time';";
        $conn->query($activity_query);
    }

    // function profile_picture($token_id)
    // {
    //     require "config.php";
    //     $user_details_query = "select * from admin_details where token_id='$token_id';";
    //     $output = $conn->query($user_details_query);
    //     if (!is_bool($output)) {
    //         $result = $output->fetch_assoc();
    //         echo "<div>";
    //         if ($result['profile_status'] == 0) {
    //             $tkn_id = bin2hex($token_id);
    //             echo "<a href=\"?page=Admin\">";
    //             echo "<img src='Uploads/admin/profile" . $tkn_id . ".jpg'>";
    //         } else {
    //             echo "<a href=\"?page=Admin\">";
    //             echo "<img src='Uploads/profiledefault.jpg'>";
    //         }
    //         echo "</a>";
    //         echo "</div>";
    //     }
    // }

    function total_mail($column_name, $email, $addition = " ")
    {
        require "config.php";
        $count_query = "select count($column_name) from mail_list where ($column_name='$email' $addition ";
        $count_output = $conn->query($count_query);
        if ($count_output->num_rows > 0) {
            if ($result = $count_output->fetch_assoc()) {
                echo "<p>" . $result["count($column_name)"] . "</p>";
            } else {
                return;
            }
        } else {
            return;
        }
    }

    function admin()
    {
        require "config.php";
        $admin_details_query = "select * from admin_details where role='admin';";
        $admin_details_output = $conn->query($admin_details_query);
        if ($admin_details_output->num_rows > 0) {
            while ($admin_details_result = $admin_details_output->fetch_assoc()) {
        ?>
        <tr style="text-align:center;">
            <td><?= $admin_details_result['emp_id'] ?></td>
            <td><?= $admin_details_result['username'] ?></td>
            <td><?= $admin_details_result['name'] ?></td>
            <td><input type="checkbox" name="ibox_access[]" value="<?= $admin_details_result['token_id'] ?>"></td>
            <td><input type="checkbox" name="admin_list_access[]" value="<?= $admin_details_result['token_id'] ?>"></td>
            <td><input type="checkbox" name="user_list_access[]" value="<?= $admin_details_result['token_id'] ?>"></td>
            <td><input type="checkbox" name="login_activity_access[]" value="<?= $admin_details_result['token_id'] ?>"></td>
            <td><input type="checkbox" name="access_page_access[]" value="<?= $admin_details_result['token_id'] ?>"></td>
        </tr>
<?php
            }
        }
    }
