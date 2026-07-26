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

  <?php if ($kirby->languages()->count() > 1 && $page->isHomePage() === false): ?>
    <nav class="language-switch">
      <?php foreach ($kirby->languages() as $language): ?>
        <a href="<?= $page->url($language->code()) ?>"<?= $kirby->language()?->code() === $language->code() ? ' aria-current="true"' : '' ?>>
          <?= strtoupper($language->code()) ?>
        </a>
      <?php endforeach ?>
    </nav>
  <?php endif ?>
</header>
