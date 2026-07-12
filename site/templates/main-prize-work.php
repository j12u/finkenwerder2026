<?php snippet('header') ?>

<main>
  <article>
    <h1><?= $page->title()->html() ?></h1>

    <?php if ($page->images()->isNotEmpty()): ?>
      <div>
        <?php foreach ($page->images() as $image): ?>
          <figure>
            <img src="<?= $image->url() ?>" alt="<?= $image->alt()->or($page->title())->html() ?>">
          </figure>
        <?php endforeach ?>
      </div>
    <?php endif ?>

    <?php if ($page->year()->isNotEmpty()): ?>
      <p><strong>Year:</strong> <?= $page->year()->html() ?></p>
    <?php endif ?>

    <?php if ($page->material()->isNotEmpty()): ?>
      <p><strong>Material:</strong> <?= $page->material()->html() ?></p>
    <?php endif ?>

    <?php if ($page->description()->isNotEmpty()): ?>
      <div>
        <?= $page->description()->kt() ?>
      </div>
    <?php endif ?>

    <?php if ($page->text()->isNotEmpty()): ?>
      <div>
        <?= $page->text()->kt() ?>
      </div>
    <?php endif ?>
  </article>
</main>

<?php snippet('footer') ?>
