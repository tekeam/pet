<?php if (!defined('ABSPATH')) { exit; } ?>
<section class="pettt-hero-pro advanced">
  <div class="pettt-container pettt-hero-grid advanced">
    <div class="pettt-hero-copy">
      <span class="pettt-kicker">NinjaPet Platform</span>
      <h1><?php echo esc_html(pettt_setting('hero_title','نینجا پت، راهنمای هوشمند دنیای حیوانات خانگی')); ?></h1>
      <p><?php echo esc_html(pettt_setting('hero_text','غذای مناسب پتت را پیدا کن، برندها را مقایسه کن و مراکز معتبر مرتبط با حیوانات خانگی را در شهر خودت ببین.')); ?></p>
      <form class="pettt-home-search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="search" name="s" placeholder="جستجو در برند، غذا، مقاله، ویدیو و مراکز پت...">
        <button type="submit">جستجو</button>
      </form>
      <div class="pettt-hero-actions">
        <a class="pettt-primary" href="<?php echo esc_url(get_post_type_archive_link('pettt_food')); ?>">پیدا کردن غذای مناسب</a>
        <a class="pettt-secondary" href="<?php echo esc_url(get_post_type_archive_link('pettt_service')); ?>">مشاهده مراکز پت</a>
      </div>
      <div class="pettt-hero-stats">
        <div><strong><?php echo esc_html(wp_count_posts('pettt_food')->publish ?? 0); ?></strong><span>مدل غذا</span></div>
        <div><strong><?php echo esc_html(wp_count_posts('pettt_brand')->publish ?? 0); ?></strong><span>برند غذا</span></div>
        <div><strong><?php echo esc_html(wp_count_posts('pettt_service')->publish ?? 0); ?></strong><span>مرکز پت</span></div>
      </div>
    </div>
    <div class="pettt-hero-poster"><div class="pettt-pet-orbit one">🐱‍👤 پیشنهاد غذای هوشمند</div><div class="pettt-pet-orbit two">🐶 مراکز معتبر پت</div><div class="pettt-pet-orbit three">🐾 اکسپلور پت‌ها</div></div>
  </div>
</section>
<section class="pettt-container pettt-feature-row"><div class="pettt-feature"><b>01</b><h3>پیشنهاد غذا</h3><p>بر اساس وزن، بیماری، سن، نژاد و غذای محبوب.</p></div><div class="pettt-feature"><b>02</b><h3>بررسی برندها</h3><p>برندهای غذای ایرانی و خارجی را دقیق‌تر بشناس.</p></div><div class="pettt-feature"><b>03</b><h3>مراکز پت شهر شما</h3><p>پت‌شاپ، دامپزشکی، آرایشگر حیوانات و پانسیون.</p></div><div class="pettt-feature"><b>04</b><h3>اکسپلور</h3><p>پست کاربران، لایک، کامنت و اجتماع پت‌ها.</p></div></section>
<section class="pettt-container pettt-section"><div class="pettt-section-head"><h2>برندهای غذای پت</h2><a href="<?php echo esc_url(get_post_type_archive_link('pettt_brand')); ?>">همه برندها</a></div><div class="pettt-card-grid"><?php $q=pettt_query('pettt_brand',8); while($q->have_posts()): $q->the_post(); ?><a class="pettt-brand-card" href="<?php the_permalink(); ?>"><?php if(has_post_thumbnail()) the_post_thumbnail('pettt-card'); else echo '<div class="pettt-placeholder">'.esc_html(mb_substr(get_the_title(),0,2)).'</div>'; ?><h3><?php the_title(); ?></h3><p><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_tier', 'برند پت')); ?></p></a><?php endwhile; wp_reset_postdata(); ?></div></section>
<section class="pettt-container pettt-section"><div class="pettt-section-head"><h2>راهنمای مراکز پت در شهر شما</h2><a href="<?php echo esc_url(get_post_type_archive_link('pettt_service')); ?>">همه مراکز</a></div><p class="np-section-subtitle">پت‌شاپ‌ها، دامپزشکی‌ها، آرایشگرهای حیوانات و پانسیون‌های مرتبط با این حوزه را بر اساس شهر و استان پیدا کن.</p><div class="pettt-service-grid pro"><?php $s=pettt_query('pettt_service',6); while($s->have_posts()): $s->the_post(); ?><article class="pettt-service-card pro"><a class="pettt-service-card-image" href="<?php the_permalink(); ?>"><?php if(has_post_thumbnail()) the_post_thumbnail('pettt-card'); else echo '<div class="pettt-placeholder">'.esc_html(mb_substr(get_the_title(),0,2)).'</div>'; ?></a><div class="pettt-service-card-body"><span><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_city', 'شهر')); ?></span><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><p><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_address', 'آدرس خدمت')); ?></p></div></article><?php endwhile; wp_reset_postdata(); ?></div></section>
<section class="pettt-container pettt-section pettt-learning-grid"><div><div class="pettt-section-head"><h2>مقالات آموزشی</h2><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">همه مقالات</a></div><?php $posts=new WP_Query(['post_type'=>'post','posts_per_page'=>3]); while($posts->have_posts()): $posts->the_post(); ?><a class="pettt-list-item" href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong><span><?php echo esc_html(get_the_date()); ?></span></a><?php endwhile; wp_reset_postdata(); ?></div><div><div class="pettt-section-head"><h2>ویدیوهای آموزشی</h2><a href="<?php echo esc_url(get_post_type_archive_link('pettt_video')); ?>">همه ویدیوها</a></div><?php $v=pettt_query('pettt_video',3); while($v->have_posts()): $v->the_post(); ?><a class="pettt-list-item video" href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong><span>نمایش ویدیو</span></a><?php endwhile; wp_reset_postdata(); ?></div></section>
