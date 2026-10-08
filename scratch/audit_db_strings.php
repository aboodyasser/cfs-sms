<?php

$arPath = __DIR__ . '/../resources/lang/ar.json';
$ar = json_decode(file_get_contents($arPath), true);

$deptNames = [
    "Administration Department" => "قسم الإدارة العامّة",
    "Finance Department" => "قسم المالية",
    "Human Resources Department" => "قسم الموارد البشرية",
    "Programs Department" => "قسم البرامج",
    "Projects Department" => "قسم المشاريع",
    "IT Department" => "قسم تكنولوجيا المعلومات",
    "Procurement Department" => "قسم المشتريات",
    "Monitoring & Evaluation Department" => "قسم المتابعة والتقييم",
    "Unassigned" => "غير معيّن"
];

$statuses = [
    "approved" => "معتمد",
    "draft" => "مسودة",
    "submitted" => "مُقدَّم",
    "rejected" => "مرفوض",
    "expired" => "منتهي الصلاحية",
    "terminated" => "مفسوخ",
    "active" => "نشط",
    "inactive" => "غير نشط",
    "planned" => "مخطط",
    "on_hold" => "قيد الانتظار",
    "completed" => "مكتمل",
    "cancelled" => "ملغى",
    "overdue" => "متأخر",
    "partially_paid" => "مدفوع جزئياً",
    "paid" => "مدفوع",
    "vendor" => "مورّد",
    "donor" => "جهة مانحة"
];

$updated = false;

foreach ($deptNames as $en => $a) {
    if (!isset($ar[$en])) {
        $ar[$en] = $a;
        $updated = true;
    }
}

foreach ($statuses as $en => $a) {
    if (!isset($ar[$en])) {
        $ar[$en] = $a;
        $updated = true;
    }
    $cap = ucfirst($en);
    if (!isset($ar[$cap])) {
        $ar[$cap] = $a;
        $updated = true;
    }
}

if ($updated) {
    file_put_contents($arPath, json_encode($ar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "Added DB department and status translations to ar.json!\n";
} else {
    echo "All DB department and status translations already in ar.json\n";
}
