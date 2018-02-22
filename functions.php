<?php
  session_start();

  function render_template($path, $variables = []) {
    if (is_file($path)) {
      ob_start();

      extract($variables);
      require_once($path);

      return ob_get_clean();
    }
    return false;
  }

  function format_cost($cost) {
    $ceil_cost = ceil($cost);
    $format_cost = number_format($ceil_cost, 0, '', ' ') . ' ₽';

    return $format_cost;
  }

  function next_day_time_left() {
    $next_day_second_left = strtotime('tomorrow') - time();

    return date('H:i', mktime(0, 0, $next_day_second_left));
  }

  function form_data_validation($data, $validated_fields_with_desc = []) {
    $fields = array_keys($validated_fields_with_desc);
    $errors = [];

    foreach ($fields as $field) {
      if (empty($data[$field])) {
        $errors[$field] = $validated_fields_with_desc[$field];
      }
    }

    return $errors;
  }

  function add_value_to_cookie_array($cookie_name, $value, $time) {
    if (isset($_COOKIE[$cookie_name])) {
      $viewed_cookie = json_decode($_COOKIE[$cookie_name]);
    } else {
      $viewed_cookie = [];
    }

    if (!in_array($value, $viewed_cookie)) {
      $viewed_cookie[] = $value;
    }

    return setcookie($cookie_name, json_encode($viewed_cookie), $time);
  }

  function get_sub_array($array, $ids) {
    $sub_array = [];

    foreach ($ids as $id) {
      if (array_key_exists($id, $array)) {
        $sub_array[$id] = $array[$id];
      }
    }

    return $sub_array;
  }

  function search_user_by_email($email, $users) {
    $result = null;

    foreach ($users as $user) {
      if ($user['email'] == $email) {
        $result = $user;
        break;
      }
    }

    return $result;
  }
?>
