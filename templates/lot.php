<section class="lot-item container">
  <?php if (isset($lot)): ?>
    <?php $minimal_rate = isset($minimal_rate) ? $minimal_rate : $lot['cost-step'] ?>
    <h2><?= htmlspecialchars($lot['title']); ?></h2>
    <div class="lot-item__content">
      <div class="lot-item__left">
        <div class="lot-item__image">
          <img src="<?= htmlspecialchars($lot['image_url']); ?>" width="730" height="548" alt="<?= htmlspecialchars($lot['title']); ?>">
        </div>
        <p class="lot-item__category"><?= htmlspecialchars($lot['category']); ?></span></p>
        <p class="lot-item__description"><?= htmlspecialchars($lot['description']); ?></p>
      </div>
      <div class="lot-item__right">
        <?php if (isset($current_user)): ?>
          <div class="lot-item__state">
            <div class="lot-item__timer timer">
              10:54:12
            </div>
            <div class="lot-item__cost-state">
              <div class="lot-item__rate">
                <span class="lot-item__amount">Текущая цена</span>
                <span class="lot-item__cost"><?= htmlspecialchars(format_cost($lot['cost'])); ?></span>
              </div>
              <div class="lot-item__min-cost">
                Мин. ставка <span><?= htmlspecialchars(format_cost($minimal_rate)); ?></span>
              </div>
            </div>
            <?php if($current_user['id'] !== $lot['author_id']): ?>
              <?php $form_error_class = isset($errors) ? "form--invalid" : ""; ?>
              <form class="lot-item__form <=? $form_error_class; ?>" action="add_rate.php" method="post">
                <?php $error_class = isset($errors['rate']) ? "form__item--invalid" : ""; ?>
                <p class="lot-item__form-item <?= $error_class; ?>">
                  <label for="rate">Ваша ставка</label>
                  <input id="rate" type="number" name="rate" placeholder="<?= htmlspecialchars(format_cost($minimal_rate)); ?>">
                  <input class="visually-hidden" type="number" id="lot_id" name="lot_id" value="<?= $lot['id']; ?>">
                  <span class="form__error"><?= isset($errors['rate']) ? $errors['rate'] : ""; ?></span>
                </p>
                <button type="submit" class="button">Сделать ставку</button>
              </form>
            <?php endif; ?>
          </div>
          <div class="history">
            <h3>История ставок (<span><?= count($rates); ?></span>)</h3>
            <table class="history__list">
            <?php foreach ($rates as $rate): ?>
              <tr class="history__item">
                <td class="history__name"><?= $rate['author']; ?></td>
                <td class="history__price"><?= htmlspecialchars($rate['amount']); ?></td>
                <td class="history__time"><?= human_date_format($rate['created_at']); ?></td>
              </tr>
            <?php endforeach; ?>
            </table>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
</section>
