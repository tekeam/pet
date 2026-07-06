<?php get_header(); ?>

<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <main id="primary" class="ninjapet-elementor-page" role="main">
      <?php the_content(); ?>
    </main>
    <?php
    $ninjapet_has_builder = ninjapet_is_elementor_built_page(get_the_ID()) || ninjapet_is_elementor_editor_context();
    $ninjapet_has_content = trim(get_the_content(null, false, get_the_ID())) !== '';
    if (!$ninjapet_has_builder && !$ninjapet_has_content) {
        get_template_part('template-parts/home-default');
    }
    ?>
  <?php endwhile; ?>
<?php else : ?>
  <?php get_template_part('template-parts/home-default'); ?>
<?php endif; ?>

<?php get_footer(); ?>
