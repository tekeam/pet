<?php
if (!defined('ABSPATH')) { exit; }

function ninjapet_problem_options() {
    return [
        'گوارشی'=>'مشکلات گوارشی، اسهال، حساسیت معده',
        'کلیوی'=>'بیماری کلیوی و نیاز به رژیم Renal',
        'ادراری'=>'مشکلات ادراری و سنگ/کریستال',
        'عقیم‌شده'=>'کنترل وزن و رژیم بعد از عقیم‌سازی',
        'کنترل وزن'=>'اضافه وزن و نیاز به غذای کم‌کالری',
        'حساسیت پوستی'=>'خارش، ریزش مو، پوست و موی حساس',
        'بچه گربه/توله'=>'رشد بچه گربه یا توله سگ',
        'سالمند'=>'پت سالمند و نیازهای سن بالا',
        'عمومی'=>'نیاز عمومی و تغذیه روزانه'
    ];
}

add_action('init', function(){
    foreach(array_keys(ninjapet_problem_options()) as $term){ if(!term_exists($term,'pettt_food_problem')) wp_insert_term($term,'pettt_food_problem'); }
});

function ninjapet_food_advisor_results($problem='', $pet_type='') {
    $tax_query = [];
    if($problem) $tax_query[] = ['taxonomy'=>'pettt_food_problem','field'=>'name','terms'=>[$problem]];
    $meta_query = [];
    if($pet_type) $meta_query[] = ['key'=>'_pettt_pet_type','value'=>$pet_type,'compare'=>'LIKE'];
    $args = ['post_type'=>'pettt_food','posts_per_page'=>18,'post_status'=>'publish'];
    if($tax_query) $args['tax_query']=$tax_query;
    if($meta_query) $args['meta_query']=$meta_query;
    $q = new WP_Query($args);
    if(!$q->have_posts() && $problem){ $q = new WP_Query(['post_type'=>'pettt_food','posts_per_page'=>18,'post_status'=>'publish','s'=>$problem]); }
    return $q;
}

add_shortcode('ninjapet_food_advisor', function(){
    $problem = sanitize_text_field($_GET['np_problem'] ?? '');
    $pet_type = sanitize_text_field($_GET['np_pet_type'] ?? '');
    ob_start(); ?>
    <section class="np-food-advisor">
      <div class="np-advisor-head"><h2>پیشنهاد غذا بر اساس مشکل پت</h2><p>نوع پت و مشکل یا نیاز اصلی را انتخاب کن تا غذاهای مرتبط نمایش داده شوند.</p></div>
      <form class="np-advisor-form" method="get">
        <label>نوع پت<select name="np_pet_type"><option value="">همه</option><option value="گربه" <?php selected($pet_type,'گربه'); ?>>گربه</option><option value="سگ" <?php selected($pet_type,'سگ'); ?>>سگ</option></select></label>
        <label>مشکل / نیاز<select name="np_problem"><option value="">همه نیازها</option><?php foreach(ninjapet_problem_options() as $key=>$desc): ?><option value="<?php echo esc_attr($key); ?>" <?php selected($problem,$key); ?>><?php echo esc_html($key); ?></option><?php endforeach; ?></select></label>
        <button class="pettt-primary">نمایش غذاهای پیشنهادی</button>
      </form>
      <?php if($problem): ?><div class="np-advisor-note"><strong><?php echo esc_html($problem); ?>:</strong> <?php echo esc_html(ninjapet_problem_options()[$problem] ?? ''); ?></div><?php endif; ?>
      <div class="np-advisor-grid">
        <?php $q=ninjapet_food_advisor_results($problem,$pet_type); if($q->have_posts()): while($q->have_posts()): $q->the_post(); ?>
          <a class="np-advisor-card" href="<?php the_permalink(); ?>">
            <?php if(has_post_thumbnail()) the_post_thumbnail('pettt-card'); else echo '<div class="pettt-placeholder">غذا</div>'; ?>
            <h3><?php the_title(); ?></h3>
            <p><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_brand_id', '')); ?></p>
            <span><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_price', '')); ?></span>
          </a>
        <?php endwhile; wp_reset_postdata(); else: ?><p>برای این فیلتر غذایی پیدا نشد.</p><?php endif; ?>
      </div>
    </section>
    <?php return ob_get_clean();
});

function ninjapet_pet_problems_checkboxes($selected=[]) {
    $selected = is_array($selected) ? $selected : array_filter(array_map('trim', explode(',', (string)$selected)));
    $html = '<div class="np-checkbox-grid">';
    foreach(ninjapet_problem_options() as $key=>$desc){ $html .= '<label><input type="checkbox" name="pet_problems[]" value="'.esc_attr($key).'" '.checked(in_array($key,$selected,true), true, false).'> '.esc_html($key).'</label>'; }
    return $html.'</div>';
}
