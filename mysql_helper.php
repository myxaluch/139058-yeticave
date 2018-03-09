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

/**
 * @param $db_link - current link to DB
 * @param $sql - SQL query (SELECT statement)
 * @param array $data - data for SQL query
 * @param $result - return template with errors, if it was, in other way - return data from database
 * @return bool - return status of query
 */
  function db_safe_select_query($db_link, $sql, $data = [], &$result) {
    if (!$db_link) {
      $result = mysqli_connect_error();
      return false;
    }

    $stmt = db_get_prepare_stmt($db_link, $sql, $data);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if (!$res) {
      $result = mysqli_errno();
      return false;
    }

    $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
    return true;
  }

/**
 * @param $db_link - current link to DB
 * @param $sql - SQL query (INSERT, UPDATE and DELETE statements)
 * @param array $data - data for SQL query
 * @param $error - return errors, if it was
 * @return bool - return status of query
 */
  function db_safe_query($db_link, $sql, $data = [], &$error) {
    if (!$db_link) {
      $error = mysqli_connect_error();
      return false;
    }

    $stmt = db_get_prepare_stmt($db_link, $sql, $data);
    $res = mysqli_stmt_execute($stmt);

    if (!$res) {
      $error = mysqli_errno();
      return false;
    }

    return true;
  }

  /**
   * Search user by given email
   * @param $email - given email
   * @param $db_link - current link to DB
   * @return array - founded user
   */
  function search_user_by_email($email, $db_link) {
    $user= [];
    $sql = 'SELECT * FROM users WHERE email = ? LIMIT 1';

    db_safe_select_query($db_link, $sql, [$email], $user);

    return array_key_exists('0', $user) ? $user[0] : null;
  }

  function search_lots_by_ids($ids, $db_link) {
    $lots = [];
    $ids = implode(', ', $ids);
    $sql = 'SELECT
              lots.id,
              lots.author_id,
              lots.title,
              lots.description, 
              lots.image_url,
              lots.start_rate as cost, 
              lots.rate_step as `cost-step`, 
              categories.title as category
              FROM lots
              JOIN categories ON lots.category_id = categories.id 
              WHERE lots.id = ?';

    db_safe_select_query($db_link, $sql, [$ids], $lots);

    return $lots;
  }

  function load_opened_recent_lots($db_link) {
    $lots = [];
    $sql = 'SELECT
              lots.id,
              lots.author_id, 
              lots.title,
              lots.start_rate as cost, 
              lots.image_url,
              COUNT(rates.id) AS rates_count, 
              categories.title as category
            FROM lots
            JOIN categories ON lots.category_id = categories.id
            LEFT JOIN rates ON lots.id = rates.lot_id
            WHERE
             lots.finished_at > NOW()
            GROUP BY
              lots.id,
              lots.title,
              lots.start_rate,
              lots.image_url,
              categories.title';
    db_safe_select_query($db_link, $sql, [], $lots);
    return $lots;
  }

  function search_lot_by_id($id, $db_link) {
    $search_result = search_lots_by_ids([$id], $db_link);

    return array_key_exists('0', $search_result) ? $search_result['0'] : null;
  }

  function search_rates_by_lot($lot_id, $db_link) {
    $rates = [];
    $sql = 'SELECT rates.*, users.name as author
              FROM rates
              JOIN users ON rates.author_id = users.id 
              WHERE rates.lot_id = ?
              ORDER BY rates.created_at DESC';

    db_safe_select_query($db_link, $sql, [$lot_id], $rates);

    return $rates;
  }

/**
 * @param $db_link - current link to DB
 * @param $data - array of data of new user
 * @param $errors - array, where contains errors
 * @return bool|null - return true, if insert was successful, in other way - false
 */
  function add_new_user($db_link, &$data, &$errors) {
    $result = null;

    $existed_user = search_user_by_email($data['email'], $db_link);
    if ($existed_user) {
      $errors['email'] = 'Пользователь с таким email уже существует';
      return false;
    }

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
      $errors
    );
    $data['id'] = mysqli_insert_id($db_link);

    return $result;
  }

/**
 * @param $data - array of data of new user
 * @param $db_link - current link to DB
 * @return bool|null - return true, if insert was successful, in other way - false
 */
  function add_new_lot(&$data, $db_link) {
  $result = null;

  $insert_sql = 'INSERT INTO lots(`author_id`, `category_id`, `title`, `description`, `start_rate`, `rate_step`, `image_url`, `finished_at`, `created_at`) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())';
  $result = db_safe_query(
    $db_link,
    $insert_sql,
    [
      $_SESSION['user']['id'],
      $data['category'],
      $data['title'],
      $data['description'],
      $data['cost'],
      $data['cost-step'],
      $data['image_url'] ?? '',
      $data['finish-date']
    ],
    $temp
  );

  if ($result) {
    $data['id'] = mysqli_insert_id($db_link);
  }

  return $result;
}

/**
 * @param $data - array of data of new rate
 * @param $current_user - current logged user
 * @param $db_link - current link to DB
 * @return bool - return true, if insert was successful
 */
function add_new_rate(&$data, $current_user, $db_link) {
    $result = null;

    $insert_sql = 'INSERT INTO rates(`author_id`, `lot_id`, `amount`, `created_at`)
                      VALUES(?, ?, ?, NOW())';

    $result = db_safe_query(
      $db_link,
      $insert_sql,
      [
        $current_user['id'],
        $data['lot_id'],
        $data['rate']
      ],
      $temp
    );

    return $result;
  }

/**
 * @param $db_link - current link to DB
 * @return array - array of lot's categories
 */
  function load_lots_categories($db_link) {
    $lots_categories = [];
    $sql = 'SELECT * FROM categories';
    db_safe_select_query($db_link, $sql, [], $lots_categories);

    return $lots_categories;
  }

/**
 * @param $db_link - current link to DB
 * @param $user_data - array of user data for authenication
 * @param $errors - array with errors
 * @return boolean - return true, if user authenticated correctly
 */
function authenticate_user($db_link, $user_data, &$errors) {
  $user = search_user_by_email($user_data['email'], $db_link);
  if ($user) {
    if (password_verify($user_data['password'], $user['password'])) {
      $_SESSION['user'] = $user;
      return true;
    } else {
      $errors['password'] = 'Неверный пароль';
      return false;
    }
  } else {
    $errors['email'] = 'Пользователя с таким email не существует';
    return false;
  }
}