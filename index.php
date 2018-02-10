<?php
  require_once('lotsdata.php');
  require_once('functions.php');

  $is_auth = (bool) rand(0, 1);
  $title = 'YetiCave';
  $user_name = 'Константин';
  $user_avatar = 'img/user.jpg';

  $main_content = render_template(
    'templates/index.php',
    [
      'lots' => $lots
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
