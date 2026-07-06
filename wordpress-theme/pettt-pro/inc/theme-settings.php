<?php
if (!defined('ABSPATH')) { exit; }

add_action('admin_menu', function () {
    add_submenu_page('pettt-dashboard', 'تنظیمات قالب NinjaPet', 'تنظیمات قالب', 'manage_options', 'pettt-theme-settings', 'pettt_theme_settings_page');
});

add_action('admin_init', function () {
    register_setting('pettt_settings_group', 'pettt_settings', ['sanitize_callback'=>'pettt_sanitize_settings']);
});

function pettt_sanitize_settings($input) {
    $out = [];
    foreach ((array)$input as $key => $value) {
        $out[$key] = is_array($value) ? array_map('sanitize_text_field', $value) : wp_kses_post($value);
    }
    return $out;
}

function pettt_setting($key, $default='') {
    $settings = get_option('pettt_settings', []);
    return $settings[$key] ?? $default;
}

function pettt_theme_settings_page() {
    $s = get_option('pettt_settings', []);
    ?>
    <div class="wrap pettt-admin-wrap">
      <h1>تنظیمات اختصاصی قالب NinjaPet</h1>
      <form method="post" action="options.php" class="pettt-settings-form">
        <?php settings_fields('pettt_settings_group'); ?>
        <div class="pettt-admin-panel">
          <h2>برندینگ</h2>
          <p><label>نام انگلیسی برند</label><input name="pettt_settings[brand_name]" value="<?php echo esc_attr($s['brand_name'] ?? 'NinjaPet'); ?>"></p>
          <p><label>نام فارسی برند</label><input name="pettt_settings[brand_name_fa]" value="<?php echo esc_attr($s['brand_name_fa'] ?? 'نینجا پت'); ?>"></p>
          <p><label>رنگ اصلی بنفش</label><input type="color" name="pettt_settings[accent_color]" value="<?php echo esc_attr($s['accent_color'] ?? '#5B45F5'); ?>"></p>
          <p><label>رنگ تیره برند</label><input type="color" name="pettt_settings[dark_color]" value="<?php echo esc_attr($s['dark_color'] ?? '#080A12'); ?>"></p>
        </div>
        <div class="pettt-admin-panel">
          <h2>فونت فارسی</h2>
          <p><label>نام فونت</label><input name="pettt_settings[custom_font_family]" value="<?php echo esc_attr($s['custom_font_family'] ?? 'NinjaPetFont'); ?>" placeholder="مثلاً YekanBakh"></p>
          <p><label>آدرس فایل فونت WOFF2</label><input name="pettt_settings[custom_font_url]" value="<?php echo esc_attr($s['custom_font_url'] ?? ''); ?>" placeholder="فایل فونت را در رسانه وردپرس آپلود کن و لینک آن را اینجا بگذار"></p>
          <p class="np-font-preview">پیش‌نمایش فونت: نینجا پت، راهنمای هوشمند حیوانات خانگی</p>
        </div>
        <div class="pettt-admin-panel">
          <h2>صفحه اصلی</h2>
          <p><label>عنوان معرفی اصلی</label><input name="pettt_settings[hero_title]" value="<?php echo esc_attr($s['hero_title'] ?? 'نینجا پت، راهنمای هوشمند دنیای حیوانات خانگی'); ?>"></p>
          <p><label>متن معرفی</label><textarea name="pettt_settings[hero_text]"><?php echo esc_textarea($s['hero_text'] ?? 'غذای مناسب پتت را پیدا کن، برندها را مقایسه کن و مراکز معتبر مرتبط با حیوانات خانگی را در شهر خودت ببین.'); ?></textarea></p>
          <p><label>متن دکمه اصلی</label><input name="pettt_settings[hero_cta]" value="<?php echo esc_attr($s['hero_cta'] ?? 'پیدا کردن غذای مناسب'); ?>"></p>
          <p><label>لینک دکمه اصلی</label><input name="pettt_settings[hero_cta_url]" value="<?php echo esc_attr($s['hero_cta_url'] ?? '/food'); ?>"></p>
        </div>
        <div class="pettt-admin-panel">
          <h2>اعلان بالای سایت</h2>
          <p><label><input type="checkbox" name="pettt_settings[announcement_enabled]" value="1" <?php checked($s['announcement_enabled'] ?? '', '1'); ?>> فعال‌سازی اعلان</label></p>
          <p><label>متن اعلان</label><textarea name="pettt_settings[announcement_text]"><?php echo esc_textarea($s['announcement_text'] ?? ''); ?></textarea></p>
          <p><label>تصویر اعلان</label><input name="pettt_settings[announcement_image]" value="<?php echo esc_attr($s['announcement_image'] ?? ''); ?>"></p>
          <p><label>آیکون FontAwesome</label><input name="pettt_settings[announcement_icon]" value="<?php echo esc_attr($s['announcement_icon'] ?? 'fa-solid fa-paw'); ?>" placeholder="fa-solid fa-paw"></p>
          <p><label>رنگ پس‌زمینه</label><input type="color" name="pettt_settings[announcement_bg]" value="<?php echo esc_attr($s['announcement_bg'] ?? '#EEEAFE'); ?>"></p>
          <p><label>رنگ متن</label><input type="color" name="pettt_settings[announcement_color]" value="<?php echo esc_attr($s['announcement_color'] ?? '#080A12'); ?>"></p>
          <p><label>سایز فونت</label><input type="number" name="pettt_settings[announcement_size]" value="<?php echo esc_attr($s['announcement_size'] ?? '14'); ?>"></p>
        </div>
        <div class="pettt-admin-panel">
          <h2>تماس و فوتر</h2>
          <p><label>شماره تماس</label><input name="pettt_settings[phone]" value="<?php echo esc_attr($s['phone'] ?? '02191303284'); ?>"></p>
          <p><label>ایمیل</label><input name="pettt_settings[email]" value="<?php echo esc_attr($s['email'] ?? 'Info@ninjapet.ir'); ?>"></p>
          <p><label>متن فوتر</label><textarea name="pettt_settings[footer_text]"><?php echo esc_textarea($s['footer_text'] ?? 'نینجا پت، راهنمای هوشمند برای انتخاب غذا، شناخت برندها و پیدا کردن مراکز معتبر حیوانات خانگی.'); ?></textarea></p>
          <p><label>کد مجوزها / اینماد / ساماندهی</label><textarea name="pettt_settings[license_html]"><?php echo esc_textarea($s['license_html'] ?? ''); ?></textarea></p>
        </div>
        <div class="pettt-admin-panel">
          <h2>اتصال پیشنهاد غذا</h2>
          <p><label>متن باکس پیشنهاد در پروفایل</label><input name="pettt_settings[recommendation_title]" value="<?php echo esc_attr($s['recommendation_title'] ?? 'غذاهای پیشنهادی برای پت شما'); ?>"></p>
          <p><label>تعداد محصولات پیشنهادی</label><input type="number" name="pettt_settings[recommendation_count]" value="<?php echo esc_attr($s['recommendation_count'] ?? '4'); ?>"></p>
        </div>
        <?php submit_button('ذخیره تنظیمات'); ?>
      </form>
    </div>
    <?php
}

add_action('admin_enqueue_scripts', function($hook){
    if (strpos($hook, 'pettt-theme-settings') === false) return;
    wp_add_inline_style('wp-admin', '.pettt-settings-form{max-width:980px}.pettt-settings-form .pettt-admin-panel{margin:18px 0}.pettt-settings-form label{display:block;font-weight:700;margin-bottom:7px}.pettt-settings-form input,.pettt-settings-form textarea{width:100%;padding:10px}.pettt-settings-form textarea{min-height:100px}.np-font-preview{padding:18px;border-radius:14px;background:#f7f4ff;font-size:20px}');
});
