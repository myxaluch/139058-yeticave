<main class="container">
  <section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
      <?php foreach($categories as $key => $category): ?>
        <li class="promo__item promo__item--<?= $key; ?>">
          <a class="promo__link" href="pages/all-lots.html"><?= $category; ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>
  <section class="lots">
    <div class="lots__header">
      <h2>Открытые лоты</h2>
    </div>
    <?= render_template('templates/lots_list.php', ['lots' => $lots]); ?>
  </section>
</main>
