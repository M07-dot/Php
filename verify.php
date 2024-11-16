<?php
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // فتح ملف CSV والتأكد من البريد الإلكتروني
    $file = fopen('users.csv', 'r');
    $tempFile = fopen('temp.csv', 'w');
    $verified = false;

    while (($data = fgetcsv($file)) !== FALSE) {
        list($id, $username, $userEmail, $password, $phone) = $data;
        if ($email === $userEmail) {
            $verified = true;
            // إضافة علامة التحقق بجانب البريد
            fputcsv($tempFile, [$id, $username, $userEmail . ' (verified)', $password, $phone]);
        } else {
            fputcsv($tempFile, $data);
        }
    }
    fclose($file);
    fclose($tempFile);

    // استبدال الملف القديم بالجديد
    rename('temp.csv', 'users.csv');

    if ($verified) {
        echo "تم التحقق من بريدك الإلكتروني بنجاح! يمكنك الآن تسجيل الدخول.";
    } else {
        echo "بريد إلكتروني غير مسجل.";
    }
} else {
    echo "طلب غير صالح.";
}
?>
