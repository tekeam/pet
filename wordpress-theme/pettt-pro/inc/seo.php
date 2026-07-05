<?php
if (!defined('ABSPATH')) { exit; }

add_action('wp_head', function () {
    if (is_admin()) return;
    $title = wp_get_document_title();
    $description = get_bloginfo('description');
    if (is_singular()) {
        global $post;
        $excerpt = has_excerpt($post) ? get_the_excerpt($post) : wp_trim_words(wp_strip_all_tags($post->post_content), 28);
        if ($excerpt) $description = $excerpt;
    }
    $url = is_singular() ? get_permalink() : home_url(add_query_arg([], $GLOBALS['wp']->request ?? ''));
    $image = '';
    if (is_singular() && has_post_thumbnail()) $image = get_the_post_thumbnail_url(get_the_ID(), 'large');
    echo "\n".'<meta name="description" content="'.esc_attr($description).'">' . "\n";
    echo '<meta property="og:title" content="'.esc_attr($title).'">' . "\n";
    echo '<meta property="og:description" content="'.esc_attr($description).'">' . "\n";
    echo '<meta property="og:url" content="'.esc_url($url).'">' . "\n";
    echo '<meta property="og:site_name" content="'.esc_attr(get_bloginfo('name')).'">' . "\n";
    echo '<meta property="og:locale" content="fa_IR">' . "\n";
    if ($image) echo '<meta property="og:image" content="'.esc_url($image).'">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}, 5);

add_action('wp_head', function () {
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => get_bloginfo('name'),
        'url' => home_url('/'),
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => home_url('/?s={search_term_string}'),
            'query-input' => 'required name=search_term_string'
        ]
    ];
    echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES).'</script>';

    if (is_singular(['pettt_brand','pettt_food','pettt_service','pettt_video','post'])) {
        $type = get_post_type();
        $map = ['pettt_brand'=>'Brand','pettt_food'=>'Product','pettt_service'=>'LocalBusiness','pettt_video'=>'VideoObject','post'=>'Article'];
        $single = [
            '@context'=>'https://schema.org',
            '@type'=>$map[$type] ?? 'Article',
            'name'=>get_the_title(),
            'url'=>get_permalink(),
            'description'=>wp_trim_words(wp_strip_all_tags(get_the_excerpt() ?: get_the_content()), 30)
        ];
        if (has_post_thumbnail()) $single['image'] = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if ($type === 'pettt_food') {
            $single['offers'] = ['@type'=>'Offer','price'=>pettt_meta(get_the_ID(), '_pettt_price', '0'),'url'=>pettt_meta(get_the_ID(), '_pettt_buy_url', get_permalink()),'availability'=>'https://schema.org/InStock'];
        }
        if ($type === 'pettt_service') {
            $single['address'] = pettt_meta(get_the_ID(), '_pettt_address', '');
            $single['telephone'] = pettt_meta(get_the_ID(), '_pettt_phone', '');
        }
        echo '<script type="application/ld+json">'.wp_json_encode($single, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES).'</script>';
    }
}, 30);

add_filter('document_title_parts', function($parts){
    if (is_post_type_archive('pettt_brand')) $parts['title'] = 'برندهای غذای حیوانات خانگی';
    if (is_post_type_archive('pettt_food')) $parts['title'] = 'کاتالوگ مدل‌های غذای پت';
    if (is_post_type_archive('pettt_service')) $parts['title'] = 'پت‌شاپ‌ها و دامپزشکی‌ها';
    if (is_post_type_archive('pettt_video')) $parts['title'] = 'ویدیوهای آموزشی پت';
    return $parts;
});
