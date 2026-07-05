<?php get_header(); the_post(); ?>
<section class="pettt-container pettt-explore-single">
  <article class="pettt-explore-single-card">
    <?php if(has_post_thumbnail()) the_post_thumbnail('large'); ?>
    <div class="pettt-explore-single-body">
      <span><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_pet_breed', 'پت')); ?></span>
      <h1><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_pet_name', get_the_title())); ?></h1>
      <p class="pettt-food-line">غذای محبوب: <?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_pet_food', 'ثبت نشده')); ?></p>
      <div class="pettt-entry-text"><?php the_content(); ?></div>
      <button class="pettt-like-btn big" data-post="<?php echo esc_attr(get_the_ID()); ?>">♥ <b><?php echo esc_html((int)get_post_meta(get_the_ID(), '_pettt_likes', true)); ?></b> لایک</button>
    </div>
  </article>
  <?php if (comments_open() || get_comments_number()) comments_template(); ?>
</section>
<?php get_footer(); ?>
