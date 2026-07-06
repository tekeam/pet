<?php if (!defined('ABSPATH')) exit; ?>
</main>
<footer class="pettt-footer np-footer">
  <div class="pettt-container np-footer-grid">
    <div class="np-footer-about">
      <h3><?php echo esc_html(ninjapet_brand_name_fa()); ?></h3>
      <p><?php echo wp_kses_post(pettt_setting('footer_text', 'نینجا پت، راهنمای هوشمند برای انتخاب غذا، شناخت برندها و پیدا کردن مراکز معتبر حیوانات خانگی.')); ?></p>
      <p>تلفن: <?php echo esc_html(ninjapet_contact_phone()); ?></p>
      <p>ایمیل: <?php echo esc_html(ninjapet_contact_email()); ?></p>
    </div>
    <div class="np-footer-logo">
      <?php echo ninjapet_logo_html('np-footer-brand'); ?>
      <span>🐾</span>
    </div>
    <div class="np-footer-links">
      <h4>دسترسی سریع</h4>
      <?php wp_nav_menu(['theme_location'=>'footer','container'=>false,'fallback_cb'=>false]); ?>
    </div>
    <div class="np-footer-licenses">
      <h4>مجوزها و اعتماد</h4>
      <div class="np-license-box"><?php echo wp_kses_post(pettt_setting('license_html', '<span>محل اینماد</span><span>ساماندهی</span>')); ?></div>
    </div>
  </div>
  <div class="pettt-copyright">© <?php echo date('Y'); ?> NinjaPet</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
