<?php
require "config.php";
if($user_details_result['trash_delete']=='yes' && $_GET['option']=='Trash'){
    echo '<input type="submit" name="delete" value="Delete">';
}
?>