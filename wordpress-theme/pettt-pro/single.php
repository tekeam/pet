<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <main id="primary" class="ninjapet-single pettt-container pettt-section" role="main">
    <article class="ninjapet-single-article">
      <?php if (has_post_thumbnail()) : ?><div class="ninjapet-single-cover"><?php the_post_thumbnail('large'); ?></div><?php endif; ?>
      <header class="ninjapet-single-header">
        <span class="pettt-kicker"><?php echo esc_html(get_the_date()); ?></span>
        <h1><?php the_title(); ?></h1>
      </header>
      <div class="ninjapet-single-content"><?php the_content(); ?></div>
      <?php wp_link_pages(['before'=>'<div class="page-links">','after'=>'</div>']); ?>
    </article>
    <?php if (comments_open() || get_comments_number()) comments_template(); ?>
  </main>
<?php endwhile; else : ?>
  <main class="pettt-container pettt-section"><p>مقاله‌ای پیدا نشد.</p></main>
<?php endif; ?>

<?php get_footer(); ?>
