<?php
if (!defined('ABSPATH')) { exit; }

function ninjapet_contact_phone(){ return pettt_setting('phone', '02191303284'); }
function ninjapet_contact_email(){ return pettt_setting('email', 'Info@ninjapet.ir'); }
function ninjapet_brand_name(){ return pettt_setting('brand_name', 'NinjaPet'); }
function ninjapet_brand_name_fa(){ return pettt_setting('brand_name_fa', 'نینجا پت'); }

add_action('wp_head', function(){
    $font_url = esc_url(pettt_setting('custom_font_url', ''));
    $font_family = sanitize_text_field(pettt_setting('custom_font_family', 'NinjaPetFont'));
    if ($font_url) echo '<style id="ninjapet-custom-font">@font-face{font-family:"'.esc_attr($font_family).'";src:url("'.$font_url.'") format("woff2");font-display:swap}:root{--np-font:"'.esc_attr($font_family).'", Vazirmatn, sans-serif}body,button,input,select,textarea{font-family:var(--np-font)}</style>';
    $accent = esc_attr(pettt_setting('accent_color', '#5B45F5'));
    $dark = esc_attr(pettt_setting('dark_color', '#080A12'));
    echo '<style id="ninjapet-theme-vars">:root{--np-black:'.$dark.';--np-purple:'.$accent.';--np-soft:#EEEAFE;--np-pink:#F8B8C8;--np-mint:#A7D7C5;--np-bg:#FBFAFF;--np-text:#252733}.np-logo img,.np-footer-brand img{height:54px;width:auto;max-width:190px;display:block}.np-footer-brand img{height:72px;margin:auto}.custom-logo-link img{max-height:58px;width:auto}.pettt-brand-card{overflow:hidden}.pettt-brand-card img{object-fit:contain!important;background:#fff;padding:18px;max-height:150px}</style>';
}, 8);

function ninjapet_logo_html($class='ninjapet-logo'){
    if (has_custom_logo()) return get_custom_logo();
    $src = get_template_directory_uri() . '/assets/img/ninjapet-logo.svg';
    return '<a class="'.esc_attr($class).'" href="'.esc_url(home_url('/')).'"><img src="'.esc_url($src).'" alt="NinjaPet" loading="eager"></a>';
}

add_action('wp_body_open', function(){
    if (!pettt_setting('announcement_enabled')) return;
    $text = pettt_setting('announcement_text', ''); if (!$text) return;
    $bg = esc_attr(pettt_setting('announcement_bg', '#EEEAFE'));
    $color = esc_attr(pettt_setting('announcement_color', '#080A12'));
    $size = esc_attr(pettt_setting('announcement_size', '14'));
    $icon = esc_attr(pettt_setting('announcement_icon', 'fa-solid fa-paw'));
    $image = esc_url(pettt_setting('announcement_image', ''));
    echo '<div class="np-announcement" style="background:'.$bg.';color:'.$color.';font-size:'.$size.'px"><div class="pettt-container"><i class="'.esc_attr($icon).'"></i>';
    if($image) echo '<img src="'.$image.'" alt="اعلان">';
    echo '<span>'.wp_kses_post($text).'</span></div></div>';
}, 5);
