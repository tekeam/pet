<?php
if (!defined('ABSPATH')) { exit; }

function ninjapet_catalog_dataset() {
    return [
        'Royal Canin'=>['fa'=>'رویال کنین','country'=>'فرانسه','tier'=>'سوپرپرمیوم / درمانی','models'=>['Gastrointestinal Cat','Renal Cat','Urinary S/O Cat','Sterilised Cat','Kitten','Mother & Babycat','Hairball Care','Digestive Care','Indoor Cat','Light Weight Care','Gastrointestinal Dog','Renal Dog','Mini Adult','Medium Adult','Maxi Adult','Hypoallergenic Dog']],
        'Josera'=>['fa'=>'جوسرا','country'=>'آلمان','tier'=>'پرمیوم','models'=>['Catelux','Culinesse','SensiCat','Marinesse','Kitten','NatureCat','DailyCat','Festival Dog','SensiPlus Dog','Miniwell Dog','Optiness Dog','High Energy Dog']],
        'Happy Cat'=>['fa'=>'هپی کت','country'=>'آلمان','tier'=>'پرمیوم','models'=>['Adult Indoor','Adult Sterilised','Sensitive Stomach & Intestine','Sensitive Skin & Coat','Kitten Poultry','Junior Grainfree','Minkas Kitten','Minkas Urinary','Minkas Hairball']],
        'Happy Dog'=>['fa'=>'هپی داگ','country'=>'آلمان','tier'=>'پرمیوم','models'=>['Mini Adult','Medium Adult','Maxi Adult','Sensible Mini','Sensible Ireland','Sensible Toscana','Supreme Fit & Vital','Junior Original','Puppy Lamb & Rice']],
        'Purina Pro Plan'=>['fa'=>'پروپلن','country'=>'آمریکا','tier'=>'سوپرپرمیوم','models'=>['Sterilised Cat Salmon','Adult Cat Chicken','Kitten Chicken','Delicate Cat Turkey','LiveClear Cat','Medium Adult Dog','Small Mini Adult Dog','Large Robust Dog','Puppy Chicken','Sensitive Skin Dog']],
        'Purina One'=>['fa'=>'پورینا وان','country'=>'آمریکا','tier'=>'پرمیوم','models'=>['Adult Cat Chicken','Sterilcat','Indoor Formula','Junior Cat','Sensitive Cat','Adult Dog Chicken','Mini Dog']],
        'Whiskas'=>['fa'=>'ویسکاس','country'=>'تایلند','tier'=>'اقتصادی','models'=>['Adult Chicken','Adult Tuna','Kitten Chicken','Sterile Cat','Hairball Control','Indoor Cat']],
        'Friskies'=>['fa'=>'فریسکیز','country'=>'آمریکا','tier'=>'اقتصادی','models'=>['Adult Cat Seafood','Adult Cat Chicken','Kitten','Indoor Cat','Adult Dog Beef','Adult Dog Chicken']],
        'Taste of the Wild'=>['fa'=>'تیست آف د وایلد','country'=>'آمریکا','tier'=>'سوپرپرمیوم','models'=>['Rocky Mountain Feline','Canyon River Feline','High Prairie Puppy','High Prairie Canine','Pacific Stream Canine','Wetlands Canine','Sierra Mountain Canine']],
        'Reflex'=>['fa'=>'رفلکس','country'=>'ترکیه','tier'=>'اقتصادی / پرمیوم','models'=>['Adult Cat Chicken','Adult Cat Salmon','Kitten Chicken','Sterilised Cat','Urinary Cat','Hairball Cat','Adult Dog Lamb & Rice','Adult Dog Chicken','Puppy Dog','Mini Adult Dog']],
        'Mera'=>['fa'=>'مرا','country'=>'آلمان','tier'=>'پرمیوم','models'=>['Cats Adult Chicken','Cats Kitten','Cats Sterilised','Essential Reference Dog','Pure Sensitive Lamb & Rice','Pure Sensitive Salmon & Rice','Junior Dog']],
        'Brit'=>['fa'=>'بریت','country'=>'چک','tier'=>'پرمیوم','models'=>['Care Cat Missy Sterilised','Care Cat Lilly Sensitive','Care Cat Crazy Kitten','Premium Cat Adult','Care Dog Mini Adult','Care Dog Junior','Premium Dog Adult','Fresh Dog Chicken']],
        'Farmina N&D'=>['fa'=>'فارمینا ان اند دی','country'=>'ایتالیا','tier'=>'سوپرپرمیوم','models'=>['N&D Prime Cat Chicken','N&D Ocean Cat','N&D Pumpkin Cat','N&D Quinoa Skin & Coat','N&D Dog Chicken & Pomegranate','N&D Puppy Medium Maxi','N&D Ocean Dog']],
        'Monge'=>['fa'=>'مونژه','country'=>'ایتالیا','tier'=>'پرمیوم','models'=>['Cat Adult Rich in Chicken','Cat Sterilised','Cat Kitten','Dog Mini Adult','Dog Medium Adult','Dog Puppy & Junior','Speciality Line Salmon']],
        'Acana'=>['fa'=>'آکانا','country'=>'کانادا','tier'=>'سوپرپرمیوم','models'=>['Indoor Entrée Cat','Wild Prairie Cat','Grasslands Cat','Bountiful Catch Cat','Prairie Poultry Dog','Wild Coast Dog','Grasslands Dog','Puppy & Junior']],
        'Orijen'=>['fa'=>'اوریجن','country'=>'کانادا','tier'=>'سوپرپرمیوم','models'=>['Cat & Kitten','Six Fish Cat','Original Dog','Six Fish Dog','Puppy','Senior Dog','Fit & Trim']],
        'Hill’s'=>['fa'=>'هیلز','country'=>'آمریکا','tier'=>'درمانی','models'=>['Science Plan Adult Cat','Science Plan Kitten','Sterilised Cat','Sensitive Stomach & Skin Cat','Prescription Diet c/d','Prescription Diet k/d','Prescription Diet i/d','Adult Dog Chicken','Perfect Weight Dog']],
        'Leonardo'=>['fa'=>'لئوناردو','country'=>'آلمان','tier'=>'پرمیوم','models'=>['Adult Complete 32/16','Adult GF Salmon','Kitten','Light','Senior','Urinary','Sensitive']],
        'Bosch'=>['fa'=>'بوش','country'=>'آلمان','tier'=>'پرمیوم','models'=>['Adult Lamb & Rice','Mini Adult','Junior Medium','Junior Maxi','Sensitive Lamb & Rice','Active','Senior']],
        'Carnilove'=>['fa'=>'کارنی لاو','country'=>'چک','tier'=>'سوپرپرمیوم','models'=>['Cat Salmon Sensitive','Cat Duck & Turkey','Cat Fresh Chicken & Rabbit','Dog Salmon Adult','Dog Lamb & Wild Boar','Puppy Salmon & Turkey']],
        'Sanabelle'=>['fa'=>'سانابل','country'=>'آلمان','tier'=>'پرمیوم','models'=>['Adult Poultry','Adult Trout','Kitten','Sterilised','Urinary','Sensitive Lamb','Hair & Skin']],
        'Schesir'=>['fa'=>'شسیر','country'=>'ایتالیا','tier'=>'پرمیوم','models'=>['Cat Adult Chicken','Cat Sterilised','Cat Kitten','Dog Small Adult','Dog Medium Adult','Dog Puppy']],
        'Advance'=>['fa'=>'ادونس','country'=>'اسپانیا','tier'=>'پرمیوم','models'=>['Cat Sterilized','Cat Adult Chicken','Cat Kitten','Dog Mini Adult','Dog Medium Adult','Dog Sensitive Salmon']],
        'Dr.Clauder’s'=>['fa'=>'دکتر کلادرز','country'=>'آلمان','tier'=>'پرمیوم','models'=>['Adult Cat','Kitten','Sterilised Cat','Adult Dog Chicken','Junior Dog','Sensitive Dog']],
        'Fitmin'=>['fa'=>'فیت‌مین','country'=>'چک','tier'=>'پرمیوم','models'=>['Cat Purity Indoor','Cat Purity Kitten','Dog Mini Adult','Dog Medium Adult','Dog Maxi Adult','Dog Puppy']],
        'Monello'=>['fa'=>'مونلو','country'=>'برزیل','tier'=>'اقتصادی / پرمیوم','models'=>['Cat Adult Salmon','Cat Kitten','Cat Sterilized','Dog Adult Chicken','Dog Puppy','Dog Small Breed']],
        'NutriPet'=>['fa'=>'نوتری پت','country'=>'ایران','tier'=>'ایرانی','models'=>['غذای خشک گربه بالغ','غذای خشک بچه گربه','غذای خشک سگ بالغ','غذای خشک توله سگ','غذای گربه عقیم شده']],
        'Mofeed'=>['fa'=>'مفید','country'=>'ایران','tier'=>'ایرانی','models'=>['گربه بالغ مرغ','بچه گربه','سگ بالغ','توله سگ','گربه عقیم شده']],
        'Fidar'=>['fa'=>'فیدار','country'=>'ایران','tier'=>'ایرانی','models'=>['غذای خشک گربه بالغ','غذای خشک بچه گربه','غذای خشک سگ بالغ','غذای خشک توله سگ']],
        'Shayer'=>['fa'=>'شایر','country'=>'ایران','tier'=>'ایرانی','models'=>['گربه بالغ','بچه گربه','سگ بالغ نژاد کوچک','سگ بالغ نژاد بزرگ']]
    ];
}

