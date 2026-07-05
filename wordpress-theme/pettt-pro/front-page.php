<?php get_header(); ?>

<section class="pettt-hero-pro">
  <div class="pettt-container pettt-hero-grid">
    <div class="pettt-hero-copy">
      <span class="pettt-kicker">Pettt Pro Platform</span>
      <h1><?php echo esc_html(get_theme_mod('hero_title','همه چیز برای حیوان خانگی شما')); ?></h1>
      <p><?php echo esc_html(get_theme_mod('hero_text','برندهای غذا، فروشگاه، دامپزشکی، پت‌شاپ، مقالات آموزشی، ویدیوها و پروفایل پت در یک پلتفرم حرفه‌ای.')); ?></p>
      <div class="pettt-hero-actions">
        <a class="pettt-primary" href="<?php echo esc_url(home_url('/shop')); ?>">ورود به فروشگاه</a>
        <a class="pettt-secondary" href="#pettt-services">دامپزشکی و پت‌شاپ‌ها</a>
      </div>
    </div>
    <div class="pettt-hero-poster">
      <div class="pettt-poster-card big">غذای پیشنهادی هوشمند</div>
      <div class="pettt-poster-card small one">برندهای ایرانی و خارجی</div>
      <div class="pettt-poster-card small two">ویدیو و مقاله آموزشی</div>
    </div>
  </div>
</section>

<section class="pettt-container pettt-slider-zone">
  <div class="pettt-slider-card">اسلایدر ۱: پیشنهادهای فروشگاه</div>
  <div class="pettt-slider-card">اسلایدر ۲: برندهای محبوب</div>
  <div class="pettt-slider-card">اسلایدر ۳: خدمات نزدیک شما</div>
</section>

<section class="pettt-container pettt-section">
  <div class="pettt-section-head"><h2>برندهای محبوب</h2><a href="<?php echo esc_url(get_post_type_archive_link('pettt_brand')); ?>">همه برندها</a></div>
  <div class="pettt-card-grid">
    <?php $q = pettt_query('pettt_brand', 8); while($q->have_posts()): $q->the_post(); ?>
      <a class="pettt-brand-card" href="<?php the_permalink(); ?>">
        <?php if(has_post_thumbnail()) the_post_thumbnail('medium'); else echo '<div class="pettt-placeholder">'.esc_html(mb_substr(get_the_title(),0,2)).'</div>'; ?>
        <h3><?php the_title(); ?></h3>
        <p><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_tier', 'برند پت')); ?></p>
      </a>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</section>

<?php if (class_exists('WooCommerce')): ?>
<section class="pettt-container pettt-section pettt-shop-section">
  <div class="pettt-section-head"><h2>فروشگاه Pettt</h2><a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">مشاهده فروشگاه</a></div>
  <?php echo do_shortcode('[products limit="4" columns="4" orderby="date"]'); ?>
</section>
<?php endif; ?>

<section id="pettt-services" class="pettt-container pettt-section">
  <div class="pettt-section-head"><h2>پت‌شاپ‌ها، دامپزشکی‌ها و آرایشگرها</h2><a href="<?php echo esc_url(get_post_type_archive_link('pettt_service')); ?>">همه خدمات</a></div>
  <div class="pettt-service-grid">
    <?php $s = pettt_query('pettt_service', 6); while($s->have_posts()): $s->the_post(); ?>
      <a class="pettt-service-card" href="<?php the_permalink(); ?>">
        <span><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_city', 'شهر')); ?></span>
        <h3><?php the_title(); ?></h3>
        <p><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_address', 'آدرس خدمت')); ?></p>
      </a>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</section>

<section class="pettt-container pettt-section pettt-learning-grid">
  <div>
    <div class="pettt-section-head"><h2>مقالات آموزشی</h2><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">همه مقالات</a></div>
    <?php $posts = new WP_Query(['post_type'=>'post','posts_per_page'=>3]); while($posts->have_posts()): $posts->the_post(); ?>
      <a class="pettt-list-item" href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong><span><?php echo esc_html(get_the_date()); ?></span></a>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
  <div>
    <div class="pettt-section-head"><h2>ویدیوهای آموزشی</h2><a href="<?php echo esc_url(get_post_type_archive_link('pettt_video')); ?>">همه ویدیوها</a></div>
    <?php $v = pettt_query('pettt_video', 3); while($v->have_posts()): $v->the_post(); ?>
      <a class="pettt-list-item video" href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong><span>نمایش ویدیو</span></a>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</section>

<section class="pettt-contact-band">
  <div class="pettt-container">
    <h2>برای همکاری با Pettt آماده‌ای؟</h2>
    <p>ثبت پت‌شاپ، دامپزشکی، برند غذا یا فروشگاه آنلاین خود را از طریق پنل مدیریت انجام بده.</p>
    <a class="pettt-primary" href="<?php echo esc_url(home_url('/contact')); ?>">تماس با ما</a>
  </div>
</section>

<?php get_footer(); ?>
