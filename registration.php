<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // التحقق من صحة البيانات
    if (empty($username) || empty($email) || empty($password) || empty($phone)) {
        $error = "جميع الحقول مطلوبة!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "بريد إلكتروني غير صالح!";
    } else {
        // حفظ البيانات في ملف users.csv
        $file = fopen('users.csv', 'a');
        $id = uniqid(); // إنشاء ID فريد لكل مستخدم
        fputcsv($file, [$id, $username, $email, $password, $phone]);
        fclose($file);

        // إرسال رابط التحقق
        $verificationLink = "http://yourwebsite.com/verify.php?email=" . urlencode($email);
        mail($email, "تأكيد بريدك الإلكتروني", "اضغط على الرابط التالي لتفعيل حسابك: $verificationLink");

        $success = "تم التسجيل بنجاح! تحقق من بريدك الإلكتروني لتفعيل الحساب.";
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التسجيل</title>
</head>
<body>
    <h1>تسجيل حساب جديد</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php elseif (isset($success)): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>اسم المستخدم:</label><br>
        <input type="text" name="username" required><br>
        <label>البريد الإلكتروني:</label><br>
        <input type="email" name="email" required><br>
        <label>كلمة المرور:</label><br>
        <input type="password" name="password" required><br>
        <label>رقم الهاتف:</label><br>
        <input type="text" name="phone" required><br>
        <button type="submit">تسجيل</button>
    </form>
</body>
</html>
