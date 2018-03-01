<?php $error_class = isset($errors) ? "form--invalid" : ""; ?>

<form class="form container <?= $error_class; ?>" enctype="multipart/form-data" action="sign-up.php" method="post">
  <h2>Регистрация нового аккаунта</h2>
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
  <div class="form__item <?= $error_class; ?>">
    <label for="password">Пароль*</label>
    <input id="password" type="password" name="password" placeholder="Введите пароль">
    <span class="form__error"><?= isset($errors['password']) ? $errors['password'] : ""; ?></span>
  </div>
  <?php
    $error_class = isset($errors['name']) ? "form__item--invalid" : "";
    $user_name = isset($form['name']) ? $form['name'] : "";
  ?>
  <div class="form__item <?= $error_class; ?>">
    <label for="name">Имя*</label>
    <input id="name" type="text" name="name" placeholder="Введите имя" value="<?= $user_name; ?>">
    <span class="form__error"><?= isset($errors['name']) ? $errors['name'] : ""; ?></span>
  </div>
  <?php
    $error_class = isset($errors['contact_info']) ? "form__item--invalid" : "";
    $user_description = isset($form['contact_info']) ? $form['contact_info'] : null;
  ?>
  <div class="form__item <?= $error_class; ?>">
    <label for="contact_info">Контактные данные*</label>
    <textarea id="contact_info" name="contact_info" placeholder="Напишите как с вами связаться"><?= $user_description; ?></textarea>
    <span class="form__error"><?= isset($errors['contact_info']) ? $errors['contact_info'] : ""; ?></span>
  </div>
  <?php $user_avatar_url = isset($lot['avatar_url']) ? $lot['avatar_url'] : ''; ?>
  <div class="form__item form__item--file form__item--last">
    <label>Аватар</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="<?= $user_avatar_url; ?>" width="113" height="113" alt="Ваш аватар">
      </div>
    </div>
    <div class="form__input-file">
      <input class="visually-hidden" type="file" id="photo2" name="avatar" value="">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
  </div>
  <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Зарегистрироваться</button>
  <a class="text-link" href="login.php">Уже есть аккаунт</a>
</form>

