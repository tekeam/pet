<?php get_header(); ?>

<section class="pettt-archive-hero search">
  <div class="pettt-container">
    <span class="pettt-kicker">NinjaPet Blog</span>
    <h1><?php echo esc_html(get_the_title(get_option('page_for_posts')) ?: 'وبلاگ نینجا پت'); ?></h1>
    <p>مقالات آموزشی، راهنمای غذا، نگهداری و سلامت حیوانات خانگی.</p>
  </div>
</section>

<section class="pettt-container pettt-section">
  <?php if (have_posts()) : ?>
    <div class="pettt-archive-grid">
      <?php while (have_posts()) : the_post(); ?>
        <article class="pettt-archive-card">
          <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) the_post_thumbnail('medium_large'); ?>
            <div class="pettt-archive-body">
              <span><?php echo esc_html(get_the_date()); ?></span>
              <h2><?php the_title(); ?></h2>
              <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
            </div>
          </a>
        </article>
      <?php endwhile; ?>
    </div>
    <?php the_posts_pagination(); ?>
  <?php else : ?>
    <p>هنوز مقاله‌ای منتشر نشده است.</p>
  <?php endif; ?>
</section>

<?php get_footer(); ?>
