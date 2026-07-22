<?php snippet('header') ?>

<main class="landing">
  <?php if ($mainPrize = page('main-prize')): ?>
    <?php
    $mainPrizeArtist = $mainPrize->children()->listed()->filterBy('intendedTemplate', 'artist')->first();
    $mainPrizeWorks = $mainPrize->children()->listed()->filterBy('intendedTemplate', 'main-prize-work');
    ?>

    <?php if ($mainPrizeArtist || $mainPrizeWorks->isNotEmpty()): ?>
      <section class="landing-section" id="main-prize">
        <h1><?= $mainPrize->title()->html() ?></h1>

        <ul class="tree">
          <?php if ($mainPrizeArtist): ?>
            <li>
              <h2>Artist</h2>
              <ul class="tree tree-group">
                <li>
                  <button class="tree-toggle" type="button" aria-expanded="false">
                    <?= $mainPrizeArtist->title()->html() ?>
                  </button>
                  <ul class="tree-children">
                    <?php if ($mainPrizeArtist->text()->isNotEmpty()): ?>
                      <li><?= $mainPrizeArtist->text()->kt() ?></li>
                    <?php endif ?>
                  </ul>
                </li>
              </ul>
            </li>
          <?php endif ?>

          <?php if ($mainPrizeWorks->isNotEmpty()): ?>
            <li>
              <h2>Works</h2>
              <ul class="tree tree-group">
                <?php foreach ($mainPrizeWorks as $work): ?>
                  <li>
                    <button class="tree-toggle" type="button" aria-expanded="false">
                      <?= $work->title()->html() ?>
                    </button>
                    <ul class="tree-children">
                      <?php if ($work->year()->isNotEmpty()): ?>
                        <li>Year: <?= $work->year()->html() ?></li>
                      <?php endif ?>
                      <?php if ($work->material()->isNotEmpty()): ?>
                        <li>Material: <?= $work->material()->html() ?></li>
                      <?php endif ?>
                      <?php if ($work->description()->isNotEmpty()): ?>
                        <li><?= $work->description()->kt() ?></li>
                      <?php endif ?>
                    </ul>
                  </li>
                <?php endforeach ?>
              </ul>
            </li>
          <?php endif ?>
        </ul>
      </section>
    <?php endif ?>
  <?php endif ?>

  <?php if ($emergingArtist = page('emerging-artist')): ?>
    <?php
    $emergingArtistPage = $emergingArtist->children()->listed()->filterBy('intendedTemplate', 'artist')->first();
    $emergingWorks = $emergingArtist->children()->listed()->filterBy('intendedTemplate', 'emerging-artist-work');
    ?>

    <section class="landing-section" id="emerging-artist">
      <h1><?= $emergingArtist->title()->html() ?></h1>

      <?php if ($emergingArtist->text()->isNotEmpty()): ?>
        <div class="section-text">
          <?= $emergingArtist->text()->kt() ?>
        </div>
      <?php endif ?>

      <?php if ($emergingArtistPage || $emergingWorks->isNotEmpty()): ?>
        <ul class="tree">
          <?php if ($emergingArtistPage): ?>
            <li>
              <h2>Artist</h2>
              <ul class="tree tree-group">
                <li>
                  <button class="tree-toggle" type="button" aria-expanded="false">
                    <?= $emergingArtistPage->title()->html() ?>
                  </button>
                  <ul class="tree-children">
                    <?php if ($emergingArtistPage->text()->isNotEmpty()): ?>
                      <li><?= $emergingArtistPage->text()->kt() ?></li>
                    <?php endif ?>
                  </ul>
                </li>
              </ul>
            </li>
          <?php endif ?>

          <?php if ($emergingWorks->isNotEmpty()): ?>
            <li>
              <h2>Works</h2>
              <ul class="tree tree-group">
                <?php foreach ($emergingWorks as $work): ?>
                  <li>
                    <button class="tree-toggle" type="button" aria-expanded="false">
                      <?= $work->title()->html() ?>
                    </button>
                    <ul class="tree-children">
                      <?php if ($work->year()->isNotEmpty()): ?>
                        <li>Year: <?= $work->year()->html() ?></li>
                      <?php endif ?>
                      <?php if ($work->medium()->isNotEmpty()): ?>
                        <li>Medium: <?= $work->medium()->html() ?></li>
                      <?php endif ?>
                      <?php if ($work->duration()->isNotEmpty()): ?>
                        <li>Duration: <?= $work->duration()->html() ?></li>
                      <?php endif ?>
                      <?php if ($work->dimensions()->isNotEmpty()): ?>
                        <li>Dimensions: <?= $work->dimensions()->html() ?></li>
                      <?php endif ?>
                      <?php if ($work->courtesy()->isNotEmpty()): ?>
                        <li>Courtesy: <?= $work->courtesy()->html() ?></li>
                      <?php endif ?>
                      <?php if ($work->description()->isNotEmpty()): ?>
                        <li><?= $work->description()->kt() ?></li>
                      <?php endif ?>
                    </ul>
                  </li>
                <?php endforeach ?>
              </ul>
            </li>
          <?php endif ?>
        </ul>
      <?php endif ?>
    </section>
  <?php endif ?>

  <?php if ($about = page('about')): ?>
    <section class="landing-section" id="about">
      <?php if ($about->text()->isNotEmpty()): ?>
      <?php endif ?>

      <ul class="tree tree-group">
        <li>
          <button class="tree-toggle" type="button" aria-expanded="false">
            <?= $about->title()->html() ?>
          </button>
          <ul class="tree-children">
            <?php if ($about->text()->isNotEmpty()): ?>
              <li><?= $about->text()->kt() ?></li>
            <?php endif ?>
          </ul>
        </li>
      </ul>
    </section>
  <?php endif ?>

  <?php if ($about = page('imprint')): ?>
    <section class="landing-section" id="imprint">
      <?php if ($about->text()->isNotEmpty()): ?>
      <?php endif ?>

      <ul class="tree tree-group">
        <li>
          <button class="tree-toggle" type="button" aria-expanded="false">
            <?= $about->title()->html() ?>
          </button>
          <ul class="tree-children">
            <?php if ($about->text()->isNotEmpty()): ?>
              <li><?= $about->text()->kt() ?></li>
            <?php endif ?>
          </ul>
        </li>
      </ul>
    </section>
  <?php endif ?>

   <?php if ($about = page('data-privacy')): ?>
    <section class="landing-section" id="data-privacy">
      <?php if ($about->text()->isNotEmpty()): ?>
      <?php endif ?>

      <ul class="tree tree-group">
        <li>
          <button class="tree-toggle" type="button" aria-expanded="false">
            <?= $about->title()->html() ?>
          </button>
          <ul class="tree-children">
            <?php if ($about->text()->isNotEmpty()): ?>
              <li><?= $about->text()->kt() ?></li>
            <?php endif ?>
          </ul>
        </li>
      </ul>
    </section>
  <?php endif ?>



<script>
  document.querySelectorAll(".tree-toggle").forEach((toggle) => {
    toggle.addEventListener("click", () => {
      const nested = toggle.nextElementSibling;

      if (!nested) return;

      nested.classList.toggle("is-open");
      toggle.classList.toggle("is-open");
      toggle.setAttribute(
        "aria-expanded",
        nested.classList.contains("is-open") ? "true" : "false"
      );
    });
  });
</script>

<?php snippet('footer') ?>
