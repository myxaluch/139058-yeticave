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

  $category_titles = array_values($lots_categories);

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
