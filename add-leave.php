<?php 
require_once '../config.php'; // الاتصال

// إذا تم إرسال الفورم
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // استقبال البيانات
    $service_code      = $_POST['service_code']      ?? '';
    $national_id       = $_POST['national_id']       ?? '';
    $patient_full_name = $_POST['patient_full_name'] ?? '';
    $creation_date     = $_POST['creation_date']     ?? '';
    $doctor_name       = $_POST['doctor_name']       ?? '';
    $job_title         = $_POST['job_title']         ?? '';
    $start_date        = $_POST['start_date']        ?? '';
    $end_date          = $_POST['end_date']          ?? '';
    $duration_days     = $_POST['duration_days']     ?? '';

    // التحقق من الحقول
    if (
        empty($service_code) || empty($national_id) || empty($patient_full_name) ||
        empty($creation_date) || empty($doctor_name) || empty($job_title) ||
        empty($start_date) || empty($end_date) || empty($duration_days)
    ) {
        $message = "<div class='alert alert-danger text-center'>يرجى تعبئة جميع الحقول</div>";
    } else {

        // تجهيز الاستعلام
        $stmt = $conn->prepare("INSERT INTO sick_leaves 
        (service_code, national_id, patient_full_name, creation_date, doctor_name, job_title, start_date, end_date, duration_days) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "ssssssssi",
            $service_code,
            $national_id,
            $patient_full_name,
            $creation_date,
            $doctor_name,
            $job_title,
            $start_date,
            $end_date,
            $duration_days
        );

        // تنفيذ
        if ($stmt->execute()) {
            $message = "<div class='alert alert-success text-center'>تم إنشاء الإجازة بنجاح</div>";
        } else {
            $message = "<div class='alert alert-danger text-center'>حدث خطأ أثناء الحفظ</div>";
        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000000">
    <meta name="description"
        content="منصة صحة هي منصة إلكترونية تخدم القطاع الصحي في المملكة من خلال تقديم خدمات إلكترونية معتمدة من قبل وزارة الصحة.">
    <title>صحة - إنشاء إجازة</title>
    <link rel="icon" href="https://sehtna.cloud/assets/favicon.png">
    <link rel="icon" href="/favicon.png">
    <link rel="apple-touch-icon" href="https://sehtna.cloud/assets/logo.png">
    <link href="https://sehtna.cloud/assets/css/main.d8269fcd.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Cairo Font Definitions */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscQyyS4J0.woff2) format('woff2');
            unicode-range: U+0600-06FF, U+0750-077F, U+0870-088E, U+0890-0891, U+0897-08E1, U+08E3-08FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE70-FE74, U+FE76-FEFC, U+102E0-102FB, U+10E60-10E7E, U+10EC2-10EC4, U+10EFC-10EFF, U+1EE00-1EE03, U+1EE05-1EE1F, U+1EE21-1EE22, U+1EE24, U+1EE27, U+1EE29-1EE32, U+1EE34-1EE37, U+1EE39, U+1EE3B, U+1EE42, U+1EE47, U+1EE49, U+1EE4B, U+1EE4D-1EE4F, U+1EE51-1EE52, U+1EE54, U+1EE57, U+1EE59, U+1EE5B, U+1EE5D, U+1EE5F, U+1EE61-1EE62, U+1EE64, U+1EE67-1EE6A, U+1EE6C-1EE72, U+1EE74-1EE77, U+1EE79-1EE7C, U+1EE7E, U+1EE80-1EE89, U+1EE8B-1EE9B, U+1EEA1-1EEA3, U+1EEA5-1EEA9, U+1EEAB-1EEBB, U+1EEF0-1EEF1;
        }

        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscSCyS4J0.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscRiyS.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 900;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscQyyS4J0.woff2) format('woff2');
            unicode-range: U+0600-06FF, U+0750-077F, U+0870-088E, U+0890-0891, U+0897-08E1, U+08E3-08FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE70-FE74, U+FE76-FEFC, U+102E0-102FB, U+10E60-10E7E, U+10EC2-10EC4, U+10EFC-10EFF, U+1EE00-1EE03, U+1EE05-1EE1F, U+1EE21-1EE22, U+1EE24, U+1EE27, U+1EE29-1EE32, U+1EE34-1EE37, U+1EE39, U+1EE3B, U+1EE42, U+1EE47, U+1EE49, U+1EE4B, U+1EE4D-1EE4F, U+1EE51-1EE52, U+1EE54, U+1EE57, U+1EE59, U+1EE5B, U+1EE5D, U+1EE5F, U+1EE61-1EE62, U+1EE64, U+1EE67-1EE6A, U+1EE6C-1EE72, U+1EE74-1EE77, U+1EE79-1EE7C, U+1EE7E, U+1EE80-1EE89, U+1EE8B-1EE9B, U+1EEA1-1EEA3, U+1EEA5-1EEA9, U+1EEAB-1EEBB, U+1EEF0-1EEF1;
        }

        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 900;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscSCyS4J0.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 900;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscRiyS.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        html,
        body,
        * {
            font-family: 'Cairo', 'Tahoma', 'Arial', sans-serif !important;
        }
    </style>
