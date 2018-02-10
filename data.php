<?php
// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

  $lots_categories = [
    "boards_skis" => "Доски и лыжи",
    "mountings" => "Крепления",
    "boots" => "Ботинки",
    "clothes" => "Одежда",
    "tools" => "Инструменты",
    "miscellaneous" => "Разное"
  ];

  $lots =[
    [
      "title" => "2014 Rossignol District Snowboard",
      "category" => $lots_categories["boards_skis"],
      "cost" => 10999,
      "image_url" => "img/lot-1.jpg"
    ],
    [
      "title" => "DC Ply Mens 2016/2017",
      "category" => $lots_categories["boards_skis"],
      "cost" => 159999,
      "image_url" => "img/lot-2.jpg"
    ],
    [
      "title" => "Крепления Union Contact Pro 2015 года размер L/XL",
      "category" => $lots_categories["mountings"],
      "cost" => 8000,
      "image_url" => "img/lot-3.jpg"
    ],
    [
      "title" => "Ботинки для сноуборда DC Mutiny Charocal",
      "category" => $lots_categories["boots"],
      "cost" => 10999,
      "image_url" => "img/lot-4.jpg"
    ],
    [
      "title" => "Куртка для сноуборда DC Mutiny Charocal",
      "category" => $lots_categories["clothes"],
      "cost" => 7500,
      "image_url" => "img/lot-5.jpg"
    ],
    [
      "title" => "Маска Oakley Canopy",
      "category" => $lots_categories["miscellaneous"],
      "cost" => 5400,
      "image_url" => "img/lot-6.jpg"
    ]
  ];

  $is_auth = (bool) rand(0, 1);
  $title = 'YetiCave';
  $user_name = 'Константин';
  $user_avatar = 'img/user.jpg';
?>
