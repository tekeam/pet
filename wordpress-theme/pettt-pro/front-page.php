<?php get_header(); ?>

<section class="pettt-hero-pro advanced">
  <div class="pettt-container pettt-hero-grid advanced">
    <div class="pettt-hero-copy">
      <span class="pettt-kicker">Pettt Pro Platform</span>
      <h1><?php echo esc_html(pettt_setting('hero_title', get_theme_mod('hero_title','پلتفرم هوشمند حیوانات خانگی'))); ?></h1>
      <p><?php echo esc_html(pettt_setting('hero_text', get_theme_mod('hero_text','غذا، فروشگاه، دامپزشکی، پت‌شاپ، مقالات آموزشی، ویدیوها، اکسپلور و پروفایل پت در یک تجربه حرفه‌ای.'))); ?></p>
      <form class="pettt-home-search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="search" name="s" placeholder="جستجو در برند، غذا، مقاله، ویدیو و خدمات...">
        <button type="submit">جستجو</button>
      </form>
      <div class="pettt-hero-actions">
        <a class="pettt-primary" href="<?php echo esc_url(pettt_setting('hero_cta_url', home_url('/shop'))); ?>"><?php echo esc_html(pettt_setting('hero_cta', 'ورود به فروشگاه')); ?></a>
        <a class="pettt-secondary" href="<?php echo esc_url(home_url('/pettt-account')); ?>">ساخت پروفایل پت</a>
      </div>
      <div class="pettt-hero-stats"><div><strong>+۱۲۰</strong><span>مدل غذا</span></div><div><strong>+۳۰</strong><span>برند پت</span></div><div><strong>+۵۰</strong><span>خدمت شهری</span></div></div>
    </div>
    <div class="pettt-hero-poster">
      <div class="pettt-pet-orbit one">پیشنهاد غذای هوشمند</div>
      <div class="pettt-pet-orbit two">فروشگاه تخصصی پت</div>
      <div class="pettt-pet-orbit three">اکسپلور پت‌ها</div>
    </div>
  </div>
</section>

<section class="pettt-container pettt-feature-row">
  <div class="pettt-feature"><b>01</b><h3>پیشنهاد غذا</h3><p>بر اساس وزن، بیماری، سن، نژاد و غذای محبوب.</p></div>
  <div class="pettt-feature"><b>02</b><h3>فروشگاه</h3><p>متصل به WooCommerce، سبد خرید و درگاه پرداخت.</p></div>
  <div class="pettt-feature"><b>03</b><h3>خدمات شهری</h3><p>دامپزشکی، پت‌شاپ و آرایشگر بر اساس شهر.</p></div>
  <div class="pettt-feature"><b>04</b><h3>اکسپلور</h3><p>پست کاربران، لایک، کامنت و اجتماع پت‌ها.</p></div>
</section>

<section class="pettt-container pettt-section dark">
  <div class="pettt-section-head"><h2>اسلایدرهای اصلی</h2><a href="<?php echo esc_url(home_url('/shop')); ?>">مشاهده فروشگاه</a></div>
  <div class="pettt-showcase-grid">
    <a class="pettt-showcase-card" href="<?php echo esc_url(home_url('/shop')); ?>"><h3>پیشنهادهای فروشگاه</h3><p>غذاهای پرفروش و محصولات ویژه.</p></a>
    <a class="pettt-showcase-card" href="<?php echo esc_url(get_post_type_archive_link('pettt_brand')); ?>"><h3>برندهای محبوب</h3><p>ایرانی و خارجی، درمانی و اقتصادی.</p></a>
    <a class="pettt-showcase-card" href="<?php echo esc_url(get_post_type_archive_link('pettt_service')); ?>"><h3>خدمات نزدیک شما</h3><p>بر اساس استان و شهر انتخابی.</p></a>
  </div>
</section>

<section class="pettt-container pettt-section">
  <div class="pettt-section-head"><h2>برندهای محبوب</h2><a href="<?php echo esc_url(get_post_type_archive_link('pettt_brand')); ?>">همه برندها</a></div>
  <div class="pettt-card-grid">
    <?php $q = pettt_query('pettt_brand', 8); while($q->have_posts()): $q->the_post(); ?>
      <a class="pettt-brand-card" href="<?php the_permalink(); ?>">
        <?php if(has_post_thumbnail()) the_post_thumbnail('pettt-card'); else echo '<div class="pettt-placeholder">'.esc_html(mb_substr(get_the_title(),0,2)).'</div>'; ?>
        <h3><?php the_title(); ?></h3><p><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_tier', 'برند پت')); ?></p>
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

<section class="pettt-container pettt-section">
  <div class="pettt-section-head"><h2>اکسپلور پت‌ها</h2><a href="<?php echo esc_url(get_post_type_archive_link('pettt_explore')); ?>">دیدن اکسپلور</a></div>
  <?php echo do_shortcode('[pettt_explore_feed]'); ?>
</section>

<section id="pettt-services" class="pettt-container pettt-section">
  <div class="pettt-section-head"><h2>پت‌شاپ‌ها، دامپزشکی‌ها و آرایشگرها</h2><a href="<?php echo esc_url(get_post_type_archive_link('pettt_service')); ?>">همه خدمات</a></div>
  <div class="pettt-service-grid">
    <?php $s = pettt_query('pettt_service', 6); while($s->have_posts()): $s->the_post(); ?>
      <a class="pettt-service-card" href="<?php the_permalink(); ?>"><span><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_city', 'شهر')); ?></span><h3><?php the_title(); ?></h3><p><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_address', 'آدرس خدمت')); ?></p></a>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</section>

<section class="pettt-container pettt-section pettt-learning-grid">
  <div><div class="pettt-section-head"><h2>مقالات آموزشی</h2><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">همه مقالات</a></div><?php $posts = new WP_Query(['post_type'=>'post','posts_per_page'=>3]); while($posts->have_posts()): $posts->the_post(); ?><a class="pettt-list-item" href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong><span><?php echo esc_html(get_the_date()); ?></span></a><?php endwhile; wp_reset_postdata(); ?></div>
  <div><div class="pettt-section-head"><h2>ویدیوهای آموزشی</h2><a href="<?php echo esc_url(get_post_type_archive_link('pettt_video')); ?>">همه ویدیوها</a></div><?php $v = pettt_query('pettt_video', 3); while($v->have_posts()): $v->the_post(); ?><a class="pettt-list-item video" href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong><span>نمایش ویدیو</span></a><?php endwhile; wp_reset_postdata(); ?></div>
</section>

<section class="pettt-contact-band"><div class="pettt-container"><h2>برای همکاری با Pettt آماده‌ای؟</h2><p>ثبت پت‌شاپ، دامپزشکی، برند غذا یا فروشگاه آنلاین خود را از پنل مدیریت انجام بده.</p><a class="pettt-primary" href="<?php echo esc_url(home_url('/contact')); ?>">تماس با ما</a></div></section>

<?php get_footer(); ?>
