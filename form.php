<?php
// استيراد مكتبة PHPMailer والملفات اللازمة يدوياً
require_once dirname(__FILE__) . '/PHPMailer-master/src/Exception.php';
require_once dirname(__FILE__) . '/PHPMailer-master/src/PHPMailer.php';
require_once dirname(__FILE__) . '/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$errors = [];  // مصفوفة لتجميع الأخطاء

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // جلب البيانات من الفورم
    $fullName = htmlspecialchars(trim($_POST['fullName']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // التحقق من المدخلات
    if (empty($fullName)) {
        $errors[] = "Full Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($subject)) {
        $errors[] = "Subject is required.";
    }

    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    // إذا لم تكن هناك أخطاء، يتم إرسال البريد
    if (empty($errors)) {
        // إعدادات SMTP
        $mail = new PHPMailer(true);

        try {
            // إعدادات الخادم
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = '99goals.ceo@gmail.com';
            $mail->Password   = 'cfrw vhry dyot qbjv';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // إعدادات المرسل والمستقبل
            $mail->setFrom($email, $fullName);
            $mail->addAddress('99goals.ceo@gmail.com');

            // محتوى البريد
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = "<h1>Message from: $fullName</h1>
                              <p>Email: $email</p>
                              <p>Phone: $phone</p>
                              <p>Subject: $subject</p>
                              <p>Message:</p><p>$message</p>";
            $mail->AltBody = "Name: $fullName\nEmail: $email\nPhone: $phone\nSubject: $subject\nMessage: $message";

            $mail->send();

            // طباعة كود JavaScript للتنبيه بنجاح الإرسال
            echo "<script>alert('Message sent successfully!'); window.location.href = 'index.html';</script>";
            exit;

        } catch (Exception $e) {
            echo "<script>alert('Error: {$mail->ErrorInfo}');</script>";
        }
    } else {
        // عرض الأخطاء إذا وجدت
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
} else {
    echo "Invalid request.";
}
?>