function ninjapet_need_keywords_for_model($model) {
    $m = mb_strtolower($model);
    $needs = [];
    $map = ['گوارشی'=>['gastro','digestive','stomach','intestine','sensitive'], 'کلیوی'=>['renal','kidney','k/d'], 'ادراری'=>['urinary','s/o','c/d'], 'عقیم‌شده'=>['steril','sterilised','sterilized','عقیم'], 'کنترل وزن'=>['light','weight','fit','trim','metabolic'], 'حساسیت پوستی'=>['skin','coat','hair','hypoallergenic'], 'بچه گربه/توله'=>['kitten','puppy','junior','babycat'], 'سالمند'=>['senior']];
    foreach($map as $need=>$keys) foreach($keys as $key) if(strpos($m, $key)!==false){ $needs[]=$need; break; }
    return $needs ?: ['عمومی'];
}

function ninjapet_seed_food_catalog($force=false) {
    if (!$force && get_option('ninjapet_catalog_seeded')) return 0;
    $created = 0;
    foreach(ninjapet_catalog_dataset() as $latin=>$brand){
        $brand_title = $brand['fa'];
        $existing = get_page_by_title($brand_title, OBJECT, 'pettt_brand');
        $brand_id = $existing ? $existing->ID : wp_insert_post(['post_type'=>'pettt_brand','post_status'=>'publish','post_title'=>$brand_title,'post_excerpt'=>$latin,'post_content'=>'برند '.$brand_title.' از برندهای غذای خشک و محصولات حیوانات خانگی است. اطلاعات این برند، تصاویر و توضیحات تکمیلی از پیشخوان قابل ویرایش است.']);
        if($brand_id && !is_wp_error($brand_id)){
            update_post_meta($brand_id,'_pettt_country',$brand['country']); update_post_meta($brand_id,'_pettt_tier',$brand['tier']); update_post_meta($brand_id,'_pettt_models',implode("\n", $brand['models']));
            if(!$existing) $created++;
        }
        foreach($brand['models'] as $model){
            $title = $brand_title.' - '.$model;
            if(get_page_by_title($title, OBJECT, 'pettt_food')) continue;
            $food_id = wp_insert_post(['post_type'=>'pettt_food','post_status'=>'publish','post_title'=>$title,'post_content'=>'این مدل غذا در کاتالوگ اولیه نینجا پت ثبت شده است. توضیحات، ترکیبات، تصویر محصول، قیمت حدودی و لینک خرید از پیشخوان قابل ویرایش است.']);
            if($food_id && !is_wp_error($food_id)){
                update_post_meta($food_id,'_pettt_brand_id',$brand_title); update_post_meta($food_id,'_pettt_price','نیازمند بروزرسانی'); update_post_meta($food_id,'_pettt_buy_url',''); update_post_meta($food_id,'_pettt_pet_type',(stripos($model,'dog')!==false || mb_strpos($model,'سگ')!==false || stripos($model,'puppy')!==false) ? 'سگ' : 'گربه'); update_post_meta($food_id,'_pettt_life_stage',(stripos($model,'kitten')!==false || stripos($model,'puppy')!==false || mb_strpos($model,'بچه')!==false || mb_strpos($model,'توله')!==false) ? 'بچه/توله' : 'بالغ');
                wp_set_object_terms($food_id, ninjapet_need_keywords_for_model($model), 'pettt_food_problem');
                $created++;
            }
        }
    }
    update_option('ninjapet_catalog_seeded', current_time('mysql'));
    return $created;
}

