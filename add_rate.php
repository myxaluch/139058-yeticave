<?php
  require_once('init.php');

  if($current_user) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $rate = $_POST;

      $lot = search_lot_by_id($rate['lot_id'], $db_link);
      $lot_cost_step = $lot['cost-step'];

      $validated_fields = [
        'rate' => [
          'error_text' => 'Ставка должна быть выше или равна минимальной для данного лота',
          'validate_function' => function($user_data) use($lot_cost_step) { return intval($user_data) >= $lot_cost_step; }
        ]
      ];

      $errors = form_data_validation($_POST, $validated_fields);

      if (count($errors)) {
        $rates = search_rates_by_lot($lot['id'], $db_link);
        $main_content = render_template(
          'templates/lot.php',
          [
            'lot' => $lot,
            'rates' => $rates,
            'current_user' => $current_user,
            'errors' => $errors
          ]
        );
      } else {
        add_new_rate($rate, $current_user, $db_link);
        header('Location: lot.php?lot_id='. $lot['id']);
        exit();
      }

    } else {
      $main_content = render_template('templates/error.php', ['error' => 'Данной страницы не существует'], 404);
    }
  } else {
    $main_content = render_template('templates/error.php', ['error' => 'Доступ ограничен'], 403);
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
