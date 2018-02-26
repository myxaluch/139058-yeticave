<?php $error_class = isset($errors) ? "form--invalid" : ""; ?>

<form class="form container <?= $error_class; ?>" action="login.php" method="post">
  <h2>Вход</h2>
  <?php
    $error_class = isset($errors['email']) ? "form__item--invalid" : "";
    $user_email = isset($form['email']) ? $form['email'] : "";
  ?>
  <div class="form__item <?= $error_class; ?>">
    <label for="email">E-mail*</label>
    <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= $user_email; ?>">
    <span class="form__error"><?= isset($errors['email']) ? $errors['email'] : ""; ?></span>
  </div>
  <?php
    $error_class = isset($errors['password']) ? "form__item--invalid" : "";
  ?>
  <div class="form__item form__item--last <?= $error_class; ?>">
    <label for="password">Пароль*</label>
    <input id="password" type="password" name="password" placeholder="Введите пароль">
    <span class="form__error"><?= isset($errors['password']) ? $errors['password'] : ""; ?></span>
  </div>
  <button type="submit" class="button">Войти</button>
</form>
