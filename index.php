<?php
session_start();

function loginUser($email, $password) {
    $file = fopen('users.csv', 'r');
    while (($data = fgetcsv($file)) !== FALSE) {
        list($id, $username, $userEmail, $userPassword, $phone) = $data;
        if ($email === $userEmail && $password === $userPassword) {
            return ['ID' => $id, 'Username' => $username, 'Email' => $userEmail];
        }
    }
    fclose($file);
    return null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = loginUser($email, $password);
    if ($user) {
        if (strpos($user['Email'], '(verified)') === false) {
            $error = "يجب تفعيل بريدك الإلكتروني أولاً!";
        } else {
            $_SESSION['user'] = $user;
            header("Location: dashboard.php");
            exit;
        }
    } else {
        $error = "خطأ في البريد الإلكتروني أو كلمة المرور!";
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
</head>
<body>
    <h1>تسجيل الدخول</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>البريد الإلكتروني:</label><br>
        <input type="email" name="email" required><br>
        <label>كلمة المرور:</label><br>
        <input type="password" name="password" required><br>
        <button type="submit">تسجيل الدخول</button>
    </form>
    <p>ليس لديك حساب؟ <a href="registration.php">قم بإنشاء حساب جديد</a></p>
</body>
</html>
