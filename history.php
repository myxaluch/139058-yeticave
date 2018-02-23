<?php
  require_once('data.php');
  require_once('functions.php');

  if (isset($_COOKIE[$viewed_lots_cookie_name])) {
    $lots_ids = json_decode($_COOKIE[$viewed_lots_cookie_name]);
    $viewed_lots = get_sub_array($lots, $lots_ids);

    $viewed_lots_page = render_template('templates/lots_list.php',['lots' => $viewed_lots]);
    $history_page = render_template('templates/history.php',['viewed_lots' => $viewed_lots_page]);
  } else {
    $history_page = render_template('templates/history.php');
  }

  $full_page = render_template(
    'templates/layout.php',
    [
      'main_content' => $history_page,
      'title' => $title,
      'is_auth' => $is_auth,
      'user_name' => $user_name,
      'user_avatar' => $user_avatar,
      'lots_categories' => $lots_categories
    ]
  );

  print($full_page);
?>
