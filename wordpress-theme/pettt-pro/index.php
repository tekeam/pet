<?php get_header(); ?>
<section class="pettt-container pettt-section pettt-archive">
  <div class="pettt-section-head"><h1><?php wp_title(''); ?></h1></div>
  <div class="pettt-archive-grid">
    <?php if (have_posts()): while(have_posts()): the_post(); ?>
      <article <?php post_class('pettt-archive-card'); ?>>
        <a href="<?php the_permalink(); ?>">
          <?php if(has_post_thumbnail()) the_post_thumbnail('large'); ?>
          <div class="pettt-archive-body">
            <h2><?php the_title(); ?></h2>
            <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
          </div>
        </a>
      </article>
    <?php endwhile; the_posts_pagination(); else: ?>
      <p>محتوایی پیدا نشد.</p>
    <?php endif; ?>
  </div>
</section>
<?php get_footer(); ?>
