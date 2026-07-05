<?php if (!defined('ABSPATH')) exit; ?>
</main>
<footer class="pettt-footer">
  <div class="pettt-container pettt-footer-grid">
    <div>
      <h3>Pettt</h3>
      <p>پلتفرم تخصصی حیوانات خانگی، معرفی برندها، فروشگاه، مقالات، ویدیوها، دامپزشکی‌ها و پت‌شاپ‌ها.</p>
    </div>
    <div>
      <h4>تماس با ما</h4>
      <p>تلفن: <?php echo esc_html(get_theme_mod('contact_phone','021-00000000')); ?></p>
      <p>ایمیل: <?php echo esc_html(get_theme_mod('contact_email','info@pettt.ir')); ?></p>
    </div>
    <div><?php dynamic_sidebar('footer-1'); ?></div>
    <div><?php dynamic_sidebar('footer-2'); ?></div>
  </div>
  <div class="pettt-copyright">© <?php echo date('Y'); ?> Pettt</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
