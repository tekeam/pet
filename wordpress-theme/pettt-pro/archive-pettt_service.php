<?php get_header(); ?>
<section class="pettt-archive-hero service">
  <div class="pettt-container">
    <span class="pettt-kicker">City Services</span>
    <h1>پت‌شاپ‌ها، دامپزشکی‌ها و آرایشگرها</h1>
    <p>لیست خدمات شهری بر اساس استان و شهر؛ قابل مدیریت از پنل وردپرس.</p>
  </div>
</section>
<section class="pettt-container pettt-section">
  <form class="pettt-filter-bar pettt-service-filter" method="get">
    <input type="text" name="province" value="<?php echo esc_attr($_GET['province'] ?? ''); ?>" placeholder="استان">
    <input type="text" name="city" value="<?php echo esc_attr($_GET['city'] ?? ''); ?>" placeholder="شهر">
    <button type="submit">نمایش خدمات</button>
  </form>
  <div class="pettt-service-grid">
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <a class="pettt-service-card" href="<?php the_permalink(); ?>">
        <span><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_city', 'شهر')); ?>، <?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_province', 'استان')); ?></span>
        <h3><?php the_title(); ?></h3>
        <p><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_address', 'آدرس ثبت نشده')); ?></p>
        <b><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_phone', '')); ?></b>
      </a>
    <?php endwhile; else: ?>
      <p>خدمتی پیدا نشد.</p>
    <?php endif; ?>
  </div>
  <?php the_posts_pagination(); ?>
</section>
<?php get_footer(); ?>
