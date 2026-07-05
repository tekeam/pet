<?php
if (!defined('ABSPATH')) { exit; }

add_action('admin_menu', function () {
    add_submenu_page('pettt-dashboard', 'تنظیمات قالب', 'تنظیمات قالب', 'manage_options', 'pettt-theme-settings', 'pettt_theme_settings_page');
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
      <h1>تنظیمات اختصاصی قالب Pettt Pro</h1>
      <form method="post" action="options.php" class="pettt-settings-form">
        <?php settings_fields('pettt_settings_group'); ?>
        <div class="pettt-admin-panel">
          <h2>صفحه اصلی</h2>
          <p><label>عنوان پوستر اصلی</label><input name="pettt_settings[hero_title]" value="<?php echo esc_attr($s['hero_title'] ?? ''); ?>" placeholder="همه چیز برای حیوان خانگی شما"></p>
          <p><label>متن پوستر اصلی</label><textarea name="pettt_settings[hero_text]" placeholder="متن معرفی صفحه اصلی"><?php echo esc_textarea($s['hero_text'] ?? ''); ?></textarea></p>
          <p><label>متن دکمه اصلی</label><input name="pettt_settings[hero_cta]" value="<?php echo esc_attr($s['hero_cta'] ?? 'ورود به فروشگاه'); ?>"></p>
          <p><label>لینک دکمه اصلی</label><input name="pettt_settings[hero_cta_url]" value="<?php echo esc_attr($s['hero_cta_url'] ?? '/shop'); ?>"></p>
        </div>
        <div class="pettt-admin-panel">
          <h2>تماس و برندینگ</h2>
          <p><label>شماره تماس</label><input name="pettt_settings[phone]" value="<?php echo esc_attr($s['phone'] ?? ''); ?>"></p>
          <p><label>ایمیل</label><input name="pettt_settings[email]" value="<?php echo esc_attr($s['email'] ?? ''); ?>"></p>
          <p><label>متن فوتر</label><textarea name="pettt_settings[footer_text]"><?php echo esc_textarea($s['footer_text'] ?? ''); ?></textarea></p>
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
    wp_add_inline_style('wp-admin', '.pettt-settings-form{max-width:980px}.pettt-settings-form .pettt-admin-panel{margin:18px 0}.pettt-settings-form label{display:block;font-weight:700;margin-bottom:7px}.pettt-settings-form input,.pettt-settings-form textarea{width:100%;padding:10px}.pettt-settings-form textarea{min-height:100px}');
});
