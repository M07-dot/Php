<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
</head>
<body>
    <h1>مرحبًا، <?php echo $user['Username']; ?>!</h1>
    <p>هذه لوحة التحكم الخاصة بك.</p>
    <a href="logout.php">تسجيل الخروج</a>
</body>
</html>