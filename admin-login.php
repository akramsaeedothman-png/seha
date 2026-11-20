<?php
require_once '../config.php'; 
session_start();

// عند إرسال النموذج
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // جلب البيانات من الفورم
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // تجهيز الاستعلام
    $stmt = $conn->prepare("SELECT full_name, password FROM users WHERE full_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // إذا وجد المستخدم
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // تحقق كلمة المرور (إذا كانت مشفرة استخدم password_verify)
        if (password_verify($password, $user['password'])) {

            // حفظ بيانات الجلسة
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];

            // توجيه لصفحة أخرى
            header("Location: add-leave.php");
            exit();

        } else {
            $login_error = "كلمة المرور غير صحيحة!";
        }
    } else {
        $login_error = "اسم المستخدم غير موجود!";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - لوحة الإدارة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .login-wrapper { min-height: 100vh; background-color: #f0f3f7; }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center login-wrapper">
        <div class="login-container card p-4 p-md-5 shadow-lg" style="max-width: 400px; width: 100%;">
            
            <div class="logo-login text-center mb-4">
                <span class="logo-text fs-3 fw-bold">صحة</span>
                <span class="logo-seha fs-4 me-1">Seha</span>
                <span class="logo-check text-secondary fs-2">✓</span>
            </div>
            <h2 class="text-center text-primary mb-4 fw-bold">تسجيل الدخول الإداري</h2>

           <form id="loginForm" class="query-form" method="POST" action="">

                <?php if (!empty($login_error)): ?>
    <p class="text-danger text-center"><?php echo $login_error; ?></p>
<?php endif; ?>

                <div class="mb-3">
                    <label for="username" class="form-label fw-bold">اسم المستخدم (Admin)</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="أدخل اسم المستخدم" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">كلمة المرور</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="أدخل كلمة المرور" required>
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary w-100 btn-lg mt-3 fw-bold">تسجيل الدخول</button>
                <p id="error-message" class="error-message text-danger mt-3 text-center hidden"></p>
                <a href="index.php" class="d-block text-center mt-3 text-secondary text-decoration-none">العودة لصفحة الاستعلام</a>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="script.js"></script> -->
</body>
</html>