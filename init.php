<?php
  require_once('configs/database.php');
  require_once('mysql_helper.php');
  // Включение всех ошибок, кроме `Warnings` (например, от mysqli_connect), т.к. они обрабатываются в коде
  error_reporting(E_ALL & ~E_WARNING);

  session_start();
  date_default_timezone_set('Europe/Moscow');
  $lots_categories = [];
  $current_user = null;
  $viewed_lots_cookie_name = 'viewed_lots';
  $title = 'YetiCave';

  $db_link = mysqli_connect($db_config['host'], $db_config['user'], $db_config['password'], $db_config['database']);
  if ($db_link) {
    mysqli_set_charset($db_link, 'utf8');

    $lots_categories = load_lots_categories($db_link);
    $current_user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
  } else {
    $error = 'Ошибка ' . mysqli_connect_errno() . ': ' . mysqli_connect_error();
    $main_content = render_template('templates/error.php', ['error' => $error], 500);

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
  }