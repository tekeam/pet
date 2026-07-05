<?php get_header(); ?>
<section class="pettt-archive-hero food">
  <div class="pettt-container">
    <span class="pettt-kicker">Food Catalog</span>
    <h1>کاتالوگ مدل‌های غذا</h1>
    <p>بررسی غذاها بر اساس برند، نیاز پت، قیمت حدودی، جدول تغذیه و لینک خرید.</p>
  </div>
</section>
<section class="pettt-container pettt-section">
  <form class="pettt-filter-bar" method="get">
    <input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="جستجوی مدل غذا، برند یا مشکل...">
    <button type="submit">جستجو</button>
  </form>
  <div class="pettt-card-grid pettt-archive-list">
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <article class="pettt-food-card">
        <a href="<?php the_permalink(); ?>">
          <?php if(has_post_thumbnail()) the_post_thumbnail('medium_large'); ?>
          <h3><?php the_title(); ?></h3>
          <p><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_brand_id', '')); ?></p>
        </a>
        <div class="pettt-card-actions">
          <strong><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_price', 'قیمت ثبت نشده')); ?></strong>
          <?php if($buy = pettt_meta(get_the_ID(), '_pettt_buy_url')): ?><a href="<?php echo esc_url($buy); ?>" target="_blank" rel="noopener">خرید</a><?php endif; ?>
        </div>
      </article>
    <?php endwhile; else: ?>
      <p>مدل غذایی پیدا نشد.</p>
    <?php endif; ?>
  </div>
  <?php the_posts_pagination(); ?>
</section>
<?php get_footer(); ?>
