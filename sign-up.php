<?php
  require_once('init.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form = $_POST;

    $validated_fields = [
      'email' => [
        'error_text' => 'Введите корректный email',
        'validate_function' => function($user_data) { return filter_var($user_data, FILTER_VALIDATE_EMAIL); }
      ],
      'password' => [
        'error_text' => 'Введите пароль'
      ],
      'name' => [
        'error_text' => 'Введите имя'
      ],
      'contact_info' => [
        'error_text' => 'Напишите, как с Вами связаться'
      ]
    ];

    $errors = form_data_validation($_POST, $validated_fields);

    if (!empty($_FILES['avatar']['name'])) {
      $tmp_name = $_FILES['avatar']['tmp_name'];
      $path = 'img/' . $_FILES['avatar']['name'];

      $file_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $tmp_name);

      if ($file_type !== 'image/png' && $file_type !== 'image/jpeg') {
        $errors['avatar'] = 'Загрузите аватарку в формате PNG/JPEG';
      } else {
        $res = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
        $form['avatar_url'] = $path;
      }
    }

    if (!count($errors)) {
      $result = add_new_user($db_link, $form,$errors);

      if ($result) {
        $_SESSION['user'] = $form;
        header('Location: index.php');
        exit();
      }
    }

    if(count($errors)) {
      $main_content = render_template('templates/sign-up.php', ['form' => $form, 'errors' => $errors]);
    } else {
      header('Location: index.php');
      exit();
    }
  } else {
    if ($current_user) {
      $main_content = render_template('templates/welcome.php', ['username' => $current_user['name']]);
    }
    else {
      $main_content = render_template('templates/sign-up.php', []);
    }
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
