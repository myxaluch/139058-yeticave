<?php
  require_once('data.php');
  require_once('functions.php');

  date_default_timezone_set("Europe/Moscow");

  $lots_content = render_template('templates/lots_list.php', ['lots' => $lots]);

  $main_content = render_template(
    'templates/index.php',
    [
      'lots_content' => $lots_content,
      'categories' => $lots_categories
    ]
  );

  $full_page = render_template(
    'templates/layout.php',
    [
      'main_content' => $main_content,
      'title' => $title,
      'is_auth' => $is_auth,
      'user_name' => $user_name,
      'user_avatar' => $user_avatar,
      'lots_categories' => $lots_categories
    ]
  );

  print($full_page);
?>
