<?php
$f = 'front-page-tj.php';
$c = file_get_contents($f);

// 1. Headline
$c = preg_replace('/<h1 class="hero__title">[\s\S]*?<\/h1>/', '<h1 class="hero__title">
                Роҳҳалҳои маҷмӯӣ<br><em>барои тиҷорати Шумо</em>
            </h1>', $c);

// 2. Badge
$c = preg_replace('/<div class="hero__badge">[\s\S]*?<\/div>/', '<div class="hero__badge">Neksoz Business Consulting Group</div>', $c);

// 3. Description (roughly restoring based on similar context)
$desc = 'Мо ба шумо дар таҳияи стратегияҳои муассир, оптимизатсияи равандҳои тиҷоратӣ ва таъмини амнияти молиявӣ кӯмак мерасонем. Хидматрасониҳои касбӣ барои рушди устувори тиҷорати шумо.';
$c = preg_replace('/<p class="hero__desc">[\s\S]*?<\/p>/', '<p class="hero__desc">' . $desc . '</p>', $c);

// 4. Buttons
$c = preg_replace('/DD,D\'DD,\?D\?D_DD,O3D_D, DD_.*/', 'Хидматрасониҳо', $c);
$c = preg_replace('/DDDD_\? DD_ DD_/', 'Тамос бо мо', $c);

// 5. Section Label
$c = preg_replace('/<div class="section__label"[^>]*>[\s\S]*?<\/div>/', '<div class="section__label" style="margin-bottom: 0;">Муваффақиятҳои мо</div>', $c);

// 6. Stats text
$c = preg_replace('/DoD,DD_OD_DD, O>DDD_D,DDDD\'/', 'Аудитҳои анҷомшуда', $c);
// Try to fix 1000+ stat too
$c = preg_replace('/DoDDD_D DDD?DD?D/', 'Мизоҷони қаноатманд', $c);

file_put_contents($f, $c);
echo "Updated headline and fixed basic labels in $f\n";
?>
