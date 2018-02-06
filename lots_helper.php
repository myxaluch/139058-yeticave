<?php
  function format_cost($cost) {
    $ceil_cost = ceil($cost);
    $result_cost = ($ceil_cost < 1000) ? $ceil_cost : number_format($ceil_cost, 0, '', ' ');

    return($result_cost . ' ₽');
  }
?>
