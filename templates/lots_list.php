<ul class="lots__list">
  <?php foreach ($lots as $lot): ?>
    <li class="lots__item lot">
      <div class="lot__image">
        <img src="<?= htmlspecialchars($lot['image_url']); ?>" width="350" height="260"
          alt="<?= htmlspecialchars($lot['title']); ?>">
      </div>
      <div class="lot__info">
        <span class="lot__category"><?= htmlspecialchars($lot['category']); ?></span>
        <h3 class="lot__title">
          <a class="text-link" href="lot.php?lot_id=<?= $lot['id']; ?>"><?= htmlspecialchars($lot['title']); ?></a>
        </h3>
        <div class="lot__state">
          <div class="lot__rate">
            <span class="lot__amount">Стартовая цена</span>
            <span class="lot__cost"><?= htmlspecialchars(format_cost($lot['cost'])); ?></span>
          </div>
          <div class="lot__timer timer">
            <?= next_day_time_left(); ?>
          </div>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>
