<?php
  require_once('init.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $validated_fields = [
      'email' => [
        'error_text' => 'Введите email'
      ],
      'password' => [
        'error_text' => 'Введите пароль'
      ]
    ];

    $errors = form_data_validation($_POST, $validated_fields);

    if (!count($errors)) {
      $user = search_user_by_email($form['email'], $db_link);
      if ($user) {
        if (password_verify($form['password'], $user['password'])) {
          $_SESSION['user'] = $user;
        } else {
          $errors['password'] = 'Неверный пароль';
        }
      } else {
        $errors['email'] = 'Пользователя с таким email не существует';
      }
    }

    if(count($errors)) {
      $main_content = render_template('templates/login.php', ['form' => $form, 'errors' => $errors]);
    } else {
      header('Location: index.php');
      exit();
    }
  } else {
    if ($current_user) {
      $main_content = render_template('templates/welcome.php', ['username' => $current_user['name']]);
    }
    else {
      $main_content = render_template('templates/login.php', []);
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
?>
