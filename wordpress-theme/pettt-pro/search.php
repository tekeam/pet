<?php get_header(); ?>
<section class="pettt-archive-hero search">
  <div class="pettt-container">
    <span class="pettt-kicker">Search</span>
    <h1>نتایج جستجو برای: <?php echo esc_html(get_search_query()); ?></h1>
    <p>جستجو در برندها، غذاها، مقالات، ویدیوها و خدمات Pettt.</p>
  </div>
</section>
<section class="pettt-container pettt-section">
  <form class="pettt-filter-bar" method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="دوباره جستجو کن...">
    <button type="submit">جستجو</button>
  </form>
  <div class="pettt-archive-grid">
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <article class="pettt-archive-card">
        <a href="<?php the_permalink(); ?>">
          <?php if(has_post_thumbnail()) the_post_thumbnail('medium_large'); ?>
          <div class="pettt-archive-body">
            <span><?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name ?? 'محتوا'); ?></span>
            <h2><?php the_title(); ?></h2>
            <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
          </div>
        </a>
      </article>
    <?php endwhile; else: ?>
      <p>نتیجه‌ای پیدا نشد.</p>
    <?php endif; ?>
  </div>
  <?php the_posts_pagination(); ?>
</section>
<?php get_footer(); ?>
