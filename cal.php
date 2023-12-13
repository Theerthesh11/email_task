<html>
<head>   
<link href="calender.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php
include 'calender.php';
 
$calendar = new Calendar();
 
echo $calendar->show();
?>
</body>
</html>  