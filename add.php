<?php
  require_once('init.php');

  if($current_user) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $lot = $_POST;

      $validated_fields = [
        'title' => [
          'error_text' => 'Введите наименование лота'
        ],
        'category' => [
          'error_text' => 'Выберите категорию',
          'validate_function' => function($user_data) { return(intval($user_data) > 0); }
        ],
        'description' => [
          'error_text' => 'Напишите описание лота'
        ],
        'cost' => [
          'error_text' => 'Введите начальную цену (должна быть больше нуля)',
          'validate_function' => function($user_data) { return(intval($user_data) > 0); }
        ],
        'cost-step' => [
          'error_text' => 'Введите шаг ставки (должна быть целым число больше нуля)',
          'validate_function' => function($user_data) { return(intval($user_data) > 0); }
        ],
        'finish-date' => [
          'error_text' => 'Введите дату завершения торгов (в формате ДД.ММ.ГГГГ и больше текущего дня)',
          'validate_function' => function($user_data) {
            $date = date_create_from_format('Y-m-d', $user_data);
            if($date) {
              return($user_data > date('Y-m-d'));
            }
           }
         ]
      ];

      $errors = form_data_validation($_POST, $validated_fields);

      if (!empty($_FILES['image']['name'])) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $path = 'img/' . $_FILES['image']['name'];

        $file_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $tmp_name);

        if ($file_type !== 'image/png' && $file_type !== 'image/jpeg') {
          $errors['image'] = 'Загрузите картинку в формате PNG/JPEG';
        } else {
          $res = move_uploaded_file($_FILES['image']['tmp_name'], $path);
          $lot['image_url'] = $path;
        }
      } elseif(empty($lot['image_url'])) {
        $errors['image'] = 'Загрузите картинку в формате PNG/JPEG';
      }

      if (count($errors)) {
        $main_content = render_template(
          'templates/add.php',
          [
            'lot' => $lot,
            'errors' => $errors,
            'lots_categories' => $lots_categories
          ]
        );
      } else {
        $insert_status = add_new_lot($lot, $db_link);
        header('Location: lot.php?lot_id='. $lot['id']);
      }
    } else {
      $main_content = render_template('templates/add.php', ['lots_categories' => $lots_categories]);
    }
  } else {
    $main_content = render_template('templates/error.php', ['error' => 'Доступ ограничен'], 403);
  }

  $full_page = render_template(
    'templates/layout.php',
    [
      'main_content' => $main_content,
      'title' => $title,
      'current_user' => $current_user,
      'lots_categories' => $lots_categories
    ]
  );

  print($full_page);
