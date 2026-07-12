<?php snippet('header') ?>

<main class="landing">

  <?php if ($mainPrize = page('main-prize')): ?>
    <?php
    $mainPrizeArtist = $mainPrize->children()->listed()->filterBy('intendedTemplate', 'artist')->first();
    $mainPrizeWorks = $mainPrize->children()->listed()->filterBy('intendedTemplate', 'main-prize-work');
    ?>

    <?php if ($mainPrizeArtist || $mainPrizeWorks->isNotEmpty()): ?>
      <ul class="tree">
        <li>
          <button class="tree-toggle" type="button" aria-expanded="false">
            <?= $mainPrize->title()->html() ?>
          </button>
          <ul class="tree-children">
            <?php if ($mainPrizeArtist): ?>
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
            <?php endif ?>

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
      </ul>
    <?php endif ?>
  <?php endif ?>



  <section class="landing-section" id="emerging-artist">
    <?php if ($emergingArtist = page('emerging-artist')): ?>
      <h1><?= $emergingArtist->title() ?></h1>
      <div class="section-text">
        <?= $emergingArtist->text()->kt() ?>

        <?php
        $emergingArtistPage = $emergingArtist->children()->listed()->filterBy('intendedTemplate', 'artist')->first();
        $emergingWorks = $emergingArtist->children()->listed()->filterBy('intendedTemplate', 'emerging-artist-work');
        ?>

        <?php if ($emergingArtistPage || $emergingWorks->isNotEmpty()): ?>
          <ul>
            <?php if ($emergingArtistPage): ?>
              <li>
                <a href="<?= $emergingArtistPage->url() ?>"><?= $emergingArtistPage->title()->html() ?></a>
              </li>
            <?php endif ?>

            <?php foreach ($emergingWorks as $work): ?>
              <li>
                <a href="<?= $work->url() ?>"><?= $work->title()->html() ?></a>
              </li>
            <?php endforeach ?>
          </ul>
        <?php endif ?>
      </div>
    <?php endif ?>
  </section>



   <section class="landing-section" id="about">
    <?php if ($about = page('about')): ?>
      <h1><?= $about->title() ?></h1>
      <div class="section-text">
        <?= $about->text()->kt() ?>
      </div>
    <?php endif ?>
  </section>

  <section class="landing-section" id="imprint">
    <?php if ($imprint = page('imprint')): ?>
      <h1><?= $imprint->title() ?></h1>
      <div class="section-text">
        <?= $imprint->text()->kt() ?>
      </div>
    <?php endif ?>
  </section>

  <section class="landing-section" id="data">
    <?php if ($data = page('data-privacy')): ?>
      <h1><?= $data->title() ?></h1>
      <div class="section-text">
        <?= $data->text()->kt() ?>
      </div>
    <?php endif ?>
  </section>

</main>

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
