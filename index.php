<?php
  require_once('init.php');

  $lots = [];
  $sql = 'SELECT lots.*, categories.title AS category_title FROM lots
    JOIN categories
      ON lots.category_id = categories.id';
  $result = db_safe_select_query($db_link, $sql, [], $lots);

  if (!$result) {
    $main_content = $lots;
  } else {
    $main_content = render_template(
      'templates/index.php',
      [
        'lots' => $lots,
        'categories' => load_lots_categories($db_link)
      ]
    );
  }

  $full_page = render_template(
    'templates/layout.php',
    [
      'main_content' => $main_content,
      'title' => $title,
      'current_user' => current_user(),
      'lots_categories' => load_lots_categories($db_link)
    ]
  );

  print($full_page);
?>
