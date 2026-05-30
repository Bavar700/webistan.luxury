<?php
// Скрипт для одноразового импорта категорий Places
// Срабатывает только 1 раз при заходе в админку

add_action( 'admin_init', function() {
    // Проверка, запускался ли скрипт ранее. Если да - выходим.
    if ( get_option( 'alltj_categories_imported' ) ) {
        return;
    }

    // Имя таксономии. Для кастомных типов постов (как Places) обычно создается своя таксономия.
    // Если в Voxel ваша таксономия называется иначе (например 'place_category'), поменяйте это значение.
    $taxonomy = 'category'; 

    // 1. БЕЗОПАСНОЕ УДАЛЕНИЕ СТАРЫХ КАТЕГОРИЙ В ЭТОЙ ТАКСОНОМИИ
    $terms = get_terms( [
        'taxonomy'   => $taxonomy,
        'hide_empty' => false,
    ] );
    
    if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
        foreach ( $terms as $term ) {
            wp_delete_term( $term->term_id, $taxonomy );
        }
    }

    // 2. МАССИВ НОВЫХ КАТЕГОРИЙ (Главные и Подкатегории)
    $categories = [
        'Food & Drink' => [
            'Restaurants (Fine dining, casual dining)',
            'Cafes & Coffee Shops',
            'Tea Houses (Traditional Chaikhanas)',
            'Bars & Pubs',
            'Fast Food & Street Food',
            'Pizzerias & Sushi Bars',
            'Bakeries & Patisseries',
            'Food Delivery & Catering Services'
        ],
        'Leisure & Entertainment' => [
            'Cinemas & Theaters',
            'Parks & Recreation Areas',
            'Children’s Entertainment Centers',
            'Bowling & Billiards',
            'Quests & VR Zones',
            'Nightclubs & Karaoke',
            'Water Parks & Swimming Pools',
            'Museums, Galleries & Exhibitions'
        ],
        'Health & Beauty' => [
            'Fitness Centers & Gyms',
            'Beauty Salons & Hairdressers',
            'Barbershops',
            'SPA, Massage & Saunas',
            'Yoga & Pilates Studios',
            'Medical Centers & Private Clinics',
            'Dentistry',
            'Pharmacies & Opticians'
        ],
        'Travel & Accommodation' => [
            'Hotels & Resorts',
            'Hostels & Guest Houses',
            'Sanatoriums & Health Resorts',
            'Travel Agencies',
            'Ticketing Offices (Air & Rail)',
            'Guided Tours & Excursions'
        ],
        'Shopping & Retail' => [
            'Shopping Malls',
            'Supermarkets & Grocery Stores',
            'Traditional Markets & Bazaars',
            'Clothing, Shoes & Accessories',
            'Electronics & Home Appliances',
            'Cosmetics & Fragrances',
            'Bookstores & Stationery',
            'Sporting Goods',
            'Pet Shops'
        ],
        'Automotive & Transport' => [
            'Car Service & Repair (Auto Maintenance)',
            'Car Washes',
            'Gas & Charging Stations (Fuel & EV)',
            'Car Dealerships & Markets',
            'Auto Parts & Accessories',
            'Car Rentals',
            'Taxi & Logistics Services'
        ],
        'Services & Professional Help' => [
            'Banking, ATMs & Currency Exchange',
            'Legal & Notary Services',
            'Real Estate Agencies',
            'Dry Cleaning, Laundry & Cleaning Services',
            'IT & Digital Services (Repair, Consulting)',
            'Printing & Photography Studios',
            'Courier & Postal Services'
        ],
        'Education & Development' => [
            'Language Schools & Learning Centers',
            'Driving Schools',
            'Coworking Spaces & Training Hubs',
            'Daycare & Early Childhood Education',
            'Sports Schools & Dance Studios',
            'Creative Arts & Music Schools'
        ]
    ];

    // 3. ДОБАВЛЕНИЕ НОВЫХ КАТЕГОРИЙ В БАЗУ ДАННЫХ
    foreach ( $categories as $parent_name => $children ) {
        // Создаем родительскую категорию
        $parent_term = wp_insert_term( $parent_name, $taxonomy );
        
        $parent_id = 0;
        if ( ! is_wp_error( $parent_term ) ) {
            $parent_id = $parent_term['term_id'];
        } elseif ( isset( $parent_term->error_data['term_exists'] ) ) {
            $parent_id = $parent_term->error_data['term_exists']; // Если уже существует
        }

        // Создаем дочерние категории и привязываем к родительской
        if ( $parent_id ) {
            foreach ( $children as $child_name ) {
                wp_insert_term( $child_name, $taxonomy, [
                    'parent' => $parent_id
                ] );
            }
        }
    }

    // 4. ЗАПИСЬ МАРКЕРА В БД (чтобы скрипт больше не повторял работу)
    update_option( 'alltj_categories_imported', true );
});
