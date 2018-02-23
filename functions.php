<?php
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
?>
