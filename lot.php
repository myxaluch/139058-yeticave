<?php
  require_once('init.php');

  $lot = null;

  if (isset($_GET['lot_id'])) {
    $lot_id = htmlspecialchars($_GET['lot_id']);

    if (array_key_exists($lot_id, $lots)) {
      add_value_to_cookie_array($viewed_lots_cookie_name, $lot_id, strtotime('+ 30 days'));
      $lot = $lots[$lot_id];
    }
  }

  if (!$lot) {
    http_response_code(404);
  }

  $lot_content = render_template(
    'templates/lot.php',
    [
      'lot' => $lot,
      'current_user' => current_user()
    ]
  );

  $full_page = render_template(
    'templates/layout.php',
    [
      'main_content' => $lot_content,
      'title' => $title,
      'current_user' => current_user(),
      'lots_categories' => load_lots_categories($db_link)
    ]
  );

  print($full_page);
?>
