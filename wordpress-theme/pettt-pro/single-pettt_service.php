<?php get_header(); the_post(); ?>
<section class="pettt-container pettt-service-page">
  <article class="pettt-service-single">
    <span class="pettt-kicker"><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_city', '')); ?>، <?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_province', '')); ?></span>
    <h1><?php the_title(); ?></h1>
    <?php if(has_post_thumbnail()) the_post_thumbnail('large'); ?>
    <div class="pettt-service-info">
      <p><b>آدرس:</b> <?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_address', '')); ?></p>
      <p><b>تماس:</b> <?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_phone', '')); ?></p>
    </div>
    <div class="pettt-entry-text"><?php the_content(); ?></div>
  </article>
</section>
<?php get_footer(); ?>
