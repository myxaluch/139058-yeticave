<?php
// ставки пользователей, которыми надо заполнить таблицу
  $bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]

  ];

  $lots_categories = [
    "boards" => "Доски и лыжи",
    "attachment" => "Крепления",
    "boots" => "Ботинки",
    "clothing" => "Одежда",
    "tools" => "Инструменты",
    "other" => "Разное"
  ];

  $lots =[
    [
      "title" => "2014 Rossignol District Snowboard",
      "category" => $lots_categories["boards"],
      "description" => "Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив
        снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях,
        наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия
        в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости.
        А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и
        улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным",
      "cost" => 10999,
      "image_url" => "img/lot-1.jpg"
    ],
    [
      "title" => "DC Ply Mens 2016/2017",
      "category" => $lots_categories["boards"],
      "description" => "DC Ply создан для трассового и паркового катания.
        Технология Edge Bevel со скошенным на 3 градуса кантом относительно скользяка прощает ошибки.
        Быстрый экструдированный скользяк обладает прочностью и легко ремонтируется. В этом сезоне в линейке
        представлен ряд широких ростовок. DC Ply - доступная зимняя альтернатива скейтбордингу.
        Гибкая конструкция и отзывчивость поможет экспериментировать с новыми трюками.",
      "cost" => 159999,
      "image_url" => "img/lot-2.jpg"
    ],
    [
      "title" => "Крепления Union Contact Pro 2015 года размер L/XL",
      "category" => $lots_categories["attachment"],
      "description" => "Невероятно легкие универсальные крепления весом всего 720 грамм готовы порадовать
         прогрессирующих райдеров, практикующих как трассовое катание, так и взрывные спуски в паудере.
         Легкая нейлоновая база в сочетании с очень прочным хилкапом, выполненным из экструдированного алюминия,
         выдержит серьезные нагрузки, а бакли, выполненные из магния не только заметно снижают вес,
         но и имеют плавный механизм. Система стрепов 3D Connect обеспечивает равномерное давление на верхнюю часть
         ноги, что несомненно добавляет комфорта как во время выполнения трюков,
         так и во время катания в глубоком снегу",
      "cost" => 8000,
      "image_url" => "img/lot-3.jpg"
    ],
    [
      "title" => "Ботинки для сноуборда DC Mutiny Charocal",
      "category" => $lots_categories["boots"],
      "description" => "Эти ботинки созданы для фристайла и для того, чтобы на любом споте Вы чувствовали себя как
         дома в уютных тапочках, в которых Вы будете также прекрасно чувствовать свою доску, как ворсинки на любимом
         коврике около дивана. Каучуковая стелька Impact S погасит нежелательные вибрации и смягчит приземления,
         внутренник White Liner с запоминающим форму ноги наполением и фиксирующим верхним стрепом добавит эргономики
         в посадке, а традиционная шнуровка с блокирующими верхними крючками поможет идеально подогнать ботинок по
         ноге, тонко фиксируя натяжение шнурков.",
      "cost" => 10999,
      "image_url" => "img/lot-4.jpg"
    ],
    [
      "title" => "Куртка для сноуборда DC Mutiny Charocal",
      "category" => $lots_categories["clothing"],
      "description" => "Под лаконичным дизайном этой крутки скрывается отличный катальный функционал, который не даст
        Вам замерзнуть, набрать внутрь снега или ощутить неудобство во время отработки нового трюка. Яркости внешнему
        виду добавляет большой фирменный логотип на груди, а мембранная ткань EXOTEX™ 10K, дополненная 120г
        утеплителем,обеспечит сохранение тепла и комфорта.
        Функциональные карманы позволят держать под рукой не только ски-пасс, но
        и смартфон с любимой музыкой, а прямой крой обеспечит стильный и аккуратный внешний вид как на склоне, так и в
        городе.",
      "cost" => 7500,
      "image_url" => "img/lot-5.jpg"
    ],
    [
      "title" => "Маска Oakley Canopy",
      "category" => $lots_categories["other"],
      "description" => "Увеличенный объем линзы и низкий профиль оправы маски Canopy способствуют широкому углу
        обзора, а специальное противотуманное покрытие поможет ориентироваться в условиях плохой видимости. Технология
        вентиляции O-Flow Arch и прослойка из микрофлиса сделают покорение горных склонов более комфортным.",
      "cost" => 5400,
      "image_url" => "img/lot-6.jpg"
    ]
  ];

  $users = [
    [
      'email' => 'ignat.v@gmail.com',
      'name' => 'Игнат',
      'password' => '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka'
    ],
    [
      'email' => 'kitty_93@li.ru',
      'name' => 'Леночка',
      'password' => '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa'
    ],
    [
      'email' => 'warrior07@mail.ru',
      'name' => 'Руслан',
      'password' => '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW'
    ]
  ];

  $title = 'YetiCave';
  $user_name = 'Константин';
  $user_avatar = 'img/user.jpg';
  $viewed_lots_cookie_name = 'viewed_lots';
?>
