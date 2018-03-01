<?php
  require_once('init.php');

  $lots = load_opened_recent_lots($db_link);

  $main_content = render_template('templates/index.php', ['lots' => $lots, 'categories' => $lots_categories]);

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
?>
