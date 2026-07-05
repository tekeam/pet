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
<header class="pettt-header">
  <div class="pettt-container pettt-header-inner">
    <a class="pettt-logo" href="<?php echo esc_url(home_url('/')); ?>">
      <?php if (has_custom_logo()) { the_custom_logo(); } else { echo '<span>Pettt</span>'; } ?>
    </a>
    <nav class="pettt-nav">
      <?php wp_nav_menu(['theme_location'=>'primary','container'=>false,'fallback_cb'=>false]); ?>
    </nav>
    <div class="pettt-user-menu">
      <a href="<?php echo esc_url(home_url('/pettt-account')); ?>" class="pettt-icon-btn">پروفایل پت</a>
      <?php if (class_exists('WooCommerce')): ?>
        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="pettt-cart-btn">سبد خرید</a>
      <?php endif; ?>
    </div>
    <div class="pettt-mega">
      <div class="pettt-mega-card"><h3>کاتالوگ غذا</h3><a href="<?php echo esc_url(get_post_type_archive_link('pettt_brand')); ?>">برندها</a><a href="<?php echo esc_url(get_post_type_archive_link('pettt_food')); ?>">مدل‌های غذا</a><a href="<?php echo esc_url(home_url('/shop')); ?>">فروشگاه</a></div>
      <div class="pettt-mega-card"><h3>خدمات و آموزش</h3><a href="<?php echo esc_url(get_post_type_archive_link('pettt_service')); ?>">خدمات شهری</a><a href="<?php echo esc_url(get_post_type_archive_link('pettt_video')); ?>">ویدیوها</a><a href="<?php echo esc_url(home_url('/blog')); ?>">مقالات</a></div>
      <div class="pettt-mega-card"><h3>اجتماع Pettt</h3><a href="<?php echo esc_url(get_post_type_archive_link('pettt_explore')); ?>">اکسپلور</a><a href="<?php echo esc_url(home_url('/pettt-account')); ?>">پروفایل من</a></div>
    </div>
  </div>
</header>
<main class="pettt-main">
