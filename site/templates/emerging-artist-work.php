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

    <?php if ($page->medium()->isNotEmpty()): ?>
      <p><strong>Medium:</strong> <?= $page->medium()->html() ?></p>
    <?php endif ?>

    <?php if ($page->duration()->isNotEmpty()): ?>
      <p><strong>Duration:</strong> <?= $page->duration()->html() ?></p>
    <?php endif ?>

    <?php if ($page->dimensions()->isNotEmpty()): ?>
      <p><strong>Dimensions:</strong> <?= $page->dimensions()->html() ?></p>
    <?php endif ?>

    <?php if ($page->courtesy()->isNotEmpty()): ?>
      <p><strong>Courtesy:</strong> <?= $page->courtesy()->html() ?></p>
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
