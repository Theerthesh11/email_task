<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkbox Submit</title>
</head>
<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Form is submitted
        $checkboxChecked = isset($_POST["myCheckbox"]);

        if ($checkboxChecked) {
            echo "Form submitted successfully!";
        } else {
            echo "Checkbox not checked. Please check the checkbox before submitting.";
        }
    }
    ?>

    <form action="" method="post">
        <label>
            <input type="checkbox" name="myCheckbox"> Check me before submitting
        </label>
        <br>
        <input type="submit" value="Submit">
    </form>

</body>
</html>
