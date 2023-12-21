<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data" target="upload_iframe">
        <label for="file">Select Image:</label>
        <input type="file" name="file" id="file" accept="image/*">
        <button type="submit" name="submit">Upload</button>
    </form>
    <!-- This iframe is used to handle the file upload without refreshing the main page -->
    <iframe name="upload_iframe" style="display:none;"></iframe>
    <?php
    // Check if the form was submitted and if there is an uploaded file
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($GLOBALS['uploadedFilePath'])) {
        // Display the uploaded image
        echo '<img src="' . $GLOBALS['uploadedFilePath'] . '" alt="Uploaded Image">';
    }
    ?>
</body>
</html>
<?php
// This script should only handle file uploads, not display HTML content.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        $targetDir = "Uploads/";
        $originalFileName = basename($_FILES["file"]["name"]);
        $newFileName = uniqid() . "_" . $originalFileName;
        $targetPath = $targetDir . $newFileName;
        // Move the uploaded file to the target directory
        move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath);
        // Store the file path in a global variable
        $GLOBALS['uploadedFilePath'] = $targetPath;
        // Redirect back to the main page
        header("Location: index.php");
        exit();
    } else {
        echo "Error uploading file. Error code: " . $_FILES["file"]["error"];
    }
}
?>