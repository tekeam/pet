<?php
/* Template Name: Pettt Admin Front Dashboard */
get_header();
if (!current_user_can('manage_options')) {
    echo '<section class="pettt-container pettt-section"><h1>دسترسی غیرمجاز</h1><p>این صفحه فقط برای مدیر سایت است.</p></section>';
    get_footer();
    exit;
}
$cards = [
    ['برندها', pettt_admin_count('pettt_brand'), admin_url('edit.php?post_type=pettt_brand')],
    ['مدل‌های غذا', pettt_admin_count('pettt_food'), admin_url('edit.php?post_type=pettt_food')],
    ['ویدیوها', pettt_admin_count('pettt_video'), admin_url('edit.php?post_type=pettt_video')],
    ['خدمات شهری', pettt_admin_count('pettt_service'), admin_url('edit.php?post_type=pettt_service')],
    ['محصولات فروشگاه', class_exists('WooCommerce') ? pettt_admin_count('product') : 0, admin_url('edit.php?post_type=product')],
    ['مقالات', pettt_admin_count('post'), admin_url('edit.php')],
];
?>
<section class="pettt-account-hero admin">
  <div class="pettt-container">
    <span class="pettt-kicker">Management</span>
    <h1>داشبورد مدیریتی Pettt</h1>
    <p>نمای سریع محتوای سایت و لینک مستقیم به مدیریت هر بخش.</p>
  </div>
</section>
<section class="pettt-container pettt-front-admin-grid">
  <?php foreach($cards as $card): ?>
    <a class="pettt-front-admin-card" href="<?php echo esc_url($card[2]); ?>">
      <strong><?php echo esc_html($card[1]); ?></strong>
      <h2><?php echo esc_html($card[0]); ?></h2>
      <span>مدیریت</span>
    </a>
  <?php endforeach; ?>
</section>
<?php get_footer(); ?>
