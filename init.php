<?php
  session_start();
  date_default_timezone_set('Europe/Moscow');
  require_once('data.php');
  require_once('configs/database.php');
  require_once('mysql_helper.php');

  $db_link = mysqli_connect($db_config['host'], $db_config['user'], $db_config['password'], $db_config['database']);
  mysqli_set_charset($db_link, 'utf8');
?>
