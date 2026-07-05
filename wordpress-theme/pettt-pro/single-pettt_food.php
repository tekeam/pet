<?php get_header(); the_post(); ?>
<section class="pettt-container pettt-single-food">
  <div class="pettt-food-layout">
    <div class="pettt-food-image"><?php if(has_post_thumbnail()) the_post_thumbnail('large'); ?></div>
    <div class="pettt-food-info">
      <span class="pettt-kicker"><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_pet_type', 'غذای پت')); ?></span>
      <h1><?php the_title(); ?></h1>
      <p><?php the_content(); ?></p>
      <div class="pettt-food-meta">
        <b>قیمت حدودی: <?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_price', 'ثبت نشده')); ?></b>
        <span>مرحله زندگی: <?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_life_stage', '')); ?></span>
      </div>
      <?php if ($url = pettt_meta(get_the_ID(), '_pettt_buy_url')): ?>
        <a class="pettt-primary" href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener">خرید محصول</a>
      <?php endif; ?>
    </div>
  </div>
  <div class="pettt-food-tabs">
    <div><h2>جدول تغذیه</h2><p><?php echo wp_kses_post(nl2br(pettt_meta(get_the_ID(), '_pettt_feeding_table', 'ثبت نشده'))); ?></p></div>
    <div><h2>آنالیز تضمینی</h2><p><?php echo wp_kses_post(nl2br(pettt_meta(get_the_ID(), '_pettt_analysis', 'ثبت نشده'))); ?></p></div>
  </div>
</section>
<?php get_footer(); ?>
