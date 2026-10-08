<?php

$arPath = __DIR__ . '/../resources/lang/ar.json';
$enPath = __DIR__ . '/../resources/lang/en.json';

$ar = json_decode(file_get_contents($arPath), true);
$en = json_decode(file_get_contents($enPath), true);

$newTranslations = [
    "Please fix the following errors:" => "يرجى تصحيح الأخطاء التالية:",
    "System Performance" => "أداء النظام",
    "Total Value" => "إجمالي القيمة",
    "System" => "النظام",
    "Quick Access" => "الوصول السريع",
    "Analyze financial data" => "تحليل البيانات المالية",
    "Manage your account" => "إدارة حسابك",
    "View Audit Trails" => "عرض سجلات التدقيق",
    "Main Dashboard & KPIs" => "لوحة التحكم الرئيسية ومؤشرات الأداء",
    "Return to main enterprise overview metrics and charts." => "العودة لمؤشرات ورسومات النظرة العامة للمؤسسة.",
    "Open Dashboard" => "فتح لوحة التحكم",
    "This is a secure area of the application. Please confirm your password before continuing." => "هذه منطقة آمنة في التطبيق. يرجى تأكيد كلمة المرور الخاصة بك قبل المتابعة.",
    "Confirm" => "تأكيد",
    "Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one." => "هل نسيت كلمة المرور؟ لا مشكلة. فقط أخبرنا بعنوان بريدك الإلكتروني وسنرسل لك رابط إعادة تعيين كلمة المرور لإدخال كلمة جديدة.",
    "Email Password Reset Link" => "إرسال رابط إعادة تعيين كلمة المرور",
    "Login" => "تسجيل الدخول",
    "A professional institutional platform for managing projects, contracts, finance, human resources, documents, and reports in one secure system." => "منصة مؤسسية احترافية لإدارة المشاريع والعقود والمالية والموارد البشرية والمستندات والتقارير في نظام واحد آمن.",
    "Secure & Permission-Based Access" => "وصول آمن مبني على الصلاحيات",
    "Centralized Management & Reporting" => "إدارة وتقارير مركزية",
    "Designed for Institutional Workflows" => "مصمم لسلسلة إجراءات العمل المؤسسية",
    "Secure Access" => "دخول آمن",
    "Welcome back" => "أهلاً بك مجدداً",
    "Sign in to access your CFS-SMS management workspace." => "سجل الدخول للوصول إلى مساحة عمل إدارة CFS-SMS الخاصة بك.",
    "Enter your email address" => "أدخل عنوان بريدك الإلكتروني",
    "Enter your password" => "أدخل كلمة المرور",
    "Show password" => "إظهار كلمة المرور",
    "Hide password" => "إخفاء كلمة المرور",
    "Remember me" => "تذكرني",
    "Forgot your password?" => "هل نسيت كلمة المرور؟",
    "Log in" => "تسجيل الدخول",
    "Authorized access only. Please use your institutional account." => "للمصرح لهم فقط. يرجى استخدام حسابك المؤسسي.",
    "Already registered?" => "مسجل بالفعل؟",
    "Register" => "تسجيل حساب",
    "Reset Password" => "إعادة تعيين كلمة المرور",
    "Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another." => "شكراً لتسجيلك! قبل البدء، هل يمكنك تفعيل عنوان بريدك الإلكتروني بالنقر على الرابط الذي أرسلناه لك للتو؟ إذا لم تتلق البريد الإلكتروني، يسعدنا إرسال بريد آخر.",
    "A new verification link has been sent to the email address you provided during registration." => "تم إرسال رابط تفعيل جديد إلى عنوان البريد الإلكتروني الذي قدمته أثناء التسجيل.",
    "Resend Verification Email" => "إعادة إرسال بريد التفعيل",
    "Attachments & Files" => "المرفقات والملفات",
    "Manage related documents, scanned checks, and receipts." => "إدارة المستندات والشيكات الممسوحة ضوئياً والإيصالات ذات الصلة.",
    "Files" => "الملفات",
    "Document Title" => "عنوان المستند",
    "e.g., First Payment Check" => "مثال: شيك الدفعة الأولى",
    "Select File (PDF, Images, Doc)" => "اختر الملف (PDF, صور, مستندات)",
    "Size:" => "الحجم:",
    "Uploaded By:" => "رُفع بواسطة:",
    "Unknown" => "غير معروف",
    "Are you sure you want to delete this file?" => "هل أنت متأكد من رغبتك في حذف هذا الملف؟",
    "No attachments found." => "لم يتم العثور على مرفقات.",
    "Upload files using the form above." => "قم برفع الملفات باستخدام النموذج أعلاه.",
    "welcome.meta_title" => "نظام الإدارة المؤسسي الذكي | CFS-SMS",
    "welcome.logo_name" => "CFS-SMS",
    "welcome.logo_tagline" => "نظام الإدارة الذكي",
    "welcome.nav_dashboard" => "لوحة التحكم",
    "welcome.nav_login" => "تسجيل الدخول",
    "welcome.hero_badge" => "الجيل القادم من أنظمة إدارة المؤسسات",
    "welcome.hero_title_line1" => "إدارة مؤسسية متكاملة",
    "welcome.hero_title_gradient" => "بكل ذكاء وااحترافية",
    "welcome.hero_desc" => "منصة شاملة تجمع بين إدارة المشاريع، العقود، والتقارير المالية والتحكم بالصلاحيات لضمان أعلى مستويات الأداء الشفاف.",
    "welcome.hero_cta_dashboard" => "الانتقال للوحة التحكم",
    "welcome.hero_cta_login" => "تسجيل الدخول للنظام",
    "welcome.hero_cta_explore" => "استكشاف الميزات",
    "welcome.footer_features_finance" => "المودول المالي والتقارير",
    "welcome.footer_features_projects" => "إدارة المشاريع والعقود",
    "welcome.footer_features_reports" => "التحكم بالصلاحيات والأمان",
    "welcome.features_title" => "كل ما تحتاجه لإدارة مؤسستك",
    "welcome.features_subtitle" => "أدوات متطورة وشاملة تُساعدك على التحكم في جميع العمليات والإجراءات بسهولة وبصورة لحظية.",
    "welcome.cta_title" => "جاهز لرفع مستوى الكفاءة الإدارية؟",
    "welcome.cta_desc" => "ابدأ الآن باستخدام نظام CFS-SMS واستمتع بتجربة إدارة سلسة وآمنة لجميع مشاريعك وعقودك.",
    "welcome.cta_login_now" => "تسجيل الدخول الآن",
    "welcome.footer_about_title" => "عن النظام",
    "welcome.footer_about_text" => "منصة CFS-SMS هي الحل المتكامل لإدارة المشاريع والعقود والعمليات المالية بدقة وكفاءة عالية.",
    "welcome.footer_features_title" => "المميزات الرئيسية",
    "welcome.footer_support_title" => "الدعم والمساعدة",
    "welcome.footer_support_help" => "مركز المساعدة",
    "welcome.footer_support_docs" => "الوثائق والدليل",
    "welcome.footer_support_contact" => "تواصل معنا",
    "welcome.footer_rights" => "جميع الحقوق محفوظة.",
    "Attachment uploaded successfully." => "تم رفع المرفق بنجاح.",
    "File not found on server." => "الملف غير موجود على السيرفر.",
    "Attachment deleted successfully." => "تم حذف المرفق بنجاح.",
    "All notifications marked as read." => "تم تعليم جميع الإشعارات كـ مقروءة."
];

foreach ($newTranslations as $key => $arVal) {
    $ar[$key] = $arVal;
    if (!isset($en[$key])) {
        $en[$key] = $key;
    }
}

file_put_contents($arPath, json_encode($ar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
file_put_contents($enPath, json_encode($en, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "Successfully updated ar.json and en.json!\n";
