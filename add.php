<?php
  require_once("functions.php");
  require_once("data.php");
  if(isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
      $lot = $_POST;

      $validated_fields = [
        "title" => "Введите наименование лота",
        "category" => "Выберите категорию",
        "description" => "Напишите описание лота",
        "cost" => "Введите начальную цену",
        "cost-step" => "Введите шаг ставки",
        "finish-date" => "Введите дату завершения торгов"
      ];

      $errors = form_data_validation($_POST, $validated_fields);

      if (isset($_FILES["image"]["name"])) {
        $path = "img/" . $_FILES["image"]["name"];
        $res = move_uploaded_file($_FILES["image"]["tmp_name"], $path);
      }

      if (isset($path)) {
        $lot["image_url"] = $path;
      }

      if (count($errors)) {
        $lot_page = render_template(
          'templates/add.php',
          [
            'lot' => $lot,
            'errors' => $errors,
            'lots_categories' => $lots_categories
          ]
        );
      } else {
        $lot_page = render_template('templates/lot.php', ['lot' => $lot]);
      }

    } else {
      $lot_page = render_template('templates/add.php', ['lots_categories' => $lots_categories]);
    }

    $full_page = render_template(
      'templates/layout.php',
      [
        'main_content' => $lot_page,
        'title' => $title,
        'user_avatar' => $user_avatar,
        'lots_categories' => $lots_categories
      ]
    );

    print($full_page);
  } else {
    http_response_code(403);
  }
?>
