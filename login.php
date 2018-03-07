<?php
  require_once('init.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form = $_POST;

    $validated_fields = [
      'email' => [
        'error_text' => 'Введите корректный email',
        'validated_function' => function($user_data) { return(filter_var($user_data, FILTER_VALIDATE_EMAIL)); }
      ],
      'password' => [
        'error_text' => 'Введите пароль'
      ]
    ];

    $errors = form_data_validation($_POST, $validated_fields);

    if (!count($errors)) {
      authenticate_user($db_link, $form, $errors);
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
