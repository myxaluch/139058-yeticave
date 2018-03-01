<?php
  require_once('init.php');

  $result = [];
  $sql = 'SELECT lots.id, lots.title, lots.start_rate, lots.image_url, COUNT(rates.id) AS rates_count, categories.title as category_title FROM lots
            JOIN categories ON lots.category_id = categories.id
            LEFT JOIN rates ON lots.id = rates.lot_id
            WHERE
             lots.finished_at > NOW()
            GROUP BY
              lots.id,
              lots.title,
              lots.start_rate,
              lots.image_url,
              categories.title';
  $query_status = db_safe_select_query($db_link, $sql, [], $result);

  if (!$query_status) {
    $main_content = $result;
  } else {
    $main_content = render_template(
      'templates/index.php',
      [
        'lots' => $result,
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
