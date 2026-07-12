<!DOCTYPE html>
<html lang="<?= $kirby->language()?->code() ?? 'en' ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $site->title() ?></title>
  <?= css('assets/css/index.css') ?>
</head>
<body>

<header class="site-header">
  <a class="site-title" href="<?= $site->url() ?>">
    <?= $site->title() ?>
  </a>

  <?php if ($kirby->languages()->count() > 1): ?>
    <nav class="language-switch">
      <?php foreach ($kirby->languages() as $language): ?>
        <a href="<?= $page->url($language->code()) ?>">
          <?= strtoupper($language->code()) ?>
        </a>
      <?php endforeach ?>
    </nav>
  <?php endif ?>
</header>
