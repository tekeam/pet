<?php get_header(); ?>
<section class="pettt-archive-hero explore">
  <div class="pettt-container">
    <span class="pettt-kicker">Pettt Social</span>
    <h1>اکسپلور پت‌ها</h1>
    <p>عکس‌ها، تجربه‌ها، غذاهای محبوب و کامنت‌های کاربران درباره حیوانات خانگی.</p>
  </div>
</section>
<section class="pettt-container pettt-section">
  <?php echo do_shortcode('[pettt_explore_feed]'); ?>
</section>
<?php get_footer(); ?>
