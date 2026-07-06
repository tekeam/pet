<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <main id="primary" class="ninjapet-page pettt-container pettt-section" role="main">
    <?php if (!ninjapet_is_elementor_built_page(get_the_ID())) : ?>
      <header class="ninjapet-page-header"><h1><?php the_title(); ?></h1></header>
    <?php endif; ?>
    <div class="ninjapet-page-content"><?php the_content(); ?></div>
  </main>
<?php endwhile; else : ?>
  <main class="pettt-container pettt-section"><p>صفحه‌ای پیدا نشد.</p></main>
<?php endif; ?>

<?php get_footer(); ?>
