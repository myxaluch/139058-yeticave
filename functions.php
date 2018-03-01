<?php
/**
 * Render templates, using buffer
 * @param string $path - path to template file
 * @param array $variables - array with variables, which are using in template file
 * @param integer $response_code - number with response HTTP code (default: 200)
 * @return bool - if file don't exist return false|string - if file exist return result of render
 */
  function render_template($path, $variables = [], $response_code = 200) {
    if (is_file($path)) {
      ob_start();

      http_response_code($response_code);
      extract($variables);
      require_once($path);

      return ob_get_clean();
    }

    return false;
  }

/**
 * Formatting cost value
 * @param $cost - formatting cost to correct format: e.g. 1456,457 -> 1456,5 ₽
 * @return string - return formatted cost
 */
  function format_cost($cost) {
    $ceil_cost = ceil($cost);
    $format_cost = number_format($ceil_cost, 0, '', ' ') . ' ₽';

    return $format_cost;
  }

/**
 * Calculate, how much time to midnight left
 * @return false|string - return, how much time to midnight left
 */
  function next_day_time_left() {
    $next_day_second_left = strtotime('tomorrow') - time();

    return date('H:i', mktime(0, 0, $next_day_second_left));
  }

/**
 * Validation function with possibility to check each field using anonymous functions
 * @param $data - validated data, e.g. from web forms
 * @param array $validated_fields_with_desc - associative array, which contains data for validation and output text
 *  for errors. Must by in this format:
 *  [
 *   'validate_field_name_1' => [
 *      'error_text' => 'Does not allow empty field',
 *      'validate_function' => function($user_data) { ... }
 *    ],
 *   'validate_field_name_2' => [
 *      'error_text' => 'Does not allow empty field',
 *      'validate_function' => function($user_data) { ... }
 *    ],
 *   ...
 *  ]
 * 'validate_function' field can be NULL
 * @return array - returns associative array of errors with texts for each founded error,
 *    where key - name of field, value - text of error
 */
  function form_data_validation($data, $validated_fields_with_desc = []) {
    $fields = array_keys($validated_fields_with_desc);
    $errors = [];

    foreach ($fields as $field) {
      if (!empty($data[$field])) {
        if (isset($validated_fields_with_desc[$field]['validate_function'])) {
          $validate_function = $validated_fields_with_desc[$field]['validate_function'];
          if(!$validate_function($data[$field])) {
            $errors[$field] = $validated_fields_with_desc[$field]['error_text'];
          }
        }
      } else {
        $errors[$field] = $validated_fields_with_desc[$field]['error_text'];
      }
    }

    return $errors;
  }

/**
 * Add value to cookie, as part of array
 * @param $cookie_name - name of cookie
 * @param $value
 * @param $time - how long set this cookie
 * @return bool - return result of cookie's sets
 */
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

/**
 * Given sub-array from array by ids
 * @param $array - source array
 * @param $ids - ids from source array
 * @return array - sub-array, which contains value by #ids from source $array
 */
  function get_sub_array($array, $ids) {
    $sub_array = [];

    foreach ($ids as $id) {
      if (array_key_exists($id, $array)) {
        $sub_array[$id] = $array[$id];
      }
    }

    return $sub_array;
  }
