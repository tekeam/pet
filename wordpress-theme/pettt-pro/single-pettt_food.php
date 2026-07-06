<?php get_header(); the_post(); $food_id=get_the_ID(); $buy=pettt_meta($food_id, '_pettt_buy_url'); ?>
<section class="pettt-container pettt-single-food">
  <div class="pettt-food-layout">
    <div class="pettt-food-image"><?php if(has_post_thumbnail()) the_post_thumbnail('large'); else echo '<div class="pettt-placeholder">غذا</div>'; ?></div>
    <div class="pettt-food-info">
      <span class="pettt-kicker"><?php echo esc_html(pettt_meta($food_id, '_pettt_pet_type', 'غذای پت')); ?></span>
      <h1><?php the_title(); ?></h1>
      <div class="pettt-entry-text"><?php the_content(); ?></div>
      <div class="pettt-food-meta"><b>برند: <?php echo esc_html(pettt_meta($food_id, '_pettt_brand_id', 'ثبت نشده')); ?></b><b>قیمت حدودی: <?php echo esc_html(pettt_meta($food_id, '_pettt_price', 'ثبت نشده')); ?></b><span>مرحله زندگی: <?php echo esc_html(pettt_meta($food_id, '_pettt_life_stage', '')); ?></span></div>
      <?php if ($buy): ?><a class="pettt-primary" href="<?php echo esc_url($buy); ?>" target="_blank" rel="noopener">خرید محصول</a><?php else: ?><span class="pettt-secondary">لینک خرید هنوز ثبت نشده</span><?php endif; ?>
    </div>
  </div>
  <div class="pettt-food-tabs"><div><h2>جدول تغذیه</h2><p><?php echo wp_kses_post(nl2br(pettt_meta($food_id, '_pettt_feeding_table', 'ثبت نشده'))); ?></p></div><div><h2>آنالیز تضمینی</h2><p><?php echo wp_kses_post(nl2br(pettt_meta($food_id, '_pettt_analysis', 'ثبت نشده'))); ?></p></div></div>
  <section class="pettt-section np-food-fans"><h2>این غذا مورد علاقه کدام پت‌هاست؟</h2><div class="pettt-pet-list"><?php $users=get_users(['fields'=>'ID']); $found=0; foreach($users as $uid){ foreach(pettt_account_get_pets($uid) as $pet){ if(!empty($pet['food']) && (stripos($pet['food'], get_the_title())!==false || stripos(get_the_title(), $pet['food'])!==false || stripos(get_the_title(), pettt_meta($food_id,'_pettt_brand_id'))!==false)){ $found++; echo '<article class="pettt-pet-item">'.(!empty($pet['photo'])?'<img src="'.esc_url($pet['photo']).'" alt="'.esc_attr($pet['name']).'">':'').'<div><h3>'.esc_html($pet['name']).'</h3><p>'.esc_html(($pet['type'] ?? '').' | '.($pet['breed'] ?? '')).'</p><span>غذای محبوب: '.esc_html($pet['food']).'</span></div></article>'; } } } if(!$found) echo '<p>هنوز پتی برای این غذا ثبت نشده است.</p>'; ?></div></section>
</section>
<?php get_footer(); ?>
