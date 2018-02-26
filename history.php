<?php
  require_once('data.php');
  require_once('functions.php');

  if (isset($_COOKIE[$viewed_lots_cookie_name])) {
    $lots_ids = json_decode($_COOKIE[$viewed_lots_cookie_name]);
    $viewed_lots = get_sub_array($lots, $lots_ids);

    $history_page = render_template('templates/history.php', ['lots' => $viewed_lots]);
  } else {
    $history_page = render_template('templates/history.php', ['lots' => []]);
  }

  $full_page = render_template(
    'templates/layout.php',
    [
      'main_content' => $history_page,
      'title' => $title,
      'current_user' => current_user(),
      'user_avatar' => $user_avatar,
      'lots_categories' => $lots_categories
    ]
  );

  print($full_page);
?>