add_action('after_switch_theme', function(){ ninjapet_seed_food_catalog(false); });
add_action('admin_menu', function(){ add_submenu_page('pettt-dashboard','ایمپورت کاتالوگ غذا','کاتالوگ غذا','manage_options','ninjapet-catalog-seed','ninjapet_catalog_seed_page'); });
function ninjapet_catalog_seed_page(){
    if(isset($_POST['ninjapet_seed_catalog']) && check_admin_referer('ninjapet_seed_catalog')) { $n=ninjapet_seed_food_catalog(true); echo '<div class="notice notice-success"><p>'.esc_html($n).' آیتم بررسی/ایمپورت شد.</p></div>'; }
    echo '<div class="wrap pettt-admin-wrap"><h1>ایمپورت کاتالوگ اولیه غذا</h1><p>برندها و مدل‌های رایج غذای خشک سگ و گربه در بازار ایران به عنوان داده اولیه ساخته می‌شوند. بعداً از پیشخوان می‌توانید تصویر، توضیح، قیمت و لینک خرید را ویرایش کنید.</p><form method="post">'; wp_nonce_field('ninjapet_seed_catalog'); echo '<button class="button button-primary button-hero" name="ninjapet_seed_catalog" value="1">ایمپورت/تکمیل کاتالوگ</button></form></div>';
}
