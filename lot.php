<?php
  require_once('init.php');

  if (isset($_GET['lot_id'])) {
    $lot_id = htmlspecialchars($_GET['lot_id']);
    $lot = search_lot_by_id($lot_id, $db_link);

    if ($lot) {
      $rates = [];
      $rates = search_rates_by_lot($lot_id, $db_link);
      $minimal_rate = $lot['cost'] + $lot['cost-step'];

      add_value_to_cookie_array($viewed_lots_cookie_name, $lot_id, strtotime('+ 30 days'));

      $main_content = render_template(
        'templates/lot.php',
        [
          'lot' => $lot,
          'rates' => $rates,
          'minimal_rate' => $minimal_rate,
          'current_user' => $current_user
        ]
      );
    } else {
      $main_content = render_template('templates/error.php', ['error' => 'Лота с этим ID не найдено'], 404);
    }
  }

  $full_page = render_template(
    'templates/layout.php',
    [
      'main_content' => $main_content,
      'title' => $title,
      'current_user' => $current_user,
      'lots_categories' => $lots_categories
    ]
  );

  print($full_page);