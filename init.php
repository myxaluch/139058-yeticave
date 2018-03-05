<?php
  require_once('configs/database.php');
  require_once('mysql_helper.php');

  session_start();
  date_default_timezone_set('Europe/Moscow');

  $db_link = mysqli_connect($db_config['host'], $db_config['user'], $db_config['password'], $db_config['database']);
  mysqli_set_charset($db_link, 'utf8');

  $lots_categories = load_lots_categories($db_link);
  $current_user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
  $viewed_lots_cookie_name = 'viewed_lots';
  $title = 'YetiCave';