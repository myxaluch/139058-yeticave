<?php $error_class = isset($errors) ? "form--invalid" : ""; ?>

<form class="form form--add-lot container <?= $error_class ;?>" enctype="multipart/form-data" action="add.php" method="post">
  <h2>Добавление лота</h2>
  <div class="form__container-two">
    <?php
      $error_class = isset($errors['title']) ? "form__item--invalid" : "";
      $lot_title = isset($lot['title']) ? $lot['title'] : "";
    ?>
    <div class="form__item <?= $error_class ;?>">
      <label for="title">Наименование</label>
      <input id="title" type="text" name="title" placeholder="Введите наименование лота" value="<?= $lot_title; ?>">
      <span class="form__error"><?= isset($errors['title']) ? $errors['title'] : ""; ?></span>
    </div>
    <?php
      $error_class = isset($errors['category']) ? "form__item--invalid" : "";
      $category_title = isset($lot['category']) ? $lot['category'] : "";
    ?>
    <div class="form__item <?= $error_class ;?>">
      <label for="category">Категория</label>
      <select id="category" name="category">
        <option>Выберите категорию</option>
        <?php foreach ($lots_categories as $category): ?>
          <?php if($category['title'] == $category_title): ?>
            <option value="<?= $category['id']; ?>" selected><?= $category['title']; ?></option>
          <?php else: ?>
            <option value="<?= $category['id']; ?>" ><?= $category['title']; ?></option>
          <?php endif; ?>
        <?php endforeach; ?>
      </select>
      <span class="form__error"><?= isset($errors['title']) ? $errors['title'] : ""; ?></span>
    </div>
  </div>
  <?php
    $error_class = isset($errors['description']) ? "form__item--invalid" : "";
    $lot_description = isset($lot['description']) ? $lot['description'] : "";
  ?>
  <div class="form__item form__item--wide <?= $error_class ;?>">
    <label for="description">Описание</label>
    <textarea id="description" name="description" placeholder="Напишите описание лота"><?= $lot_description; ?></textarea>
    <span class="form__error"><?= isset($errors['description']) ? $errors['description'] : ""; ?></span>
  </div>
  <?php
    $error_class = isset($errors['image']) ? 'form__item--invalid' : '';
    $lot_image_url = isset($lot['image_url']) ? $lot['image_url'] : '';
    $uploaded_class = isset($lot['image_url']) ? 'form__item--uploaded' : '';
  ?>
  <div class="form__item form__item--file <?= $error_class; ?> <?= $uploaded_class; ?>">
    <label>Изображение</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src=" <?= $lot_image_url; ?>" width="113" height="113" alt="Изображение лота">
      </div>
    </div>
    <div class="form__input-file">
      <input class="visually-hidden" type="file" id="photo2" name="image" value="">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
    <span class="form__error"><?= isset($errors['image']) ? $errors['image'] : ""; ?></span>
  </div>
  <div class="form__container-three">
    <?php
      $error_class = isset($errors['cost']) ? "form__item--invalid" : "";
      $lot_cost = isset($lot['cost']) ? $lot['cost'] : "";
    ?>
    <div class="form__item form__item--small <?= $error_class ;?>">
      <label for="cost">Начальная цена</label>
      <input id="cost" type="number" name="cost" placeholder="0" value="<?= $lot_cost; ?>">
      <span class="form__error"><?= isset($errors['cost']) ? $errors['cost'] : ""; ?></span>
    </div>
    <?php
      $error_class = isset($errors['cost-step']) ? "form__item--invalid" : "";
      $lot_cost_step = isset($lot['cost-step']) ? $lot['cost-step'] : "";
    ?>
    <div class="form__item form__item--small <?= $error_class ;?>">
      <label for="cost-step">Шаг ставки</label>
      <input id="cost-step" type="number" name="cost-step" placeholder="0" value="<?= $lot_cost_step; ?>">
      <span class="form__error"><?= isset($errors['cost-step']) ? $errors['cost-step'] : ""; ?></span>
    </div>
    <?php
      $error_class = isset($errors['finish-date']) ? "form__item--invalid" : "";
      $lot_finish_date = isset($lot['finish-date']) ? $lot['finish-date'] : "";
    ?>
    <div class="form__item <?= $error_class ;?>">
      <label for="lot-date">Дата окончания торгов</label>
      <input class="form__input-date" id="lot-date" type="date" name="finish-date" value="<?= $lot_finish_date ?>">
      <span class="form__error"><?= isset($errors['finish-date']) ? $errors['finish-date'] : ""; ?></span>
    </div>
  </div>
  <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Добавить лот</button>
</form>
