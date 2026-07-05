<?php
if (!defined('ABSPATH')) { exit; }

function pettt_get_recommended_food_posts($pet = [], $limit = 4) {
    $limit = max(1, (int)$limit);
    $meta_query = [];
    $tax_query = [];

    if (!empty($pet['food'])) {
        $meta_query[] = ['key'=>'_pettt_brand_id','value'=>sanitize_text_field($pet['food']),'compare'=>'LIKE'];
    }
    if (!empty($pet['disease'])) {
        $tax_query[] = ['taxonomy'=>'pettt_food_problem','field'=>'name','terms'=>array_map('trim', explode(',', $pet['disease'])),'operator'=>'IN'];
    }

    $args = ['post_type'=>'pettt_food','posts_per_page'=>$limit,'post_status'=>'publish'];
    if ($meta_query) $args['meta_query'] = $meta_query;
    if ($tax_query) $args['tax_query'] = $tax_query;

    $q = new WP_Query($args);
    if ($q->have_posts()) return $q;

    return new WP_Query(['post_type'=>'pettt_food','posts_per_page'=>$limit,'post_status'=>'publish']);
}

function pettt_get_recommended_wc_products($pet = [], $limit = 4) {
    if (!class_exists('WooCommerce')) return new WP_Query(['post__in'=>[0]]);
    $keyword = '';
    if (!empty($pet['food'])) $keyword = sanitize_text_field($pet['food']);
    elseif (!empty($pet['disease'])) $keyword = sanitize_text_field($pet['disease']);
    $args = ['post_type'=>'product','posts_per_page'=>$limit,'post_status'=>'publish'];
    if ($keyword) $args['s'] = $keyword;
    $q = new WP_Query($args);
    if ($q->have_posts()) return $q;
    return new WP_Query(['post_type'=>'product','posts_per_page'=>$limit,'post_status'=>'publish']);
}

function pettt_render_recommendations_for_pet($pet) {
    $limit = (int) pettt_setting('recommendation_count', 4);
    $title = pettt_setting('recommendation_title', 'غذاهای پیشنهادی برای پت شما');
    ob_start();
    ?>
    <section class="pettt-account-card pettt-profile-recommendations">
      <h2><?php echo esc_html($title); ?></h2>
      <p>بر اساس بیماری/حساسیت و غذای محبوب ثبت‌شده در پروفایل پت.</p>
      <div class="pettt-recommend-grid">
        <?php $foods = pettt_get_recommended_food_posts($pet, $limit); while($foods->have_posts()): $foods->the_post(); ?>
          <a class="pettt-mini-food" href="<?php the_permalink(); ?>">
            <?php if(has_post_thumbnail()) the_post_thumbnail('medium'); ?>
            <strong><?php the_title(); ?></strong>
            <span><?php echo esc_html(pettt_meta(get_the_ID(), '_pettt_price', '')); ?></span>
          </a>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
      <?php if (class_exists('WooCommerce')): ?>
        <h3>محصولات فروشگاه مرتبط</h3>
        <div class="pettt-recommend-grid">
          <?php $products = pettt_get_recommended_wc_products($pet, $limit); while($products->have_posts()): $products->the_post(); global $product; ?>
            <a class="pettt-mini-food" href="<?php the_permalink(); ?>">
              <?php if(has_post_thumbnail()) the_post_thumbnail('medium'); ?>
              <strong><?php the_title(); ?></strong>
              <span><?php echo $product ? wp_kses_post($product->get_price_html()) : ''; ?></span>
            </a>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
      <?php endif; ?>
    </section>
    <?php
    return ob_get_clean();
}

add_shortcode('pettt_recommendations', function($atts){
    if (!is_user_logged_in()) return '<p>برای دیدن پیشنهادهای اختصاصی وارد شوید.</p>';
    $pets = pettt_account_get_pets(get_current_user_id());
    $pet = $pets[0] ?? [];
    return pettt_render_recommendations_for_pet($pet);
});
