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
?>
