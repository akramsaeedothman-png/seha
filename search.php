<?php
require_once "../config.php"; // ملف الاتصال

$resultData = null;
$error = "";
$notFound = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $service_code = $_POST['service_code'] ?? '';
    $national_id  = $_POST['national_id'] ?? '';

    if (empty($service_code) || empty($national_id)) {
        $error = "يرجى إدخال رمز الخدمة ورقم الهوية";
    } else {

        $stmt = $conn->prepare("
            SELECT * FROM sick_leaves
            WHERE service_code = ? AND national_id = ?
        ");
        $stmt->bind_param("ss", $service_code, $national_id);
        $stmt->execute();
        $query = $stmt->get_result();

        if ($query->num_rows > 0) {
            $resultData = $query->fetch_assoc();
        } else {
            $notFound = "لا توجد إجازة مطابقة للبيانات المدخلة.";
        }

        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>نتيجة البحث عن الإجازة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h2 class="text-center mb-4">التحقق من الإجازة المرضية</h2>

    <!-- نموذج البحث -->
    <form method="POST" class="card p-4 shadow-sm mb-4">
        <?php if ($error): ?>
            <div class="alert alert-danger text-center"><?= $error ?></div>
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label fw-bold">رمز الخدمة</label>
            <input type="text" name="service_code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">رقم الهوية</label>
            <input type="text" name="national_id" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">بحث</button>
    </form>

    <!-- عرض النتائج -->
    <?php if ($notFound): ?>
        <div class="alert alert-warning text-center"><?= $notFound ?></div>
    <?php endif; ?>

    <?php if ($resultData): ?>
        <div class="card p-4 shadow">
            <h4 class="text-primary mb-3">بيانات الإجازة</h4>

            <p><strong>رمز الخدمة:</strong> <?= $resultData["service_code"] ?></p>
            <p><strong>رقم الهوية:</strong> <?= $resultData["national_id"] ?></p>
            <p><strong>الاسم الرباعي:</strong> <?= $resultData["patient_full_name"] ?></p>
            <p><strong>تاريخ الإنشاء:</strong> <?= $resultData["creation_date"] ?></p>
            <p><strong>اسم الطبيب:</strong> <?= $resultData["doctor_name"] ?></p>
            <p><strong>المسمى الوظيفي:</strong> <?= $resultData["job_title"] ?></p>
            <p><strong>من تاريخ:</strong> <?= $resultData["start_date"] ?></p>
            <p><strong>إلى تاريخ:</strong> <?= $resultData["end_date"] ?></p>
            <p><strong>المدة بالأيام:</strong> <?= $resultData["duration_days"] ?></p>
            <p><strong>تاريخ الحفظ:</strong> <?= $resultData["created_at"] ?></p>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
