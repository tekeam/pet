<?php get_header(); ?>
<section class="pettt-archive-hero">
  <div class="pettt-container">
    <span class="pettt-kicker">Pet Food Brands</span>
    <h1>برندهای غذای حیوانات خانگی</h1>
    <p>برندهای ایرانی و خارجی، تاریخچه، مدل‌ها، محصولات و لینک خرید هر غذا.</p>
  </div>
</section>
<section class="pettt-container pettt-section">
  <form class="pettt-filter-bar" method="get">
    <input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="جستجوی برند...">
    <button type="submit">جستجو</button>
  </form>
  <div class="pettt-card-grid pettt-archive-list">
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <a class="pettt-brand-card" href="<?php the_permalink(); ?>">
        <?php if(has_post_thumbnail()) the_post_thumbnail('medium_large'); else echo '<div class="pettt-placeholder">'.esc_html(mb_substr(get_the_title(),0,2)).'</div>'; ?>
        <h3><?php the_title(); ?></h3>
        <p><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_tier', 'برند پت')); ?></p>
        <span><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_country', '')); ?></span>
      </a>
    <?php endwhile; else: ?>
      <p>برندی پیدا نشد.</p>
    <?php endif; ?>
  </div>
  <?php the_posts_pagination(); ?>
</section>
<?php get_footer(); ?>
