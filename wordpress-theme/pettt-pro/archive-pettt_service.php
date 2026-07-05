<?php get_header(); ?>
<section class="pettt-archive-hero service">
  <div class="pettt-container">
    <span class="pettt-kicker">City Services</span>
    <h1>پت‌شاپ‌ها، دامپزشکی‌ها و آرایشگرها</h1>
    <p>لیست خدمات شهری بر اساس استان و شهر؛ همراه با تماس، اینستاگرام، ویدئو و لوکیشن.</p>
  </div>
</section>
<section class="pettt-container pettt-section">
  <form class="pettt-filter-bar pettt-service-filter" method="get">
    <input type="text" name="province" value="<?php echo esc_attr($_GET['province'] ?? ''); ?>" placeholder="استان">
    <input type="text" name="city" value="<?php echo esc_attr($_GET['city'] ?? ''); ?>" placeholder="شهر">
    <button type="submit">نمایش خدمات</button>
  </form>
  <div class="pettt-service-grid pro">
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <?php $instagram = pettt_meta(get_the_ID(), '_pettt_instagram', ''); $phone = pettt_meta(get_the_ID(), '_pettt_phone', ''); ?>
      <article class="pettt-service-card pro">
        <a href="<?php the_permalink(); ?>" class="pettt-service-card-image">
          <?php if(has_post_thumbnail()) the_post_thumbnail('pettt-card'); else echo '<div class="pettt-placeholder">'.esc_html(mb_substr(get_the_title(),0,2)).'</div>'; ?>
        </a>
        <div class="pettt-service-card-body">
          <span><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_city', 'شهر')); ?>، <?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_province', 'استان')); ?></span>
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <p><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_address', 'آدرس ثبت نشده')); ?></p>
          <div class="pettt-service-card-actions">
            <?php if($phone): ?><a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>">تماس</a><?php endif; ?>
            <?php if($instagram): ?><a href="<?php echo esc_url(pettt_service_instagram_url($instagram)); ?>" target="_blank" rel="noopener">اینستاگرام</a><?php endif; ?>
            <a href="<?php the_permalink(); ?>">جزئیات</a>
          </div>
        </div>
      </article>
    <?php endwhile; else: ?>
      <p>خدمتی پیدا نشد.</p>
    <?php endif; ?>
  </div>
  <?php the_posts_pagination(); ?>
</section>
<?php get_footer(); ?>
