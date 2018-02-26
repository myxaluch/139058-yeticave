<?php
  require_once('functions.php');
  /**
   * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
   *
   * @param $link mysqli Ресурс соединения
   * @param $sql string SQL запрос с плейсхолдерами вместо значений
   * @param array $data Данные для вставки на место плейсхолдеров
   *
   * @return mysqli_stmt Подготовленное выражение
   */
  function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($data) {
      $types = '';
      $stmt_data = [];

      foreach ($data as $value) {
        $type = null;

        if (is_int($value)) {
          $type = 'i';
        }
        else if (is_string($value)) {
          $type = 's';
        }
        else if (is_double($value)) {
          $type = 'd';
        }

        if ($type) {
          $types .= $type;
          $stmt_data[] = $value;
        }
      }

      $values = array_merge([$stmt, $types], $stmt_data);

      $func = 'mysqli_stmt_bind_param';
      $func(...$values);
    }

    return $stmt;
  }

  function db_safe_select_query($link, $sql, $data = [], &$result) {
    if (!$link) {
      $error = mysqli_connect_error();
      $result = render_template('error.php', ['error' => $error]);
      return false;
    }

    $stmt = db_get_prepare_stmt($link, $sql, $data);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if (!$res) {
      $error = mysqli_errno();
      $result = render_template('error.php', ['error' => $error]);
      return false;
    }

    $result = mysqli_fetch_all($res, MYSQLI_ASSOC);


    if (!$res) {
      $error = mysqli_errno();
      $result = render_template('error.php', ['error' => $error]);
      return false;
    }

    return true;
  }


  function db_safe_query($link, $sql, $data = [], &$result) {
    if (!$link) {
      $error = mysqli_connect_error();
      $result = render_template('error.php', ['error' => $error]);
      return false;
    }

    $stmt = db_get_prepare_stmt($link, $sql, $data);
    $res = mysqli_stmt_execute($stmt);

    if (!$res) {
      $error = mysqli_errno();
      $result = render_template('error.php', ['error' => $error]);
      return false;
    }

    return true;
  }

  /**
   * Search user by given email
   * @param $email - given email
   * @param $users - array with users, where are searching
   * @return array - founded user
   */
  function search_user_by_email($email, $db_link) {
    $user= null;
    $sql = 'SELECT * FROM users WHERE email = ? LIMIT 1';

    $result = db_safe_select_query($db_link, $sql, [$email], $user);

    if ($result) {
      return $user;
    }
  }

  function add_new_user(&$data, $db_link) {
    $result = null;

    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    $insert_sql = 'INSERT INTO users(`email`, `name`, `password`, `avatar_url`, `contact_info`, `created_at`) 
                            VALUES (?, ?, ?, ?, ?, NOW())';
    $result = db_safe_query(
      $db_link,
      $insert_sql,
      [
        $data['email'],
        $data['name'],
        $data['password'],
        $data['avatar_url'] ?? 'img/avatar.jpg',
        $data['contact_info'] ?? ''
      ],
      $temp
    );

    return $result;
  }

  function load_lots_categories($db_link) {
    $lots_categories = [];
    $sql = 'SELECT `alias`, `title` FROM categories';
    $result = db_safe_select_query($db_link, $sql, [], $lots_categories);

    return $lots_categories;
  }