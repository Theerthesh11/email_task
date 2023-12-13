<?php
require "config.php";
$results_per_page = 7;
$query = "select *from user_details";
$result = $conn->query($query);
$number_of_result = mysqli_num_rows($result);
$number_of_page = ceil($number_of_result / $results_per_page);
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
$page_first_result = ($page - 1) * $results_per_page;  
$query = "SELECT *FROM user_details LIMIT " . $page_first_result . ',' . $results_per_page;
$result = $conn->query($query);
while ($row = mysqli_fetch_array($result)) {
    echo $row['id'] . ' ' . $row['username'] . '</br>';
}  
for ($page = 1; $page <= $number_of_page; $page++) {
    echo '<a href = "sample1.php?page=' . $page . '">' . $page . ' </a>';
}
?>
