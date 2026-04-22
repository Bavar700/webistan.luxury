<?php
require_once('wp-load.php');

$posts_to_create = [
    // Tajik Posts
    [
        'title' => 'Тағйирот дар ҳисоби андоз аз амвол ва замин',
        'content' => 'Ин матни пурра барои хабар дар бораи тағйирот дар ҳисоби андоз аст. NEKSOZ таҷрибаи ғанӣ дар ин соҳа дорад...',
        'cat' => 'tj'
    ],
    [
        'title' => 'Равандҳои муфлисшавӣ ва барҳамдиҳии корхонаҳо',
        'content' => 'Ин матни пурра дар бораи равандҳои муфлисшавӣ ва барҳамдиҳӣ мебошад. Мутахассисони мо дар ҳамаи марҳилаҳо кӯмак мерасонанд...',
        'cat' => 'tj'
    ],
    [
        'title' => 'Натиҷаҳои ҳамоиши иқтисодӣ дар Душанбе',
        'content' => 'Ин матни пурра дар бораи натиҷаҳои ҳамоиши иқтисодӣ дар Душанбе аст. Мо самтҳои нави рушдро баррасӣ кардем...',
        'cat' => 'tj'
    ],
    // Russian Posts
    [
        'title' => 'Изменения в расчете налога на имущество и землю',
        'content' => 'Это полный текст новости об изменениях в расчете налогов. Команда NEKSOZ подготовила подробный разбор...',
        'cat' => ''
    ],
    [
        'title' => 'Процедуры банкротства и ликвидации предприятий',
        'content' => 'Это подробная информация о процедурах банкротства. Мы помогаем бизнесу в сложных правовых ситуациях...',
        'cat' => ''
    ],
    [
        'title' => 'Итоги экономического форума в Душанбе',
        'content' => 'Полный текст об итогах форума в Душанбе. Рассматриваем новые возможности для инвестиционного климата...',
        'cat' => ''
    ],
    // English Posts
    [
        'title' => 'Changes in Property and Land Tax Calculation',
        'content' => 'Full text regarding changes in property tax calculations. NEKSOZ provides expert consultation...',
        'cat' => 'en'
    ],
    [
        'title' => 'Bankruptcy and Corporate Liquidation Procedures',
        'content' => 'Detailed guide on bankruptcy and liquidation of companies. Our legal team is ready to assist...',
        'cat' => 'en'
    ],
    [
        'title' => 'Outcomes of the Economic Forum in Dushanbe',
        'content' => 'Summary of the key outcomes from the Dushanbe Economic Forum. Analyzing new investment vectors...',
        'cat' => 'en'
    ]
];

foreach ($posts_to_create as $p_data) {
    if (!get_page_by_title($p_data['title'], OBJECT, 'post')) {
        $post_id = wp_insert_post(array(
            'post_title' => $p_data['title'],
            'post_content' => $p_data['content'],
            'post_status' => 'publish',
            'post_type' => 'post'
        ));
        if ($post_id && $p_data['cat'] !== '') {
            $cat_id = get_category_by_slug($p_data['cat']);
            if (!$cat_id) {
                $cat_id_arr = wp_insert_term(ucfirst($p_data['cat']), 'category', array('slug' => $p_data['cat']));
                if (!is_wp_error($cat_id_arr)) $cat_id_val = $cat_id_arr['term_id'];
            } else {
                $cat_id_val = $cat_id->term_id;
            }
            if (isset($cat_id_val)) wp_set_post_categories($post_id, array($cat_id_val));
        }
    }
}

echo "DONE: Trilingual posts ensured.";
?>
