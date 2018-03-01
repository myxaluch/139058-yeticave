
<div class="container">
  <h2>История</h2>
  <a class="text-link" href='clean_history.php'>Очистить историю</a>
  <section class="lots">
    <?= render_template('templates/lots_list.php', ['lots' => $lots]); ?>
  </section>
</div>
