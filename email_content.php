<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="mail-list">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <input type="submit" name="back" value="<<">
        </form>
        <?php
        if (isset($_POST['back'])) {
            header("location:email.php?page=email");
        }
        include 'config.php';
        $token_id = isset($_GET['token']) ? $_GET['token'] : "";
        $mail_no = isset($_GET['mailno']) ? $_GET['mailno'] : "";
        $select_query = "select * from mail_list where mail_no ='{$mail_no}' and token_id='{$token_id}'";
        $mark_as_read = "update mail_list set inbox_status=\"read\" where mail_no='{$mail_no}' and token_id='{$token_id}'";
        $select_query_output = $conn->query($select_query);
        $conn->query($mark_as_read);
        $result = $select_query_output->fetch_assoc();
        ?>
        <input type="text" name="sender_email" id="sender_email" value="<?= $result['sender_email'] ?>" readonly>
        <input type="text" name="reciever_email" id="reciever_email" value="<?= $result['reciever_email'] ?>" readonly>
        <input type="text" name="subject" id="subject" value="<?= $result['subject'] ?>" readonly>
        <?php
        if (empty($result['cc']) && empty($result['bcc'])) {
        } else {
        ?>
            <input type="text" name="cc" id="cc" value="<?= $result['cc'] ?>" readonly>
            <input type="text" name="bcc" id="bcc" value="<?= $result['bcc'] ?>" readonly>
        <?php
        }
        ?>
        <textarea name="mail_body" readonly><?= $result['notes'] ?></textarea>
    </div>

    <!-- echo "FROM: " . $result['sender_email'] . "<br>";
    echo "TO: " . $result['reciever_email'] . "<br>";
    echo "SUBJECT: " . $result['subject'] . "<br>";
    echo "BODY: " . $result['notes'] . "<br>";
    ?> -->
</body>

</html>