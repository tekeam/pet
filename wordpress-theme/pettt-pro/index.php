<?php get_header(); ?>

<section class="pettt-container pettt-section pettt-archive">
  <div class="pettt-section-head"><h1><?php echo esc_html(get_the_archive_title() ?: 'مطالب نینجا پت'); ?></h1></div>
  <?php if (have_posts()) : ?>
    <div class="pettt-archive-grid">
      <?php while (have_posts()) : the_post(); ?>
        <article class="pettt-archive-card">
          <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) the_post_thumbnail('medium_large'); ?>
            <div class="pettt-archive-body">
              <h2><?php the_title(); ?></h2>
              <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
            </div>
          </a>
        </article>
      <?php endwhile; ?>
    </div>
    <?php the_posts_pagination(); ?>
  <?php else : ?>
    <p>محتوایی پیدا نشد.</p>
  <?php endif; ?>
</section>

<?php get_footer(); ?>
