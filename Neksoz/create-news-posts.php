<?php
require_once __DIR__ . '/../../../wp-load.php';

$news_items = [
    'ru' => [
        ['title' => 'АУТСОРСИНГОВАЯ ДЕЯТЕЛЬНОСТЬ', 'content' => 'Аутсорсинговая деятельность как инструмент оптимизации хозяйственной деятельности предприятий в условиях рыночной экономики.'],
        ['title' => 'Изменения в расчете налога на имущество и землю', 'content' => 'Согласно ст. 175 и 402 Налогового кодекса, налоги напрямую зависят от кадастровой стоимости.'],
        ['title' => 'Процедуры банкротства и ликвидации предприятий', 'content' => 'Команда NEKSOZ объединяет экспертов в области права. Наш опыт показывает...'],
        ['title' => 'Итоги экономического форума в Душанбе', 'content' => 'Обсуждаем новые векторы развития инвестиционного климата.']
    ],
    'tj' => [
        ['title' => 'ФАЪОЛИЯТИ АУТСОРСИНГӢ', 'content' => 'Фаъолияти аутсорсингӣ ҳамчун воситаи оптимизатсияи фаъолияти хоҷагидории корхонаҳо дар шароити иқтисоди бозорӣ.'],
        ['title' => 'Тағйирот дар ҳисоби андоз аз амвол ва замин', 'content' => 'Тибқи моддаҳои 175 ва 402-и Кодекси андоз, андозҳо мустақиман ба арзиши кадастрӣ вобастаанд.'],
        ['title' => 'Равандҳои муфлисшавӣ ва барҳамдиҳии корхонаҳо', 'content' => 'Ҳайати кории NEKSOZ коршиносони соҳаи ҳуқуқро муттаҳид месозад.'],
        ['title' => 'Натиҷаҳои ҳамоиши иқтисодӣ дар Душанбе', 'content' => 'Самтҳои нави рушди фазои сармоягузориро баррасӣ мекунем.']
    ],
    'en' => [
        ['title' => 'OUTSOURCING ACTIVITY', 'content' => 'Outsourcing activity as a tool for optimizing the economic activities of enterprises in a market economy.'],
        ['title' => 'Changes in Property and Land Tax Calculation', 'content' => 'According to Articles 175 and 402 of the Tax Code, taxes depend directly on cadastral value.'],
        ['title' => 'Bankruptcy and Corporate Liquidation Procedures', 'content' => 'The NEKSOZ team brings together legal experts. Our experience shows that professional document preparation...'],
        ['title' => 'Outcomes of the Economic Forum in Dushanbe', 'content' => 'Discussing new vectors of investment climate development.']
    ]
];

foreach ($news_items as $lang => $items) {
    // Get category ID for language
    $cat_id = get_term_by('slug', $lang, 'category');
    $cat_id = $cat_id ? $cat_id->term_id : 0;
    
    foreach ($items as $item) {
        $post_check = get_page_by_title($item['title'], OBJECT, 'post');
        if (!$post_check) {
            $post_id = wp_insert_post([
                'post_type' => 'post',
                'post_title' => $item['title'],
                'post_content' => $item['content'],
                'post_status' => 'publish',
                'post_author' => 1,
                'post_category' => $cat_id ? [$cat_id] : []
            ]);
            if ($post_id) {
                echo "CREATED POST ($lang): {$item['title']}\n";
            }
        } else {
            echo "EXISTS POST ($lang): {$item['title']}\n";
        }
    }
}
