<?php
  require_once('init.php');

  if (isset($_COOKIE[$viewed_lots_cookie_name])) {
    $lots_ids = json_decode($_COOKIE[$viewed_lots_cookie_name]);

    $viewed_lots = search_lots_by_ids($lots_ids, $db_link);

    $history_page = render_template('templates/history.php', ['lots' => $viewed_lots]);
  } else {
    $history_page = render_template('templates/history.php', ['lots' => []]);
  }

  $full_page = render_template(
    'templates/layout.php',
    [
      'main_content' => $history_page,
      'title' => $title,
      'current_user' => $current_user,
      'lots_categories' => $lots_categories
    ]
  );

  print($full_page);
