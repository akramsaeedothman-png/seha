// script.js - الواجهة الأمامية تتصل بالباك إند عبر Fetch API
const BACKEND_URL = 'http://localhost:3000';

// ----------------------------------------------------
// 1. منطق صفحة الاستعلام (index.html)
// ----------------------------------------------------

document.addEventListener('DOMContentLoaded', () => {
    const queryForm = document.getElementById('queryForm');
    if (queryForm) queryForm.addEventListener('submit', handleQuery);

    // Sidebar functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', () => {
            document.getElementById('sidebar').classList.add('open');
            sidebarOverlay.classList.add('open');
            sidebarToggle.textContent = '×';
        });
    }

    if (sidebarClose) {
        sidebarClose.addEventListener('click', () => {
            document.getElementById('sidebar').classList.remove('open');
            sidebarOverlay.classList.remove('open');
            if (sidebarToggle) sidebarToggle.textContent = '☰';
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', () => {
            document.getElementById('sidebar').classList.remove('open');
            sidebarOverlay.classList.remove('open');
            if (sidebarToggle) sidebarToggle.textContent = '☰';
        });
    }

    // Close sidebar when clicking on a link
    const sidebarLinks = document.querySelectorAll('.sidebar-nav a');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('sidebar').classList.remove('open');
            sidebarOverlay.classList.remove('open');
            if (sidebarToggle) sidebarToggle.textContent = '☰';
        });
    });

    // Close sidebar on escape key
    document.addEventListener('keydown', (e) => {
        if (e.keyCode === 27) {
            document.getElementById('sidebar').classList.remove('open');
            sidebarOverlay.classList.remove('open');
            if (sidebarToggle) sidebarToggle.textContent = '☰';
        }
    });
});

async function handleQuery(e) {
    e.preventDefault();

    const serviceId = document.getElementById('service_code').value.trim();
    const idNumber = document.getElementById('identity_number').value.trim();

    const results = document.getElementById('results');
    const searchBtn = document.getElementById('search-btn');

    if (serviceId === "" || idNumber === "") {
        alert('فضلا اكتب الرمز ورقم الهوية');
        return;
    }

    searchBtn.textContent = 'جارٍ الاستعلام...';
    searchBtn.disabled = true;

    try {
        const response = await fetch(`${BACKEND_URL}/api/leaves/query`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ serviceId, idNumber }),
        });

        const data = await response.json();

        if (data.success) {
            displayResults(data.data);
            results.style.display = 'block';
            searchBtn.textContent = 'استعلام جديد';
        } else {
            alert('رقم الهوية خاطئ');
        }

    } catch (error) {
        alert('خطأ في الاتصال بالخادم.');
    } finally {
        searchBtn.disabled = false;
    }
}

function displayResults(result) {
    document.getElementById('name').textContent = result.patientName;
    document.getElementById('report_issue_date').textContent = result.creationDate;
    document.getElementById('start_date').textContent = result.startDate;
    document.getElementById('end_date').textContent = result.endDate;
    document.getElementById('duration').textContent = result.days;
    document.getElementById('doctor_name').textContent = result.doctorName || 'غير متوفر';
    document.getElementById('job_title').textContent = result.jobTitle || 'غير متوفر';
}

// ----------------------------------------------------
// 2. منطق صفحة تسجيل الدخول (admin-login.html)
// ----------------------------------------------------

document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    if (loginForm) loginForm.addEventListener('submit', handleLogin);
});

async function handleLogin(e) {
    e.preventDefault();

    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    const loginButton = document.querySelector('#loginForm button[type="submit"]');
    const errorMessage = document.getElementById('error-message');

    errorMessage.classList.add('hidden');
    loginButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> جاري التحقق...';
    loginButton.disabled = true;

    try {
        const response = await fetch(`${BACKEND_URL}/api/auth/login`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, password }),
        });

        const data = await response.json();

        if (data.success) {
            localStorage.setItem('adminToken', data.token);
            localStorage.setItem('adminName', data.adminName);
            window.location.href = 'add-leave.html'; // الانتقال لصفحة إنشاء الإجازة
        } else {
            showError(data.message, errorMessage);
        }

    } catch (error) {
        showError('خطأ في الاتصال بالخادم.', errorMessage);
    } finally {
        loginButton.innerHTML = 'تسجيل الدخول';
        loginButton.disabled = false;
    }
}

// ----------------------------------------------------
// 3. منطق صفحة إنشاء الإجازة (add-leave.html)
// ----------------------------------------------------

document.addEventListener('DOMContentLoaded', () => {
    const createLeaveForm = document.getElementById('createLeaveForm');
    if (createLeaveForm) createLeaveForm.addEventListener('submit', handleCreateLeave);
});

function appendAlert(message, type) {
    const alertPlaceholder = document.getElementById('alertPlaceholder');
    const wrapper = document.createElement('div');
    wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible fade show" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
    ].join('');
    alertPlaceholder.innerHTML = '';
    alertPlaceholder.append(wrapper);
}

async function handleCreateLeave(e) {
    e.preventDefault();

    const token = localStorage.getItem('adminToken');
    if (!token) {
        appendAlert('يرجى تسجيل الدخول أولاً.', 'danger');
        return;
    }

    const formData = {
        serviceCode: document.getElementById('newServiceCode').value.trim(),
        nationalID: document.getElementById('newNationalId').value.trim(),
        patientFullName: document.getElementById('patientFullName').value.trim(),
        creationDate: document.getElementById('creationDate').value,
        startDate: document.getElementById('startDate').value,
        endDate: document.getElementById('endDate').value,
        durationDays: parseInt(document.getElementById('durationDays').value),
        doctorName: document.getElementById('doctorName').value.trim(),
        jobTitle: document.getElementById('jobTitle').value.trim(),
        status: 'قيد المراجعة',
    };

    const submitButton = document.querySelector('#createLeaveForm button[type="submit"]');
    submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> جارٍ الإنشاء...';
    submitButton.disabled = true;

    try {
        const response = await fetch(`${BACKEND_URL}/api/leaves/add`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(formData),
        });

        const data = await response.json();

        if (data.success) {
            appendAlert(`✅ تم إنشاء الإجازة بنجاح برمز ${formData.serviceCode}.`, 'success');
            document.getElementById('createLeaveForm').reset();
            // إعادة تعبئة تاريخ الإنشاء بعد المسح
            document.getElementById('creationDate').value = formatDate(new Date());
        } else {
            appendAlert(`❌ فشل الإنشاء: ${data.message}`, 'danger');
        }

    } catch (error) {
        appendAlert('خطأ في الاتصال بالخادم.', 'danger');
    } finally {
        submitButton.innerHTML = 'إنشاء الإجازة';
        submitButton.disabled = false;
    }
}