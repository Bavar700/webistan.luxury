<?php
require_once('/var/www/html/wp-load.php');

$reviews = [
  [
    "client_name" => "Amridinova Sayora Sharofovna",
    "company_position" => "Director 'American school'",
    "review_text" => "Благодарим за долговременное плодотворное сотрудничество! Надеюсь в дальнейшем качество предоставляемых услуг будет так же на высоте, несмотря на то что линейка услуг расширяется, что не может не радовать. Приятно иметь дело с профессионалами своего дела - всегда быстро, четко и по делу."
  ],
  [
    "client_name" => "Cassidi Veyn",
    "company_position" => "Director 'Total Service'",
    "review_text" => "Ребята ваш сервис действительно соответсвует вашему профессионализму. Думаю здесь выбор очиведен. Спасибо вам!"
  ],
  [
    "client_name" => "Fakhriddin Usmonov",
    "company_position" => "Director TIKRO",
    "review_text" => "Создали хорошую рабочую атмосферу, пунктуальны, дружелюбны, подали вкусный чай и конечно дали дельные советы. Спасибо ребята и успехов вам!"
  ]
];

foreach ($reviews as $r) {
    $pid = wp_insert_post([
        'post_title' => $r['client_name'],
        'post_type' => 'b2b_reviews',
        'post_status' => 'publish'
    ]);
    if ($pid) {
        update_post_meta($pid, '_b2b_company', $r['company_position']);
        update_post_meta($pid, '_b2b_text', $r['review_text']);
        echo "Imported: {$r['client_name']}\n";
    }
}
unlink(__FILE__);
