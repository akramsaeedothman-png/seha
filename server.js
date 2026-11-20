// server.js - Backend باستخدام Node.js و Express

const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');

const app = express();
const PORT = 3000;

// محاكاة بيانات SQL
const MOCK_ADMINS = [{ username: 'seha.admin', password: 'admin123', name: 'المشرف العام' }];
const MOCK_LEAVES = [
    { serviceCode: '1001', nationalID: '1234567890', patientName: 'أحمد محمد العلي', hospital: 'مستشفى الملك فهد', status: 'مقبولة', startDate: '2025-05-10', endDate: '2025-05-15', days: 6, doctorName: 'د. خالد الحربي', jobTitle: 'استشاري باطنية', creationDate: '2025-05-01' },
];

app.use(cors());
app.use(bodyParser.json());

// دالة المصادقة الوهمية للتحقق من رمز JWT
function authenticateToken(req, res, next) {
    const authHeader = req.headers['authorization'];
    const token = authHeader && authHeader.split(' ')[1];
    if (token == null || token !== 'MOCK_JWT_TOKEN_12345') {
        return res.status(403).json({ success: false, message: 'رمز المصادقة غير صالح أو مفقود.' });
    }
    next();
}

// ----------------------------------------------------
// API 1: تسجيل الدخول (POST /api/auth/login)
app.post('/api/auth/login', (req, res) => {
    const { username, password } = req.body;
    const user = MOCK_ADMINS.find(admin => admin.username === username && admin.password === password);
    if (user) {
        res.status(200).json({ success: true, token: 'MOCK_JWT_TOKEN_12345', adminName: user.name });
    } else {
        res.status(401).json({ success: false, message: 'اسم المستخدم أو كلمة المرور غير صحيحة.' });
    }
});

// ----------------------------------------------------
// API 2: الاستعلام العام (POST /api/leaves/query)
app.post('/api/leaves/query', (req, res) => {
    const { serviceId, idNumber } = req.body;
    const result = MOCK_LEAVES.find(leave => leave.serviceCode === serviceId && leave.nationalID === idNumber);

    setTimeout(() => {
        if (result) {
            res.status(200).json({ success: true, data: result });
        } else {
            res.status(404).json({ success: false, message: 'عذراً، لم يتم العثور على إجازة مطابقة لهذه البيانات.' });
        }
    }, 1000);
});

// ----------------------------------------------------
// API 3: إنشاء إجازة (POST /api/leaves/add)
app.post('/api/leaves/add', authenticateToken, (req, res) => {
    const leaveData = req.body;
    
    const newLeave = {
        ...leaveData,
        hospital: 'مستشفى محاكاة',
        status: 'قيد المراجعة',
        enteredBy: 'المشرف العام', 
    };
    MOCK_LEAVES.push(newLeave);

    res.status(201).json({ success: true, message: 'تم إنشاء سجل الإجازة بنجاح.' });
});

app.listen(PORT, () => {
    console.log(`✅ الخادم يعمل على المنفذ: http://localhost:${PORT}`);
});