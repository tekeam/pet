<?php get_header(); the_post(); ?>
<section class="pettt-container pettt-single-brand">
  <div class="pettt-brand-hero">
    <div><?php if(has_post_thumbnail()) the_post_thumbnail('large'); ?></div>
    <div>
      <span class="pettt-kicker"><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_tier', 'برند پت')); ?></span>
      <h1><?php the_title(); ?></h1>
      <p><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_country', '')); ?></p>
      <div class="pettt-entry-text"><?php the_content(); ?></div>
    </div>
  </div>
  <div class="pettt-section">
    <h2>تاریخچه برند</h2>
    <p><?php echo wp_kses_post(nl2br(pettt_meta(get_the_ID(), '_pettt_history', 'تاریخچه‌ای ثبت نشده است.'))); ?></p>
  </div>
  <div class="pettt-section">
    <h2>مدل‌های غذا</h2>
    <div class="pettt-chip-list">
      <?php foreach (array_filter(array_map('trim', explode("\n", pettt_meta(get_the_ID(), '_pettt_models', '')))) as $model): ?>
        <span><?php echo esc_html($model); ?></span>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="pettt-section">
    <h2>غذاهای مرتبط</h2>
    <div class="pettt-card-grid">
      <?php $foods = new WP_Query(['post_type'=>'pettt_food','posts_per_page'=>8,'meta_query'=>[['key'=>'_pettt_brand_id','value'=>get_the_title(),'compare'=>'LIKE']]]); while($foods->have_posts()): $foods->the_post(); ?>
        <a class="pettt-food-card" href="<?php the_permalink(); ?>"><?php if(has_post_thumbnail()) the_post_thumbnail('medium'); ?><h3><?php the_title(); ?></h3><p><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_price', '')); ?></p></a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
