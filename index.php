<?php
require_once "../config.php"; // ملف الاتصال

// $resultData = null;
// $error = "";
// $notFound = "";

if (isset($_POST['submit'])) {

    $service_code = $_POST['service_code'];
    $national_id  = $_POST['national_id'];

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
} else {

    $service_code = "";
    $national_id  = "";
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000000">
    <meta name="description" content="منصة صحة هي منصة إلكترونية تخدم القطاع الصحي في المملكة من خلال تقديم خدمات إلكترونية معتمدة من قبل وزارة الصحة.">
    <title>صحة - منصة الخدمات الصحية</title>
    <link rel="icon" href="https://sehtna.cloud/assets/favicon.png">
    <link rel="icon" href="/favicon.png">
    <link rel="apple-touch-icon" href="https://sehtna.cloud/assets/logo.png">
    <link href="https://sehtna.cloud/assets/css/main.d8269fcd.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">

    <!-- Force Cairo Font Override - Local Fonts -->
    <style>
        /* Define Cairo font faces from local files */
        @font-face {
            font-family: 'Cairo';
            src: url('/cairo-2/Cairo-Regular.ttf') format('truetype');
            font-weight: 400;
            font-display: swap;
        }

        @font-face {
            font-family: 'Cairo';
            src: url('/cairo-2/Cairo-Light.ttf') format('truetype');
            font-weight: 300;
            font-display: swap;
        }

        @font-face {
            font-family: 'Cairo';
            src: url('/cairo-2/Cairo-ExtraLight.ttf') format('truetype');
            font-weight: 200;
            font-display: swap;
        }

        @font-face {
            font-family: 'Cairo';
            src: url('/cairo-2/Cairo-SemiBold.ttf') format('truetype');
            font-weight: 600;
            font-display: swap;
        }

        @font-face {
            font-family: 'Cairo';
            src: url('/cairo-2/Cairo-Bold.ttf') format('truetype');
            font-weight: 700;
            font-display: swap;
        }

        @font-face {
            font-family: 'Cairo';
            src: url('/cairo-2/Cairo-Black.ttf') format('truetype');
            font-weight: 900;
            font-display: swap;
        }

        /* Override all font-family declarations */
        * {
            font-family: 'Cairo', 'Tahoma', 'Arial', sans-serif !important;
        }

        /* Force Cairo font on all elements */
        html,
        body {
            font-family: 'Cairo', 'Tahoma', 'Arial', sans-serif !important;
        }

        /* Override any existing styles */
        [style*="font-family"] {
            font-family: 'Cairo', 'Tahoma', 'Arial', sans-serif !important;
        }

        /* Specific overrides for common elements */
        body,
        html,
        div,
        span,
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        a,
        button,
        input,
        textarea,
        select,
        nav,
        footer,
        header,
        .nav-link,
        .btn,
        .navbar,
        .container,
        .footer,
        .sidebar-nav {
            font-family: 'Cairo', 'Tahoma', 'Arial', sans-serif !important;
        }

        /* Override any existing font-family styles */
        [style*="font-family"] {
            font-family: 'Cairo', 'Tahoma', 'Arial', sans-serif !important;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Cairo Font Definitions */
        /* arabic */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscQyyS4J0.woff2) format('woff2');
            unicode-range: U+0600-06FF, U+0750-077F, U+0870-088E, U+0890-0891, U+0897-08E1, U+08E3-08FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE70-FE74, U+FE76-FEFC, U+102E0-102FB, U+10E60-10E7E, U+10EC2-10EC4, U+10EFC-10EFF, U+1EE00-1EE03, U+1EE05-1EE1F, U+1EE21-1EE22, U+1EE24, U+1EE27, U+1EE29-1EE32, U+1EE34-1EE37, U+1EE39, U+1EE3B, U+1EE42, U+1EE47, U+1EE49, U+1EE4B, U+1EE4D-1EE4F, U+1EE51-1EE52, U+1EE54, U+1EE57, U+1EE59, U+1EE5B, U+1EE5D, U+1EE5F, U+1EE61-1EE62, U+1EE64, U+1EE67-1EE6A, U+1EE6C-1EE72, U+1EE74-1EE77, U+1EE79-1EE7C, U+1EE7E, U+1EE80-1EE89, U+1EE8B-1EE9B, U+1EEA1-1EEA3, U+1EEA5-1EEA9, U+1EEAB-1EEBB, U+1EEF0-1EEF1;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscSCyS4J0.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscRiyS.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* arabic */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscQyyS4J0.woff2) format('woff2');
            unicode-range: U+0600-06FF, U+0750-077F, U+0870-088E, U+0890-0891, U+0897-08E1, U+08E3-08FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE70-FE74, U+FE76-FEFC, U+102E0-102FB, U+10E60-10E7E, U+10EC2-10EC4, U+10EFC-10EFF, U+1EE00-1EE03, U+1EE05-1EE1F, U+1EE21-1EE22, U+1EE24, U+1EE27, U+1EE29-1EE32, U+1EE34-1EE37, U+1EE39, U+1EE3B, U+1EE42, U+1EE47, U+1EE49, U+1EE4B, U+1EE4D-1EE4F, U+1EE51-1EE52, U+1EE54, U+1EE57, U+1EE59, U+1EE5B, U+1EE5D, U+1EE5F, U+1EE61-1EE62, U+1EE64, U+1EE67-1EE6A, U+1EE6C-1EE72, U+1EE74-1EE77, U+1EE79-1EE7C, U+1EE7E, U+1EE80-1EE89, U+1EE8B-1EE9B, U+1EEA1-1EEA3, U+1EEA5-1EEA9, U+1EEAB-1EEBB, U+1EEF0-1EEF1;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscSCyS4J0.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscRiyS.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* arabic */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscQyyS4J0.woff2) format('woff2');
            unicode-range: U+0600-06FF, U+0750-077F, U+0870-088E, U+0890-0891, U+0897-08E1, U+08E3-08FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE70-FE74, U+FE76-FEFC, U+102E0-102FB, U+10E60-10E7E, U+10EC2-10EC4, U+10EFC-10EFF, U+1EE00-1EE03, U+1EE05-1EE1F, U+1EE21-1EE22, U+1EE24, U+1EE27, U+1EE29-1EE32, U+1EE34-1EE37, U+1EE39, U+1EE3B, U+1EE42, U+1EE47, U+1EE49, U+1EE4B, U+1EE4D-1EE4F, U+1EE51-1EE52, U+1EE54, U+1EE57, U+1EE59, U+1EE5B, U+1EE5D, U+1EE5F, U+1EE61-1EE62, U+1EE64, U+1EE67-1EE6A, U+1EE6C-1EE72, U+1EE74-1EE77, U+1EE79-1EE7C, U+1EE7E, U+1EE80-1EE89, U+1EE8B-1EE9B, U+1EEA1-1EEA3, U+1EEA5-1EEA9, U+1EEAB-1EEBB, U+1EEF0-1EEF1;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscSCyS4J0.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscRiyS.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* arabic */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 900;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscQyyS4J0.woff2) format('woff2');
            unicode-range: U+0600-06FF, U+0750-077F, U+0870-088E, U+0890-0891, U+0897-08E1, U+08E3-08FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE70-FE74, U+FE76-FEFC, U+102E0-102FB, U+10E60-10E7E, U+10EC2-10EC4, U+10EFC-10EFF, U+1EE00-1EE03, U+1EE05-1EE1F, U+1EE21-1EE22, U+1EE24, U+1EE27, U+1EE29-1EE32, U+1EE34-1EE37, U+1EE39, U+1EE3B, U+1EE42, U+1EE47, U+1EE49, U+1EE4B, U+1EE4D-1EE4F, U+1EE51-1EE52, U+1EE54, U+1EE57, U+1EE59, U+1EE5B, U+1EE5D, U+1EE5F, U+1EE61-1EE62, U+1EE64, U+1EE67-1EE6A, U+1EE6C-1EE72, U+1EE74-1EE77, U+1EE79-1EE7C, U+1EE7E, U+1EE80-1EE89, U+1EE8B-1EE9B, U+1EEA1-1EEA3, U+1EEA5-1EEA9, U+1EEAB-1EEBB, U+1EEF0-1EEF1;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 900;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscSCyS4J0.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 900;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/cairo/v31/SLXVc1nY6HkvangtZmpQdkhzfH5lkSscRiyS.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* Apply Cairo font to all text - Force override */
        html,
        body,
        * {
            font-family: 'Cairo', 'Tahoma', 'Arial', sans-serif !important;
        }

        /* Specific overrides for all elements */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        div,
        a,
        li,
        ul,
        nav,
        footer,
        header,
        .nav-link,
        .footer .nav-link,
        .sidebar-nav a,
        .navbar,
        .container,
        .btn,
        .text,
        .title,
        .subtitle,
        .content,
        .menu,
        .links-wrapepr,
        .footer-container,
        .footer,
        .sidebar-nav {
            font-family: 'Cairo', 'Tahoma', 'Arial', sans-serif !important;
        }

        /* Force font on Arabic text */
        [lang="ar"],
        [dir="rtl"] {
            font-family: 'Cairo', 'Tahoma', 'Arial', sans-serif !important;
        }

        /* Remove shadow and effects from header */
        .header,
        .navbar,
        .header .white,
        .navbar .white {
            box-shadow: none !important;
            text-shadow: none !important;
            filter: none !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
        }


        /* Sidebar Styles */
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: #7eb7db;
            cursor: pointer;
            padding: 10px;
            margin-right: 15px;
        }

        .sidebar {
            position: fixed;
            top: 3px;
            left: 0;
            right: 0;
            width: 100%;
            background-color: #f8f9fb;
            z-index: 1001;
            box-shadow: #63636333 0 2px 8px;
            padding: 0px 0;
            font-weight: 700;
            display: none;
        }

        .sidebar.open {
            display: block;
        }

        .sidebar-header {
            display: flex !important;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            position: relative;
        }

        .sidebar-footer {
            display: none;
        }

        .sidebar-close {
            background: none;
            border: none;
            font-size: 24px;
            color: #306db5;
            cursor: pointer;
            padding: 5px;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-nav {
            flex: 1;
            padding: 0;
        }

        .sidebar-nav a {
            display: block;
            padding: 15px 20px;
            color: #306db5;
            text-decoration: none;
            font-weight: 400;
            font-size: 16px;
            margin: 0 20px;
            text-align: center;
            position: relative;
        }

        .sidebar-nav a::after {
            content: '';
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 1px;
            background-color: rgba(126, 183, 219, 0.3);
        }

        .sidebar-nav a:hover {
            background-color: rgba(126, 183, 219, 0.1);
        }

        .sidebar-nav a.active {
            background-color: transparent;
            color: #306db5;
            font-weight: 400;
        }

        .sidebar-nav a.active::after {
            width: 80px;
            height: 2px;
            background-color: #7eb7db;
        }

        .sidebar-login {
            padding: 20px 25px;
            background-color: transparent;
        }

        .sidebar-login-btn {
            width: 100%;
            background-color: #306db5;
            color: #fff;
            border: none;
            padding: 15px 20px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 16px;
            transition: background-color 0.3s;
            border-radius: 8px;
            text-align: center;
        }

        .sidebar-login-btn:hover {
            background-color: #2563b5;
        }

        .sidebar-login-btn img {
            width: 18px;
            height: 18px;
        }

        .sidebar-footer {
            padding: 20px 25px;
            background-color: transparent;
            color: white;
            text-align: center;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 10;
        }

        .sidebar-footer .logo {
            height: 30px;
            margin-bottom: 10px;
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .sidebar-overlay.open {
            display: block;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block;
                order: 2;
            }

            .navbar-brand {
                order: 1;
            }

            .navbar-nav {
                display: none !important;
            }

            .nav-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 100%;
            }
        }

        /* تنزيل الإجازات المرضية في الكمبيوتر فقط */
        @media (min-width: 769px) {
            .inquiries-container h1.heading {
                margin-top: 120px !important;
            }
        }

        /* تقليل المسافة البيضاء تحت الأزرار للكمبيوتر */
        @media (min-width: 800px) {
            .inquiries-container .row:last-child {
                margin-bottom: 30px !important;
            }

            .inquiries-container {
                padding-bottom: 30px !important;
            }
        }

        /* جعل الهيدر ثابت أثناء التمرير */
        .header,
        .navbar {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 1000 !important;
            width: 100% !important;
            background: #f8f9fb !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
            padding: 4px 0 !important;
            min-height: 35px !important;
        }

        /* تعديل المحتوى الرئيسي ليتناسب مع الهيدر الثابت */
        .inner-page {
            margin-top: 45px !important;
            padding-top: 20px !important;
        }

        /* تحسين الهيدر للهواتف */
        @media (max-width: 768px) {

            .header,
            .navbar {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                z-index: 1000 !important;
                width: 100% !important;
                background: #f8f9fb !important;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
                padding: 3px 0 !important;
                min-height: 30px !important;
            }

            .inner-page {
                margin-top: 25px !important;
                padding-top: 10px !important;
            }

            /* إنزال المحتوى المخفي في الهواتف */
            .inquiries-container h1.heading {
                margin-top: 64px !important;
            }

            /* تقليل المساحة البيضاء للهواتف - تجاوز CSS الخارجي */
            .inquiries-container {
                display: flex !important;
                flex-direction: column !important;
                margin-top: 5px !important;
                min-height: 20vh !important;
                text-align: center !important;
                padding: 10px !important;
                margin-bottom: 10px !important;
                height: auto !important;
            }

            .inquiries-container .row:last-child {
                margin-bottom: 5px !important;
            }

            .inquiries-container {
                padding-bottom: 5px !important;
            }

            /* تقليل المساحة البيضاء من العناصر */
            .inquiries-container .row {
                margin: 5px 0 !important;
                padding: 0 !important;
            }

            .inquiries-container .col-md-5 {
                margin: 5px 0 !important;
                padding: 10px !important;
            }

            .inquiries-container .col-md-12 {
                margin: 5px 0 !important;
                padding: 5px !important;
            }

            /* تقليل المساحات في العناصر الداخلية */
            .inquiries-container .form-group {
                margin-bottom: 8px !important;
            }

            .inquiries-container .mt-1 {
                margin-top: 5px !important;
            }

            .inquiries-container .mt-2 {
                margin-top: 8px !important;
            }

            .inquiries-container .mb-1 {
                margin-bottom: 5px !important;
            }

            .inquiries-container .mb-3 {
                margin-bottom: 8px !important;
            }

            .inquiries-container .p-2 {
                padding: 8px !important;
            }

            /* تقليل المساحة السفلية للعنوان الفرعي */
            .inquiries-container .sub-heading {
                margin-bottom: 10px !important;
            }

            /* تقريب الزر من الفوتر */
            .footer-container {
                margin-top: -80px !important;
                position: relative !important;
                z-index: 10 !important;
            }
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
            <img src="https://sehtna.cloud/assets/static/media/seha_logo.4dde29e5c4f38890ccf9787220bcc5be.svg" alt="logo" class="logo" style="height: 40px;">
            <button class="sidebar-close" id="sidebarClose">×</button>
        </div>
        <nav class="sidebar-nav">
            <a href="#/" class="active">الرئيسية</a>
            <a href="#/services">الخدمات</a>
            <a href="#/inquiries">الاستعلامات</a>
            <a href="#/faq">الأسئلة الشائعة</a>
            <a href="#/ContactUs">تواصل معنا</a>
            <a href="#/iamredirection/1">إنشاء حساب</a>
        </nav>
        <div class="sidebar-login">
            <button class="sidebar-login-btn" onclick="window.location.href='#/account/login'">
                <img src="https://sehtna.cloud/assets/static/media/user_o.7825677e64284b06f60f7c30082fed56.svg" alt="user">
                تسجيل الدخول
            </button>
        </div>
        <div class="sidebar-footer">
            <img src="https://sehtna.cloud/assets/static/media/seha_logo.4dde29e5c4f38890ccf9787220bcc5be.svg" alt="logo" class="logo">
        </div>
    </div>

    <div id="root">
        <div class="App">
            <main>
                <div>
                    <nav class="header navbar navbar-expand-lg navbar-light">
                        <div class="nav-container">
                            <a class="navbar-brand" href="#/"><img src="https://sehtna.cloud/assets/static/media/seha_logo.4dde29e5c4f38890ccf9787220bcc5be.svg" alt="logo" class="logo"></a>
                            <button class="sidebar-toggle" id="sidebarToggle">☰</button>
                            <div class="white justify-content-between navbar-collapse collapse" id="responsive-navbar-nav">
                                <div class="justify-content-between navbar-nav">
                                    <a data-rr-ui-event-key="1" class="link nav-link active" href="#/" style="
    text-decoration-line: underline;
    text-underline-offset: 6px;
    text-decoration-thickness: 3px;
    text-decoration-color: #7eb7db;
">الرئيسية</a>
                                    <a class="link nav-link" href="#/services">الخدمات</a>
                                    <a class="link nav-link" href="#/inquiries">الاستعلامات</a>
                                    <a data-rr-ui-event-key="4" class="link nav-link" href="#/faq">الأسئلة الشائعة</a>
                                    <a data-rr-ui-event-key="5" class="link nav-link" href="#/ContactUs">تواصل معنا</a>
                                </div>
                                <div class="justify-content-between navbar-nav">
                                    <a class="nav-link" href="#/iamredirection/1">
                                        <p>إنشاء حساب</p>
                                    </a>
                                    <a class="login nav-link" href="admin-login.php">
                                        <img src="https://sehtna.cloud/assets/static/media/user_o.7825677e64284b06f60f7c30082fed56.svg" alt="logo">
                                        <p>تسجيل الدخول</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>

                </div>
                <div class="inner-page inquiries-container">
                    <h1 class="heading">الإجازات المرضية</h1>
                    <p class="sub-heading">خدمة الاستعلام عن الإجازات المرضية تتيح لك الاستعلام عن حالة طلبك للإجازة ويمكنك طباعتها عن طريق تطبيق صحتي</p>
                    <div class="row justify-content-center mt-1">
                        <div class="col-md-5 p-2">
                            <form action="" method="post">

                                <div class="form-group">
                                    <input type="text" id="service_code" maxlength="20" placeholder="رمز الخدمة" name="service_code" class="form-control" value="<?php echo $service_code ?? '0'; ?>">
                                </div>

                                <div class="form-group" style="padding-top: 8px;">
                                    <input type="text" id="identity_number" placeholder="رقم الهوية / الإقامة" name="national_id" class="form-control" value="<?php echo $national_id ?? ''; ?>">
                                </div>

                                <div class="results-inquiery row mt-2" id="results"
                                    style="display: <?= isset($resultData) ? 'block' : 'none'; ?>;">

                                    <?php if (isset($resultData)) { ?>

                                        <span>الاسم:</span>
                                        <p id="name"><?= $resultData['patient_full_name']; ?></p>



                                        <div class="field-group" id="relativeField"
                                            style="display: <?= !empty($resultData['relative_relation']) ? 'block' : 'none'; ?>;">

                                        </div>

                                        <span>تاريخ إصدار تقرير الإجازة:</span>
                                        <p id="report_issue_date"><?= $resultData['creation_date']; ?></p>

                                        <span>تبدأ من:</span>
                                        <p id="start_date"><?= $resultData['start_date']; ?></p>

                                        <span>وحتى:</span>
                                        <p id="end_date"><?= $resultData['end_date']; ?></p>

                                        <span>المدة بالأيام:</span>
                                        <p id="duration"><?= $resultData['duration_days']; ?></p>

                                        <span>اسم الطبيب:</span>
                                        <p id="doctor_name"><?= $resultData['doctor_name']; ?></p>

                                        <span>المسمى الوظيفي:</span>
                                        <p id="job_title"><?= $resultData['job_title']; ?></p>

                                </div>
                                <button type="mybutton" name="reset" class="btn btn-primary my-1" id="return-btn">استعلام جديد</a>
                                <?php } else { ?>
                        </div>


                        <button type="mybutton" name="submit" class="btn btn-primary mt-2">استعلام</button>
                        <div class="col-md-12 text-center mt-3">
                            <button type="mybutton" name="reset" class="btn btn-primary mb-1" id="return-btn">رجوع للاستعلامات</a>
                                <p></p>
                        </div>
                    <?php } ?>

                    </div>
                    </form>
                </div>
        </div>
        </main>
    </div>
    </div>
    <!-- Force Cairo Font - Final Override - Local -->
    <style>
        /* Final font override - highest priority - Local Cairo Font */
        * {
            font-family: 'Cairo', 'Tahoma', 'Arial', sans-serif !important;
        }

        html,
        body {
            font-family: 'Cairo', 'Tahoma', 'Arial', sans-serif !important;
        }

        /* Override any inline styles */
        [style*="font-family"] {
            font-family: 'Cairo', 'Tahoma', 'Arial', sans-serif !important;
        }

        /* Force on all text elements */
        div,
        span,
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        a,
        button,
        input,
        textarea,
        select,
        nav,
        footer,
        header,
        .nav-link,
        .btn,
        .navbar,
        .container,
        .footer,
        .sidebar-nav,
        .links-wrapepr,
        .inquiry-li,
        .heading,
        .about,
        .contact {
            font-family: 'Cairo', 'Tahoma', 'Arial', sans-serif !important;
        }
    </style>

    <div class="footer-container container-fluid">
        <div class="footer">
            <div class="about section"><img src="https://sehtna.cloud/assets/static/media/logo-white-CKxLEirV.svg" alt="Logo">
                <p class="about">منصة صحة تخدم جميع المنشأت الطبية من خلال تقديم الخدمات الصحية إلكترونياً لجميع المنشأت الطبية وتسعى إلى توحيد وأتمتة الاجراءات والخدمات بما في دوره رفع جودة الاداء وخفض التكاليف.</p>
            </div>
            <div class="links section" style="align-items: center;">
                <h3 class="heading">القائمة الرئيسية</h3>
                <ul class="links-wrapepr">
                    <li class="inquiry-li" style="border-bottom: 1px solid rgba(126, 183, 219, 0.6); padding: 8px 0; margin: 0 40px;"><a class="nav-link" href="#/services" style="display: inline-block;">الخدمات</a></li>
                    <li class="inquiry-li" style="border-bottom: 1px solid rgba(126, 183, 219, 0.6); padding: 8px 0; margin: 0 40px;"><a class="nav-link" href="#/inquiries" style="display: inline-block;">الاستعلامات</a></li>
                    <li class="inquiry-li" style="border-bottom: 1px solid rgba(126, 183, 219, 0.6); padding: 8px 0; margin: 0 40px;"><a class="nav-link" href="#/faq" style="display: inline-block;">الأسئلة الشائعة</a></li>
                    <li class="inquiry-li" style="border-bottom: 1px solid rgba(126, 183, 219, 0.6); padding: 8px 0; margin: 0 40px;"><a class="nav-link" href="#/ContactUs" style="display: inline-block;">تواصل معنا</a></li>
                </ul>
            </div>
            <div class="section d-none">
                <h3 class="heading d-none">النشرة البريدية</h3>
                <p class="about d-none">الاشتراك في الرسائل الإخبارية</p>
                <form class="d-none">
                    <div class="input-wrapper"><input placeholder="البريد الالكتروني" type="email" class="form-control"><button class="button-small">إشترك</button></div>
                </form>
            </div>
            <div class="contact section">
                <h3 class="heading">تواصل معنا</h3>
                <div class="contact-wrapper">
                    <div class="values">
                        <div class="details"><img alt="phone icon" src="data:image/svg+xml,%3csvg%20xmlns='http://www.w3.org/2000/svg'%20width='13.667'%20height='13.662'%20viewBox='0%200%2013.667%2013.662'%3e%3cpath%20id='phone'%20d='M15.455,17.037h-.089C5.04,16.443,3.574,7.731,3.369,5.072a1.576,1.576,0,0,1,1.45-1.7h2.9a1.051,1.051,0,0,1,.978.662L9.491,6a1.051,1.051,0,0,1-.231,1.135L8.14,8.267a4.923,4.923,0,0,0,3.983,3.993l1.14-1.13a1.051,1.051,0,0,1,1.14-.215l1.981.794a1.051,1.051,0,0,1,.647.977V15.46a1.576,1.576,0,0,1-1.576,1.576ZM4.946,4.426a.525.525,0,0,0-.525.525v.042c.242,3.111,1.792,10.467,11,10.992a.525.525,0,0,0,.557-.494V12.686L14,11.892l-1.508,1.5-.252-.032c-4.571-.573-5.191-5.144-5.191-5.191l-.032-.252L8.508,6.406,7.72,4.426Z'%20transform='translate(-3.364%20-3.375)'%20fill='%237eb7db'/%3e%3c/svg%3e"><a href="tel:920002005">920002005</a></div>
                        <div class="details"><img alt="email line" src="data:image/svg+xml,%3csvg%20xmlns='http://www.w3.org/2000/svg'%20width='13.667'%20height='10.25'%20viewBox='0%200%2013.667%2010.25'%3e%3cpath%20id='email-line'%20d='M14.812,6H2.854A.854.854,0,0,0,2,6.854V15.4a.854.854,0,0,0,.854.854H14.812a.854.854,0,0,0,.854-.854V6.854A.854.854,0,0,0,14.812,6Zm-.658,9.4H3.563L6.553,12.3l-.615-.594L2.854,14.9V7.5l5.309,5.283a.854.854,0,0,0,1.2,0l5.445-5.415v7.474L11.669,11.7l-.6.6ZM3.414,6.854H14.121L8.765,12.18Z'%20transform='translate(-2%20-6)'%20fill='%237eb7db'/%3e%3c/svg%3e"><a href="mailto:support@seha.sa">support@seha.sa</a></div>
                        <div class="details"><img alt="whatsapp" src="data:image/svg+xml,%3csvg%20width='14'%20height='15'%20viewBox='0%200%2014%2015'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3cpath%20fill-rule='evenodd'%20clip-rule='evenodd'%20d='M11.9602%202.27071C10.6442%200.953543%208.89393%200.227791%207.02923%200.227051C3.18704%200.227051%200.0599782%203.35292%200.0584405%207.19512C0.057928%208.42329%200.378928%209.62217%200.988904%2010.6789L-7.62939e-06%2014.29L3.69531%2013.321C4.71343%2013.8761%205.85977%2014.1687%207.02644%2014.1692H7.0293C10.8711%2014.1692%2013.9984%2011.0429%2014%207.20068C14.0007%205.33869%2013.2763%203.58787%2011.9602%202.27071ZM7.0293%2012.9922H7.02693C5.98731%2012.9918%204.96761%2012.7126%204.07808%2012.1849L3.86649%2012.0594L1.67367%2012.6344L2.25899%2010.4971L2.12121%2010.278C1.54125%209.35579%201.23492%208.28992%201.23538%207.19556C1.23665%204.00207%203.83576%201.40399%207.0316%201.40399C8.5791%201.40458%2010.0338%202.00783%2011.1277%203.10261C12.2216%204.19739%2012.8237%205.65261%2012.8231%207.20023C12.8217%2010.3939%2010.2227%2012.9922%207.0293%2012.9922ZM10.2073%208.65437C10.0331%208.56722%209.17681%208.14597%209.01715%208.08787C8.8575%208.02976%208.7414%208.00072%208.62527%208.17504C8.50917%208.34934%208.17537%208.74154%208.07374%208.85773C7.97216%208.97395%207.87056%208.98849%207.69638%208.90132C7.52221%208.81417%206.961%208.63032%206.29571%208.03711C5.77795%207.57544%205.42836%207.0052%205.32677%206.8309C5.22517%206.65658%205.31597%206.56233%205.40316%206.47554C5.4815%206.39752%205.57732%206.27218%205.66442%206.17049C5.75149%206.06881%205.78052%205.99618%205.83856%205.87999C5.89663%205.76378%205.86761%205.66209%205.82406%205.57494C5.78052%205.48779%205.4322%204.63075%205.28704%204.28213C5.14567%203.9426%205.00207%203.98854%204.89515%203.98322C4.79367%203.97817%204.67744%203.97709%204.56134%203.97709C4.44522%203.97709%204.25653%204.02068%204.09687%204.19498C3.93722%204.3693%203.48729%204.79055%203.48729%205.64756C3.48729%206.50458%204.11139%207.33254%204.19848%207.44875C4.28556%207.56497%205.42666%209.32371%207.17387%2010.0779C7.58943%2010.2573%207.91386%2010.3644%208.16681%2010.4447C8.58407%2010.5772%208.96377%2010.5585%209.26389%2010.5137C9.59852%2010.4637%2010.2944%2010.0925%2010.4395%209.68573C10.5847%209.279%2010.5847%208.93038%2010.5411%208.85775C10.4976%208.78513%2010.3815%208.74154%2010.2073%208.65437Z'%20fill='white'/%3e%3c/svg%3e" style="width: 16px; height: 16px; opacity: 0.5;"><a href="https://wa.me/920002005" target="_blank" rel="noreferrer">920002005</a></div>
                        <div class="timings mt-3"><span style="font-size: 12px; color: rgb(240, 243, 248);">أوقات العمل: الأحد حتى الخميس 8 ص - 11م</span></div>
                        <div class="social"><button><a href="https://www.youtube.com/channel/UCb9ZrS2YcriYqIPIHNp9wcQ"><img alt="youtube icon" src="data:image/svg+xml,%3csvg%20xmlns='http://www.w3.org/2000/svg'%20width='18'%20height='18'%20viewBox='0%200%2018%2018'%3e%3cg%20id='Group_4247'%20data-name='Group%204247'%20transform='translate(-326%20-6335)'%3e%3cpath%20id='youtube'%20d='M6.848,12.169V9.444l2.62,1.368-2.62,1.358Zm5.754-3.2a2.094,2.094,0,0,0-.386-.963,1.388,1.388,0,0,0-.972-.411c-1.357-.1-3.393-.1-3.393-.1h0s-2.036,0-3.393.1a1.388,1.388,0,0,0-.972.411,2.1,2.1,0,0,0-.386.963,14.673,14.673,0,0,0-.1,1.57v.736a14.681,14.681,0,0,0,.1,1.57,2.094,2.094,0,0,0,.386.963,1.641,1.641,0,0,0,1.07.414c.776.074,3.3.1,3.3.1s2.038,0,3.4-.1a1.387,1.387,0,0,0,.972-.411,2.1,2.1,0,0,0,.386-.963,14.681,14.681,0,0,0,.1-1.57v-.736a14.665,14.665,0,0,0-.1-1.57Z'%20transform='translate(327%206333.5)'%20fill='%23f0f3f8'%20fill-rule='evenodd'/%3e%3cg%20id='Path_8137'%20data-name='Path%208137'%20transform='translate(326%206335)'%20fill='none'%20opacity='0'%3e%3cpath%20d='M9,0A9,9,0,1,1,0,9,9,9,0,0,1,9,0Z'%20stroke='none'/%3e%3cpath%20d='M%209.000004768371582%200.4999980926513672%20C%204.313084602355957%200.4999980926513672%200.4999942779541016%204.31309700012207%200.4999942779541016%209.00003719329834%20C%200.4999942779541016%2013.68697738647461%204.313084602355957%2017.50007629394531%209.000004768371582%2017.50007629394531%20C%2013.68692493438721%2017.50007629394531%2017.50000381469727%2013.68697738647461%2017.50000381469727%209.00003719329834%20C%2017.50000381469727%204.31309700012207%2013.68692493438721%200.4999980926513672%209.000004768371582%200.4999980926513672%20M%209.000004768371582%20-1.9073486328125e-06%20C%2013.97056484222412%20-1.9073486328125e-06%2018.00000381469727%204.029457092285156%2018.00000381469727%209.00003719329834%20C%2018.00000381469727%2013.97061729431152%2013.97056484222412%2018.00007629394531%209.000004768371582%2018.00007629394531%20C%204.029444694519043%2018.00007629394531%20-5.7220458984375e-06%2013.97061729431152%20-5.7220458984375e-06%209.00003719329834%20C%20-5.7220458984375e-06%204.029457092285156%204.029444694519043%20-1.9073486328125e-06%209.000004768371582%20-1.9073486328125e-06%20Z'%20stroke='none'%20fill='%23f0f3f8'/%3e%3c/g%3e%3c/g%3e%3c/svg%3e"></a></button><button><a href="https://twitter.com/seha_services"><svg width="14" height="14" viewBox="0 0 1200 1227" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="#ffffff" d="M714.163 519.284L1160.89 0H1055.03L667.137 450.887L357.328 0H0L468.492 681.821L0 1226.37H105.866L515.491 750.218L842.672 1226.37H1200L714.137 519.284H714.163ZM569.165 687.828L521.697 619.934L144.011 79.6944H306.615L611.412 515.685L658.88 583.579L1055.08 1150.3H892.476L569.165 687.854V687.828Z"></path>
                                    </svg></a></button></div>
                    </div>
                    <div class="contact"><img alt="lean logo" src="https://sehtna.cloud/assets/static/media/lean-logo.47f1c2c4f559aab0fc8472beba56bb76.svg">
                        <div class="spacer"></div><img alt="moh logo" src="https://sehtna.cloud/assets/static/media/MOH-logo.3721a12f98819dbb30527088a659b864.svg">
                    </div>
                </div>
                <div class="footer-note-wrapper">
                    <p>منصة صحة معتمدة من قبل وزارة الصحة © 2025 </p>
                    <ul>
                        <li><a>سياسة الخصوصية وشروط الإستخدام</a></li>
                        <li><a class="" href="https://www.seha.sa/Content/LandingPages/UserManual.pdf">دليل الاستخدام</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const sidebar = document.getElementById("sidebar");
            const sidebarToggle = document.getElementById("sidebarToggle");
            const sidebarClose = document.getElementById("sidebarClose");
            const sidebarOverlay = document.getElementById("sidebarOverlay");

            // فتح القائمة
            sidebarToggle.addEventListener("click", function() {
                sidebar.classList.add("open");
                sidebarOverlay.classList.add("open");
            });

            // إغلاق القائمة
            sidebarClose.addEventListener("click", function() {
                sidebar.classList.remove("open");
                sidebarOverlay.classList.remove("open");
            });

            // إغلاق القائمة عند الضغط على الخلفية
            sidebarOverlay.addEventListener("click", function() {
                sidebar.classList.remove("open");
                sidebarOverlay.classList.remove("open");
            });

        });
    </script>

</body>

</html>