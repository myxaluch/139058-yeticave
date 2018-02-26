<?php
  require_once('init.php');

  if (isset($_COOKIE[$viewed_lots_cookie_name])) {
    unset($_COOKIE[$viewed_lots_cookie_name]);
    setcookie($viewed_lots_cookie_name, null, -1, '/');
  }
  header('Location: history.php');
  return true;
?>
