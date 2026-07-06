<?php
if (!defined('ABSPATH')) { exit; }

add_action('admin_menu', function(){
    add_submenu_page('pettt-dashboard', 'ورود پیامکی SMS.ir', 'ورود پیامکی', 'manage_options', 'ninjapet-smsir', 'ninjapet_smsir_settings_page');
});

function ninjapet_smsir_settings_page(){
    ?>
    <div class="wrap pettt-admin-wrap">
      <h1>سازگاری ورود پیامکی SMS.ir</h1>
      <div class="pettt-admin-panel">
        <p>قالب NinjaPet برای افزونه‌های رسمی SMS.ir آماده است. برای نمایش فرم ورود پیامکی، افزونه SMS.ir یا دروازه را نصب کنید و از شورت‌کدهای رسمی استفاده کنید.</p>
        <ul>
          <li><code>[smsir_login]</code> فرم ورود و ثبت‌نام</li>
          <li><code>[smsir_login_modal]</code> پاپ‌آپ ورود</li>
          <li><code>[ninjapet_login]</code> فرم سازگار با استایل NinjaPet</li>
        </ul>
        <p>در پنل SMS.ir از مسیر برنامه‌نویسان، API Key و پترن ورود را بگیرید و داخل افزونه رسمی وارد کنید.</p>
      </div>
    </div>
    <?php
}

add_shortcode('ninjapet_login', function(){
    if (is_user_logged_in()) {
        $u = wp_get_current_user();
        return '<div class="np-login-card"><h3>خوش آمدی '.esc_html($u->display_name).'</h3><a class="pettt-primary" href="'.esc_url(home_url('/pettt-account')).'">پروفایل من</a><a class="pettt-secondary" href="'.esc_url(wp_logout_url(home_url('/'))).'">خروج</a></div>';
    }
    if (shortcode_exists('smsir_login')) {
        return '<div class="np-login-card smsir-ready">'.do_shortcode('[smsir_login]').'</div>';
    }
    return '<div class="np-login-card"><h3>ورود و ثبت‌نام</h3><p>برای ورود پیامکی، افزونه رسمی SMS.ir یا دروازه را نصب و فعال کنید. تا آن زمان ورود وردپرس فعال است.</p>'.wp_login_form(['echo'=>false,'redirect'=>home_url('/pettt-account')]).'<a class="pettt-secondary" href="'.esc_url(wp_registration_url()).'">ثبت‌نام</a></div>';
});

function ninjapet_login_url(){ return home_url('/pettt-account'); }
