<?php
  require_once('data.php');
  require_once('functions.php');

  date_default_timezone_set("Europe/Moscow");

  $main_content = render_template(
    'templates/index.php',
    [
      'lots' => $lots,
      'categories' => $lots_categories
    ]
  );

  $full_page = render_template(
    'templates/layout.php',
    [
      'main_content' => $main_content,
      'title' => $title,
      'current_user' => current_user(),
      'user_avatar' => $user_avatar,
      'lots_categories' => $lots_categories
    ]
  );

  print($full_page);
?>
