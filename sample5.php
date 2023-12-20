<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Split Form Declarations</title>
</head>

<body>

    <!-- First Declaration: Text Input -->
    <form id="myForm" action="sample5.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">



        <!-- Some other content -->

        <!-- Second Declaration: Submit Button -->
        <form id="myForm" action="sample4.php" method="post">
            <input type="submit" name="submit" value="Submit">
        </form>

</body>

</html>
<?php
print_r($_POST);
?>