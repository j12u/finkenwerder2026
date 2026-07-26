<?php snippet('header') ?>

<main class="landing">
  <?php if ($mainPrize = page('main-prize')): ?>
    <?php
    $mainPrizeArtist = $mainPrize->children()->listed()->filterBy('intendedTemplate', 'artist')->first();
    $mainPrizeWorks = $mainPrize->children()->listed()->filterBy('intendedTemplate', 'main-prize-work');
    ?>

    <?php if ($mainPrizeArtist || $mainPrizeWorks->isNotEmpty()): ?>
      <section class="landing-section" id="main-prize">
        <div class="tree-root-row">
          <p><?= $mainPrize->title()->html() ?></p>

          <ul class="tree">
            <?php if ($mainPrizeArtist): ?>
              <li>
                <p>Artist</p>
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
                <p>Works</p>
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
                        <?php if ($work->images()->isNotEmpty()): ?>
                          <li class="work-images">
                            <?php foreach ($work->images() as $image): ?>
                              <figure>
                                <img src="<?= $image->url() ?>" alt="<?= $image->alt()->or($work->title())->html() ?>">
                              </figure>
                            <?php endforeach ?>
                          </li>
                        <?php endif ?>
                      </ul>
                    </li>
                  <?php endforeach ?>
                </ul>
              </li>
            <?php endif ?>
          </ul>
        </div>
      </section>
    <?php endif ?>
  <?php endif ?>

  <?php if ($emergingArtist = page('emerging-artist')): ?>
    <?php
    $emergingArtistPage = $emergingArtist->children()->listed()->filterBy('intendedTemplate', 'artist')->first();
    $emergingWorks = $emergingArtist->children()->listed()->filterBy('intendedTemplate', 'emerging-artist-work');
    ?>

    <section class="landing-section" id="emerging-artist">
      <div class="tree-root-row">
        <p><?= $emergingArtist->title()->html() ?></p>

        <?php if ($emergingArtistPage || $emergingWorks->isNotEmpty()): ?>
          <ul class="tree">
            <?php if ($emergingArtistPage): ?>
              <li>
                <p>Artist</p>
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
                <p>Works</p>
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
                        <?php if ($work->images()->isNotEmpty()): ?>
                          <li class="work-images">
                            <?php foreach ($work->images() as $image): ?>
                              <figure>
                                <img src="<?= $image->url() ?>" alt="<?= $image->alt()->or($work->title())->html() ?>">
                              </figure>
                            <?php endforeach ?>
                          </li>
                        <?php endif ?>
                      </ul>
                    </li>
                  <?php endforeach ?>
                </ul>
              </li>
            <?php endif ?>
          </ul>
        <?php endif ?>
      </div>

      <?php if ($emergingArtist->text()->isNotEmpty()): ?>
        <div class="section-text">
          <?= $emergingArtist->text()->kt() ?>
        </div>
      <?php endif ?>
    </section>
  <?php endif ?>

  <?php if ($about = page('about')): ?>
    <section class="landing-section" id="about">
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

      const isOpen = nested.classList.contains("is-open");

      document.querySelectorAll(".tree-children.is-open").forEach((child) => {
        child.classList.remove("is-open");
      });

      document.querySelectorAll(".tree-toggle.is-open").forEach((openToggle) => {
        openToggle.classList.remove("is-open");
        openToggle.setAttribute("aria-expanded", "false");
      });

      if (!isOpen) {
        nested.classList.add("is-open");
        toggle.classList.add("is-open");
        toggle.setAttribute("aria-expanded", "true");
      }
    });
  });
</script>

<?php snippet('footer') ?>
