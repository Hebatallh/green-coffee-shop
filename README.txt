====================================================
  GREEN COFFEE SHOP - PHP/MySQL Project
  مشروع محل قهوة - HTML + CSS + JS + PHP + MySQL
====================================================

=== متطلبات التشغيل ===
1. XAMPP (يحتوي Apache + MySQL + PHP)
   تحميل: https://www.apachefriends.org

=== خطوات التشغيل ===

الخطوة 1: تثبيت XAMPP
   - حمّل XAMPP وثبّته
   - شغّل Apache و MySQL من XAMPP Control Panel

الخطوة 2: نقل الملفات
   - انسخ مجلد "green-coffee-shop" كاملاً
   - الصقه في: C:\xampp\htdocs\
   - النتيجة: C:\xampp\htdocs\green-coffee-shop\

الخطوة 3: إنشاء قاعدة البيانات
   - افتح المتصفح: http://localhost/phpmyadmin
   - اضغط "Import" من القائمة العلوية
   - اختر الملف: database/green_coffee_shop.sql
   - اضغط "Go"

الخطوة 4: إعداد مفتاح الذكاء الاصطناعي (اختياري)
   - افتح الملف: includes/config.php
   - استبدل: YOUR_OPENAI_API_KEY_HERE
   - بمفتاحك من: https://platform.openai.com/api-keys
   (بدون المفتاح، كل شيء يشتغل ما عدا شات الذكاء الاصطناعي)

الخطوة 5: افتح الموقع
   - افتح المتصفح
   - اكتب: http://localhost/green-coffee-shop/
   - الموقع يشتغل!

=== صفحات الموقع ===
- الرئيسية:  http://localhost/green-coffee-shop/
- المنيو:    http://localhost/green-coffee-shop/menu.php
- من نحن:   http://localhost/green-coffee-shop/about.php
- تواصل:    http://localhost/green-coffee-shop/contact.php
- السلة:    http://localhost/green-coffee-shop/cart.php
- AI Chat:  http://localhost/green-coffee-shop/ai-chat.php

=== هيكل الملفات ===
green-coffee-shop/
├── index.php          (الصفحة الرئيسية)
├── menu.php           (المنيو)
├── about.php          (من نحن)
├── contact.php        (تواصل معنا)
├── cart.php           (سلة المشتريات)
├── ai-chat.php        (شات الذكاء الاصطناعي)
├── css/
│   └── style.css      (التصميم)
├── js/
│   ├── main.js        (السلة والإشعارات)
│   ├── cart.js        (عمليات السلة)
│   └── ai-chat.js     (شات الذكاء الاصطناعي)
├── api/
│   ├── menu.php       (API المنيو)
│   ├── orders.php     (API الطلبات)
│   ├── contact.php    (API التواصل)
│   └── ai-chat.php   (API الذكاء الاصطناعي)
├── includes/
│   ├── config.php     (الإعدادات)
│   ├── db.php         (قاعدة البيانات)
│   ├── header.php     (رأس الصفحة)
│   └── footer.php     (تذييل الصفحة)
└── database/
    └── green_coffee_shop.sql  (ملف قاعدة البيانات)

====================================================
