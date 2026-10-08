<?php

$arPath = __DIR__ . '/../resources/lang/ar.json';
$enPath = __DIR__ . '/../resources/lang/en.json';

$ar = json_decode(file_get_contents($arPath), true);
$en = json_decode(file_get_contents($enPath), true);

$dict = [
    // Budgets
    "Budgets" => "الميزانيات",
    "Budget Management" => "إدارة الميزانيات",
    "Create Budget" => "إنشاء ميزانية",
    "Edit Budget" => "تعديل الميزانية",
    "Budget Details" => "تفاصيل الميزانية",
    "Budget Name" => "اسم الميزانية",
    "Allocated Amount" => "المبلغ المخصص",
    "Spent Amount" => "المبلغ المصروف",
    "Remaining Amount" => "المبلغ المتبقي",
    "e.g. Project Operational Budget" => "مثال: الميزانية التشغيلية للمشروع",
    "Fiscal Year" => "السنة المالية",

    // Departments
    "Departments" => "الأقسام",
    "Department Management" => "إدارة الأقسام",
    "Create Department" => "إنشاء قسم",
    "Edit Department" => "تعديل القسم",
    "Department Details" => "تفاصيل القسم",
    "Department Name" => "اسم القسم",
    "Department Code" => "كود القسم",
    "Manager Name" => "اسم المدير",
    "Parent Department" => "القسم الرئيسي",

    // Documents
    "Documents" => "المستندات",
    "Document Management" => "إدارة المستندات",
    "Create Document" => "إنشاء مستند",
    "Edit Document" => "تعديل المستند",
    "Document Details" => "تفاصيل المستند",
    "Document Title" => "عنوان المستند",
    "Category" => "التصنيف",
    "File" => "الملف",
    "e.g. DOC-2026-0001" => "مثال: DOC-2026-0001",
    "Electronic Archiving" => "الأرشيف الإلكتروني",

    // Expenses
    "Expenses" => "المصروفات",
    "Expense Management" => "إدارة المصروفات",
    "Create Expense" => "إنشاء مصروف",
    "Edit Expense" => "تعديل المصروف",
    "Expense Details" => "تفاصيل المصروف",
    "Expense Title" => "عنوان المصروف",
    "Expense Category" => "تصنيف المصروف",
    "Payment Date" => "تاريخ الدفع",

    // Invoices
    "Invoices" => "الفواتير",
    "Invoice Management" => "إدارة الفواتير",
    "Create Invoice" => "إنشاء فاتورة",
    "Edit Invoice" => "تعديل الفاتورة",
    "Invoice Details" => "تفاصيل الفاتورة",
    "Invoice Number" => "رقم الفاتورة",

    // Positions
    "Positions" => "المسميات الوظيفية",
    "Positions & Titles" => "المسميات والوظائف",
    "Create Position" => "إنشاء مسمى وظيفي",
    "Edit Position" => "تعديل المسمى الوظيفي",
    "Position Details" => "تفاصيل المسمى الوظيفي",

    // Receipts & Payments
    "Receipts" => "الإيصالات",
    "Receipt" => "الإيصال",
    "Payments" => "المدفوعات",
    "Payment" => "الدفعة",
    "Issued on" => "صادرة بتاريخ",
    "Amount Paid" => "المبلغ المدفوع",
    "Financial" => "المالية",

    // Roles & System Map
    "Search roles by name..." => "البحث عن الأدوار بالاسم...",
    "Reset search" => "إعادة تعيين البحث",
    "No permissions assigned" => "لا توجد صلاحيات مسندة",
    "View Role" => "عرض الدور",
    "No roles found" => "لم يتم العثور على أدوار",
    "Get started by creating a new role for system administration." => "ابدأ بإنشاء دور جديد لإدارة النظام.",
    "System Command Center & Quick Map" => "مركز قيادة النظام والخريطة السريعة",
    "System Command Center & Complete Map" => "مركز قيادة النظام والخريطة الكاملة",
    "Full administrative overview and direct routing map for all CFS-SMS institutional modules." => "نظرة عامة إدارية شاملة وخريطة التوجيه المباشر لجميع الوحدات المؤسسية.",
    "Super Admin Privilege Active" => "صلاحية المدير الفائق نشطة",
    "Welcome back, Super Admin" => "أهلاً بك مجدداً، المدير الفائق",
    "This central map gives you total visibility and instant navigation across every subsystem, workflow, and CRUD module deployed in the CFS Smart Management System. Choose any module below to manage data or audit operations." => "تمنحك هذه الخريطة المركزية رؤية كاملة وتنظيماً فوري عبر كافة الأنظمة الفرعية ومسارات العمل في نظام CFS-SMS.",
    "Users Hub" => "مركز المستخدمين",
    "Users Management" => "إدارة المستخدمين",
    "Manage system accounts, activation states, assignments, and credentials." => "إدارة حسابات النظام، حالات التفعيل، والتعيينات.",
    "View All Users" => "عرض جميع المستخدمين",
    "Add" => "إضافة",
    "Spatie RBAC" => "التحكم بالوصول RBAC",
    "Configure access control matrices, roles, and granular permissions." => "تكوين مصفوفات التحكم بالوصول، الأدوار والصلاحيات.",
    "Manage Roles" => "إدارة الأدوار",
    "Structure" => "الهيكل التنظيمي",
    "Institutional departments, operational units, and status controls." => "الأقسام المؤسسية، الوحدات التشغيلية وضوابط الحالة.",
    "HR Hub" => "مركز الموارد البشرية",
    "Manage job titles, hierarchies, and staff position assignments." => "إدارة المسميات الوظيفية الهيكلية وتكليفات الموظفين.",
    "Operations" => "العمليات التشغيلية",
    "Projects Management" => "إدارة المشاريع",
    "Track project budgets, burn rates, timelines, and status lifecycle." => "متابعة ميزانيات المشاريع، معدلات الصرف، الجداول الزمنية ودورة الحياة.",
    "Contracts & Attachments" => "العقود والمرفقات",
    "Draft, review, approve contracts, and manage secure file attachments." => "صياغة ومراجعة واعتماد العقود وإدارة المرفقات الآمنة.",
    "Finance" => "المالية",
    "Budgets Management" => "إدارة الميزانيات",
    "Institutional budgets, allocations, and financial utilization tracking." => "الميزانيات المؤسسية والتخصصات ومتابعة الاستغلال المالي.",
    "All Budgets" => "جميع الميزانيات",
    "Outflows" => "النفقات والمخرجات",
    "Expenses Management" => "إدارة المصروفات",
    "Submit, review, and approve organizational expenditures and payouts." => "تقديم ومراجعة واعتماد النفقات والمدفوعات المؤسسية.",
    "All Expenses" => "جميع المصروفات",
    "Inflows" => "الإيرادات والمقروضات",
    "Incomes Management" => "إدارة الإيرادات",
    "Track donor funds, grants, revenue streams, and financial inflows." => "متابعة أموال المانحين، المنح، التدفقات المالية والإيرادات.",
    "All Incomes" => "جميع الإيرادات",
    "Billing" => "الفوترة",
    "Invoices Management" => "إدارة الفواتير",
    "Create, submit, and manage institutional billing and billing workflows." => "إنشاء وتقديم وإدارة الفواتير المؤسسية ومسارات عملها.",
    "All Invoices" => "جميع الفواتير",
    "Payments & Receipts" => "المدفوعات والإيصالات",
    "Manage financial disbursements, payment vouchers, and official receipts." => "إدارة الصرف المالي، سندات الدفع والإيصالات الرسمية.",
    "Analytics" => "التحليلات",
    "Financial Reports Hub" => "مركز التقارير المالية",
    "Comprehensive institutional summaries, balance sheets, and data exports." => "ملخصات مؤسسية شاملة، الميزانيات العمومية وتصدير البيانات.",
    "Open Financial Reports" => "فتح التقارير المالية",
    "Archiving" => "الأرشفة",
    "Secure document repository, category filtering, and file management." => "مستودع المستندات الآمن، تصنيف الملفات وإدارتها.",
    "All Documents" => "جميع المستندات",
    "Upload" => "رفع",
    "Audit Logs & Tracking" => "سجلات التدقيق والمتابعة",
    "Monitor administrative actions, system events, and security tracking logs." => "مراقبة الإجراءات الإدارية، أحداث النظام وسجلات الأمان.",

    // Projects
    "Spending Percentage" => "نسبة الصرف",
    "Burn Rate" => "معدل الاستهلاك المالي",
    "Update Project" => "تحديث المشروع",
    "General information about this project." => "المعلومات العامة حول هذا المشروع.",
    "Not Specified" => "غير محدد",
    "Project Progress" => "تقدم المشروع",
    "Current project completion status." => "حالة إنجاز المشروع الحالية.",
    "Current financial position of the project." => "المركز المالي الحالي للمشروع.",
    "Timeline" => "الجدول الزمني",
    "Project start and end dates." => "تاريخ بدء وانهاء المشروع."
];

// Scan for any missing string keys
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/../resources/views'));
foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        preg_match_all("/__\(\s*['\"](.*?)['\"]\s*[\),]/", $content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key) {
                if (str_contains($key, '$') || empty(trim($key)) || str_starts_with($key, 'auth.')) {
                    continue;
                }
                
                if (!isset($ar[$key])) {
                    $ar[$key] = $dict[$key] ?? $key;
                }
                if (!isset($en[$key])) {
                    $en[$key] = $key;
                }
            }
        }
    }
}

file_put_contents($arPath, json_encode($ar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
file_put_contents($enPath, json_encode($en, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "Auto translation sweep complete!\n";
