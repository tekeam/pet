<?php
if (!defined('ABSPATH')) { exit; }

add_action('admin_menu', function () {
    add_menu_page(
        'داشبورد Pettt',
        'Pettt Pro',
        'manage_options',
        'pettt-dashboard',
        'pettt_admin_dashboard_page',
        'dashicons-pets',
        3
    );
    add_submenu_page('pettt-dashboard', 'راهنمای مدیریت محتوا', 'راهنمای مدیریت', 'manage_options', 'pettt-guide', 'pettt_admin_guide_page');
});

function pettt_admin_count($type) {
    $obj = wp_count_posts($type);
    return isset($obj->publish) ? (int) $obj->publish : 0;
}

function pettt_admin_dashboard_page() {
    ?>
    <div class="wrap pettt-admin-wrap">
      <h1>داشبورد مدیریت Pettt Pro</h1>
      <p>از این داشبورد می‌توانید بخش‌های اصلی پلتفرم را سریع مدیریت کنید.</p>
      <div class="pettt-admin-grid">
        <?php pettt_admin_card('برندها', pettt_admin_count('pettt_brand'), 'edit.php?post_type=pettt_brand', 'افزودن و ویرایش برندهای ایرانی و خارجی'); ?>
        <?php pettt_admin_card('مدل‌های غذا', pettt_admin_count('pettt_food'), 'edit.php?post_type=pettt_food', 'قیمت حدودی، جدول تغذیه، لینک خرید و آنالیز'); ?>
        <?php pettt_admin_card('ویدیوها', pettt_admin_count('pettt_video'), 'edit.php?post_type=pettt_video', 'آپلود ویدیو یا ثبت کد آپارات'); ?>
        <?php pettt_admin_card('خدمات شهری', pettt_admin_count('pettt_service'), 'edit.php?post_type=pettt_service', 'پت‌شاپ، دامپزشکی و آرایشگر بر اساس شهر و استان'); ?>
        <?php pettt_admin_card('محصولات فروشگاه', class_exists('WooCommerce') ? pettt_admin_count('product') : 0, 'edit.php?post_type=product', 'مدیریت فروشگاه با WooCommerce'); ?>
        <?php pettt_admin_card('مقالات', pettt_admin_count('post'), 'edit.php', 'مقاله‌های آموزشی و محتوای سئو'); ?>
      </div>
      <div class="pettt-admin-panel">
        <h2>چک‌لیست پیشنهادی مدیریت محتوا</h2>
        <ol>
          <li>برای هر برند لوگو، کشور، سطح برند، تاریخچه و مدل‌ها را کامل کنید.</li>
          <li>برای هر غذا قیمت حدودی، لینک خرید، جدول تغذیه و آنالیز تضمینی را وارد کنید.</li>
          <li>برای خدمات شهری استان و شهر را دقیق وارد کنید تا صفحه خدمات درست فیلتر شود.</li>
          <li>برای هر مقاله عنوان سئو، تصویر شاخص و متن خلاصه بنویسید.</li>
          <li>برای ویدیوها یا لینک فایل ویدیو وارد کنید یا Shortcode/کد آپارات را ثبت کنید.</li>
        </ol>
      </div>
    </div>
    <?php
}

function pettt_admin_card($title, $count, $url, $desc) {
    echo '<a class="pettt-admin-card" href="'.esc_url(admin_url($url)).'"><strong>'.esc_html($count).'</strong><h2>'.esc_html($title).'</h2><p>'.esc_html($desc).'</p></a>';
}

function pettt_admin_guide_page() {
    ?>
    <div class="wrap pettt-admin-wrap">
      <h1>راهنمای مدیریت Pettt Pro</h1>
      <div class="pettt-admin-panel">
        <h2>سازگاری‌ها</h2>
        <p>قالب برای WooCommerce، Elementor، ACF و افزونه‌های پیامکی وردپرس آماده‌سازی شده است.</p>
        <h2>ساخت صفحه پروفایل پت</h2>
        <p>یک برگه بسازید، قالب آن را روی «Pettt Account» قرار دهید یا از فایل <code>page-pettt-account.php</code> استفاده کنید.</p>
        <h2>ویدیوهای آموزشی</h2>
        <p>در بخش ویدیو، می‌توانید لینک فایل ویدیو یا Shortcode/کد آپارات را قرار دهید.</p>
      </div>
    </div>
    <?php
}

add_action('admin_enqueue_scripts', function($hook){
    if (strpos($hook, 'pettt') === false) return;
    wp_add_inline_style('wp-admin', '.pettt-admin-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:22px 0}.pettt-admin-card{background:#fff;border:1px solid #e5e7eb;border-radius:16px;padding:20px;text-decoration:none;color:#111827;box-shadow:0 10px 30px rgba(0,0,0,.05)}.pettt-admin-card strong{font-size:34px;color:#7c3aed}.pettt-admin-card h2{margin:8px 0}.pettt-admin-card p{color:#6b7280}.pettt-admin-panel{background:#fff;border-radius:16px;padding:22px;border:1px solid #e5e7eb;max-width:960px}.pettt-admin-panel li{margin-bottom:8px}@media(max-width:900px){.pettt-admin-grid{grid-template-columns:1fr}}');
});

add_filter('manage_pettt_food_posts_columns', function($columns){
    $columns['pettt_price'] = 'قیمت حدودی';
    $columns['pettt_brand'] = 'برند';
    return $columns;
});
add_action('manage_pettt_food_posts_custom_column', function($column, $post_id){
    if ($column === 'pettt_price') echo esc_html(pettt_meta($post_id, '_pettt_price', '-'));
    if ($column === 'pettt_brand') echo esc_html(pettt_meta($post_id, '_pettt_brand_id', '-'));
}, 10, 2);

add_filter('manage_pettt_service_posts_columns', function($columns){
    $columns['pettt_city'] = 'شهر';
    $columns['pettt_phone'] = 'تماس';
    return $columns;
});
add_action('manage_pettt_service_posts_custom_column', function($column, $post_id){
    if ($column === 'pettt_city') echo esc_html(pettt_meta($post_id, '_pettt_city', '-'));
    if ($column === 'pettt_phone') echo esc_html(pettt_meta($post_id, '_pettt_phone', '-'));
}, 10, 2);
