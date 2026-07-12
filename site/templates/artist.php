<?php snippet('header') ?>

<main>
  <article>
    <h1><?= $page->title()->html() ?></h1>

    <?php if ($page->text()->isNotEmpty()): ?>
      <div>
        <?= $page->text()->kt() ?>
      </div>
    <?php endif ?>
  </article>
</main>

<?php snippet('footer') ?>