</head>

<body>
    <noscript>You need to enable JavaScript to run this app.</noscript>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="https://sehtna.cloud/assets/static/media/seha_logo.4dde29e5c4f38890ccf9787220bcc5be.svg"
                alt="logo" class="logo" style="height: 40px;">
            <button class="sidebar-close" id="sidebarClose">×</button>
        </div>
        <nav class="sidebar-nav">
            <a href="index.html">الرئيسية</a>
            <a href="#/services">الخدمات</a>
            <a href="#/inquiries">الاستعلامات</a>
            <a href="#/faq">الأسئلة الشائعة</a>
            <a href="#/ContactUs">تواصل معنا</a>
            <a href="#/iamredirection/1">إنشاء حساب</a>
        </nav>
        <div class="sidebar-login">
            <button class="sidebar-login-btn" onclick="window.location.href='admin-login.html'">
                <img src="https://sehtna.cloud/assets/static/media/user_o.7825677e64284b06f60f7c30082fed56.svg"
                    alt="user">
                تسجيل الدخول
            </button>
        </div>
        <div class="sidebar-footer">
            <img src="https://sehtna.cloud/assets/static/media/seha_logo.4dde29e5c4f38890ccf9787220bcc5be.svg"
                alt="logo" class="logo">
        </div>
    </div>

    <div id="root">
        <div class="App">
            <main>
                <div>
                    <nav class="header navbar navbar-expand-lg navbar-light">
                        <div class="nav-container">
                            <a class="navbar-brand" href="index.html"><img
                                    src="https://sehtna.cloud/assets/static/media/seha_logo.4dde29e5c4f38890ccf9787220bcc5be.svg"
                                    alt="logo" class="logo"></a>
                            <button class="sidebar-toggle" id="sidebarToggle">☰</button>
                            <div class="white justify-content-between navbar-collapse collapse"
                                id="responsive-navbar-nav">
                                <div class="justify-content-between navbar-nav">
                                    <a data-rr-ui-event-key="1" class="link nav-link" href="index.php">الرئيسية</a>
                                    <a class="link nav-link" href="#/services">الخدمات</a>
                                    <a class="link nav-link" href="#/inquiries">الاستعلامات</a>
                                    <a data-rr-ui-event-key="4" class="link nav-link" href="#/faq">الأسئلة الشائعة</a>
                                    <a data-rr-ui-event-key="5" class="link nav-link" href="#/ContactUs">تواصل معنا</a>
                                </div>
                                <div class="justify-content-between navbar-nav">
                                    <a class="nav-link" href="#/iamredirection/1">إنشاء حساب</a>
                                    <a class="login nav-link" href="admin-login.php">
                                        <img src="https://sehtna.cloud/assets/static/media/user_o.7825677e64284b06f60f7c30082fed56.svg"
                                            alt="logo">
                                        <p>تسجيل الدخول</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="inner-page inquiries-container">
                    <h1 class="heading">إنشاء إجازة</h1>
                    <p class="sub-heading">أدخل بيانات الإجازة المرضية الجديدة</p>
                    <div class="row justify-content-center mt-1">
                        <div class="col-md-8 p-2">
                          <form method="post" class="p-4 rounded shadow mb-4 bg-white">

    <?php if (!empty($message)) echo $message; ?>
<div class="row mb-3">
    <div class="col-md-6 mb-3 mb-md-0">
        <label class="form-label fw-bold">رمز الخدمة</label>
        <input type="text" name="service_code" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">رقم الهوية / الإقامة</label>
        <input type="text" name="national_id" class="form-control" required>
    </div>
