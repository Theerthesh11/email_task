<?php
$access_query = "select * from admin_page_access where token_id='$token';";
$access_output = $conn->query($access_output);
if ($access_output->num_rows > 0) {
    $access_result = $access_output->fetch_assoc();
}
    // if ($access_result['ibox_dashboard'] == '1') {
    //     echo 'class="checked"';
    // } else {
    //     echo 'class="unchecked"';
    // }
// }
