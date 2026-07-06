<?php if (!defined('ABSPATH')) exit; ?>
<!doctype html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php $ninjapet_header_done = function_exists('elementor_theme_do_location') && elementor_theme_do_location('header'); ?>
<?php if (!$ninjapet_header_done) : ?>
<header class="pettt-header np-header">
  <div class="pettt-container pettt-header-inner">
    <div class="np-header-right">
      <?php echo ninjapet_logo_html('pettt-logo np-logo'); ?>
      <nav class="pettt-nav np-main-nav"><?php wp_nav_menu(['theme_location'=>'primary','container'=>false,'fallback_cb'=>false]); ?></nav>
    </div>
    <div class="pettt-user-menu np-auth-links">
      <?php if(is_user_logged_in()): $u = wp_get_current_user(); ?>
        <a href="<?php echo esc_url(home_url('/pettt-account')); ?>" class="pettt-icon-btn">پروفایل <?php echo esc_html($u->display_name ?: 'من'); ?></a>
        <a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>" class="pettt-secondary">خروج</a>
      <?php else: ?>
        <a href="<?php echo esc_url(ninjapet_login_url()); ?>" class="pettt-icon-btn">ورود</a>
        <a href="<?php echo esc_url(wp_registration_url()); ?>" class="pettt-primary">ثبت‌نام</a>
      <?php endif; ?>
    </div>
    <div class="pettt-mega">
      <div class="pettt-mega-card"><h3>غذا و برندها</h3><a href="<?php echo esc_url(get_post_type_archive_link('pettt_brand')); ?>">برندهای غذا</a><a href="<?php echo esc_url(get_post_type_archive_link('pettt_food')); ?>">مدل‌های غذا</a><a href="<?php echo esc_url(home_url('/pettt-account')); ?>">پیشنهاد غذای پت من</a></div>
      <div class="pettt-mega-card"><h3>مراکز مرتبط با پت</h3><a href="<?php echo esc_url(get_post_type_archive_link('pettt_service')); ?>">پت‌شاپ، دامپزشکی، آرایشگر و پانسیون</a><a href="<?php echo esc_url(home_url('/submit-service')); ?>">ثبت مرکز شما</a><a href="<?php echo esc_url(get_post_type_archive_link('pettt_video')); ?>">ویدیوهای آموزشی</a></div>
      <div class="pettt-mega-card"><h3>اجتماع NinjaPet</h3><a href="<?php echo esc_url(get_post_type_archive_link('pettt_explore')); ?>">اکسپلور پت‌ها</a><a href="<?php echo esc_url(home_url('/submit-explore')); ?>">ارسال پست اکسپلور</a><a href="<?php echo esc_url(home_url('/pettt-account')); ?>">پروفایل من</a></div>
    </div>
  </div>
</header>
<?php endif; ?>
<main class="pettt-main">