</div>

<div class="mb-3">
    <label class="form-label fw-bold">الاسم الرباعي</label>
    <input type="text" name="patient_full_name" class="form-control" required>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">تاريخ الإنشاء</label>
        <input type="date" name="creation_date" class="form-control">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">اسم الطبيب</label>
        <input type="text" name="doctor_name" class="form-control" required>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">المسمى الوظيفي</label>
        <input type="text" name="job_title" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">من تاريخ</label>
        <input type="date" name="start_date" class="form-control" required>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">إلى تاريخ</label>
        <input type="date" name="end_date" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">المدة بالأيام</label>
        <input type="number" name="duration_days" class="form-control" required>
    </div>
</div>

<button type="submit" class="btn btn-primary w-100 fw-bold">إنشاء الإجازة</button>

<br><br>

<button type="button" id="logoutButton" class="btn btn-secondary w-100 fw-bold">
    تسجيل خروج
</button>

<script>
    document.getElementById("logoutButton").addEventListener("click", function() {
        window.location.href = "index.php"; 
    });
</script>


                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script> -->
    <script>
//         $("#createLeaveForm").submit(function (e) {
//     e.preventDefault();

//     $.ajax({
//         url: "save_leave.php",
//         type: "POST",
//         data: {
//             service_code: $("#newServiceCode").val(),
//             national_id: $("#newNationalId").val(),
//             patient_full_name: $("#patientFullName").val(),
//             creation_date: $("#creationDate").val(),
//             doctor_name: $("#doctorName").val(),
//             job_title: $("#jobTitle").val(),
//             start_date: $("#startDate").val(),
//             end_date: $("#endDate").val(),
//             duration_days: $("#durationDays").val()
//         },
//         success: function (res) {
//             const result = JSON.parse(res);

//             if (result.status === "success") {
//                 alert("تم حفظ الإجازة بنجاح!");
//                 $("#createLeaveForm")[0].reset();
//             } else {
//                 alert(result.message);
//             }
//         }
//     });
// });

        // دوال مساعدة لصفحة الإضافة
    //     function calculateDays() {
    //         const start = document.getElementById('startDate').value;
    //         const end = document.getElementById('endDate').value;
    //         if (start && end) {
    //             const date1 = new Date(start);
    //             const date2 = new Date(end);
    //             const diffTime = Math.abs(date2 - date1);
    //             const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
    //             document.getElementById('durationDays').value = diffDays > 0 ? diffDays : 0;
    //         } else {
    //             document.getElementById('durationDays').value = 0;
    //         }
    //     }
    //     function formatDate(date) {
    //         return `${String(date.getDate()).padStart(2, '0')}-${String(date.getMonth() + 1).padStart(2, '0')}-${date.getFullYear()}`;
    //     }
    //     document.getElementById('creationDate').value = formatDate(new Date());

    //     document.getElementById('logoutButton').addEventListener('click', () => {
    //         localStorage.removeItem('adminToken');
    //         localStorage.removeItem('adminName');
    //         window.location.href = 'index.html';
    //     });

    //     const adminName = localStorage.getItem('adminName');
    //     if (!adminName) {
    //         //  window.location.href = 'admin-login.html';
    //     }

    //     // Sidebar functionality
    //     $('#sidebarToggle').click(function () {
    //         $('#sidebar').addClass('open');
    //         $('#sidebarOverlay').addClass('open');
    //         $(this).text('×');
    //     });

    //     $('#sidebarClose, #sidebarOverlay').click(function () {
    //         $('#sidebar').removeClass('open');
    //         $('#sidebarOverlay').removeClass('open');
    //         $('#sidebarToggle').text('☰');
    //     });

    //     $('.sidebar-nav a').click(function () {
    //         $('#sidebar').removeClass('open');
    //         $('#sidebarOverlay').removeClass('open');
    //         $('#sidebarToggle').text('☰');
    //     });

    //     $(document).keydown(function (e) {
    //         if (e.keyCode === 27) {
    //             $('#sidebar').removeClass('open');
    //             $('#sidebarOverlay').removeClass('open');
    //             $('#sidebarToggle').text('☰');
    //         }
    //     });
    // </script>
</body>

</html>