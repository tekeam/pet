<?php get_header(); ?>
<section class="pettt-archive-hero video">
  <div class="pettt-container">
    <span class="pettt-kicker">Pettt Academy</span>
    <h1>ویدیوهای آموزشی</h1>
    <p>آموزش‌های ویدیویی قابل مدیریت با آپلود فایل یا کد ویدیو از پنل مدیریت.</p>
  </div>
</section>
<section class="pettt-container pettt-section">
  <div class="pettt-archive-grid">
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <a class="pettt-video-tile" href="<?php the_permalink(); ?>">
        <div class="pettt-video-thumb">
          <?php if(has_post_thumbnail()) the_post_thumbnail('large'); else echo '<span>▶</span>'; ?>
        </div>
        <h3><?php the_title(); ?></h3>
        <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 18)); ?></p>
      </a>
    <?php endwhile; else: ?>
      <p>ویدیویی پیدا نشد.</p>
    <?php endif; ?>
  </div>
  <?php the_posts_pagination(); ?>
</section>
<?php get_footer(); ?>
