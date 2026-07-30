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
	          <p>
	            <a class="main-prize-home-link" href="<?= $page->url() ?>" aria-disabled="true" tabindex="-1">
	              <?= $mainPrize->title()->html() ?>
	            </a>
	          </p>

          <ul class="tree">
            <?php if ($mainPrizeArtist): ?>
              <li>
                <p>Artist</p>
                <ul class="tree tree-group">
                  <li>
                    <button class="tree-toggle tree-toggle-artist tree-toggle-main-artist" type="button" aria-expanded="false">
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
                    <?php $isTerminalWork = in_array($work->uid(), ['silent-force-red-caress', 'being-strong-is-hard'], true); ?>
                    <?php $isFirstMainWork = $work->is($mainPrizeWorks->first()); ?>
                    <?php $hasMainWorkDetails = $work->year()->isNotEmpty() || $work->material()->isNotEmpty() || $work->description()->isNotEmpty(); ?>
                    <li>
                      <button class="tree-toggle<?= $isTerminalWork ? ' tree-toggle-terminal' : '' ?><?= $isFirstMainWork ? ' tree-toggle-main-first-work' : '' ?>" type="button" aria-expanded="false">
                        <?= $work->title()->html() ?>
                      </button>
                      <ul class="tree-children">
                        <?php if ($hasMainWorkDetails): ?>
                          <li class="work-details-group">
                            <p class="work-details-title">Details</p>
                            <ul class="work-details-list">
                              <?php if ($work->year()->isNotEmpty()): ?>
                                <li class="work-details-item">
                                  <p class="work-details-label-year">Year:</p>
                                  <div class="work-details-value"><?= $work->year()->html() ?></div>
                                </li>
                              <?php endif ?>
                              <?php if ($work->material()->isNotEmpty()): ?>
                                <li class="work-details-item">
                                  <p class="work-details-label-branch">Material:</p>
                                  <div class="work-details-value"><?= $work->material()->html() ?></div>
                                </li>
                              <?php endif ?>
                              <?php if ($work->description()->isNotEmpty()): ?>
                                <li class="work-details-item">
                                  <p class="work-details-label-end">Description:</p>
                                  <div class="work-details-value"><?= $work->description()->kt() ?></div>
                                </li>
                              <?php endif ?>
                            </ul>
                          </li>
                        <?php endif ?>
                        <?php if ($work->images()->isNotEmpty()): ?>
                          <li class="work-images">
                            <?php foreach ($work->images() as $image): ?>
                              <figure>
                                <button
                                  class="work-image-trigger"
                                  type="button"
                                  data-image-src="<?= $image->url() ?>"
                                  data-image-alt="<?= $image->alt()->or($work->title())->html() ?>"
                                  aria-label="Open image"
                                >
                                  <img src="<?= $image->url() ?>" alt="<?= $image->alt()->or($work->title())->html() ?>">
                                </button>
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

          <?php if ($kirby->languages()->count() > 1): ?>
            <nav class="language-switch">
              <?php foreach ($kirby->languages() as $language): ?>
                <a href="<?= $page->url($language->code()) ?>"<?= $kirby->language()?->code() === $language->code() ? ' aria-current="true"' : '' ?>>
                  <?= strtoupper($language->code()) ?>
                </a>
              <?php endforeach ?>
            </nav>
          <?php endif ?>
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
                    <button class="tree-toggle tree-toggle-artist tree-toggle-last" type="button" aria-expanded="false">
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
                    <?php $isTerminalWork = $work->uid() === 'silent-force-red-caress'; ?>
                    <?php $isEmergingLineWork = $work->uid() === 'being-strong-is-hard'; ?>
                    <?php $hasEmergingWorkDetails = $work->year()->isNotEmpty() || $work->medium()->isNotEmpty() || $work->duration()->isNotEmpty() || $work->dimensions()->isNotEmpty() || $work->courtesy()->isNotEmpty() || $work->description()->isNotEmpty(); ?>
                    <li>
                      <button class="tree-toggle<?= $isTerminalWork ? ' tree-toggle-terminal' : '' ?><?= $isEmergingLineWork ? ' tree-toggle-emerging-work-line' : '' ?>" type="button" aria-expanded="false">
                        <?= $work->title()->html() ?>
                      </button>
                      <ul class="tree-children">
                        <?php if ($hasEmergingWorkDetails): ?>
                          <li class="work-details-group">
                            <p class="work-details-title">Details</p>
                            <ul class="work-details-list">
                              <?php if ($work->year()->isNotEmpty()): ?>
                                <li class="work-details-item">
                                  <p class="work-details-label-year">Year:</p>
                                  <div class="work-details-value"><?= $work->year()->html() ?></div>
                                </li>
                              <?php endif ?>
                              <?php if ($work->medium()->isNotEmpty()): ?>
                                <li class="work-details-item">
                                  <p>┣ Medium:</p>
                                  <div class="work-details-value"><?= $work->medium()->html() ?></div>
                                </li>
                              <?php endif ?>
                              <?php if ($work->duration()->isNotEmpty()): ?>
                                <li class="work-details-item">
                                  <p>┣ Duration:</p>
                                  <div class="work-details-value"><?= $work->duration()->html() ?></div>
                                </li>
                              <?php endif ?>
                              <?php if ($work->dimensions()->isNotEmpty()): ?>
                                <li class="work-details-item">
                                  <p>┣ Dimensions:</p>
                                  <div class="work-details-value"><?= $work->dimensions()->html() ?></div>
                                </li>
                              <?php endif ?>
                              <?php if ($work->courtesy()->isNotEmpty()): ?>
                                <li class="work-details-item">
                                  <p>┣ Courtesy:</p>
                                  <div class="work-details-value"><?= $work->courtesy()->html() ?></div>
                                </li>
                              <?php endif ?>
                              <?php if ($work->description()->isNotEmpty()): ?>
                                <li class="work-details-item">
                                  <p class="work-details-label-end">Description:</p>
                                  <div class="work-details-value"><?= $work->description()->kt() ?></div>
                                </li>
                              <?php endif ?>
                            </ul>
                          </li>
                        <?php endif ?>
                        <?php if ($work->images()->isNotEmpty()): ?>
                          <li class="work-images">
                            <?php foreach ($work->images() as $image): ?>
                              <figure>
                                <button
                                  class="work-image-trigger"
                                  type="button"
                                  data-image-src="<?= $image->url() ?>"
                                  data-image-alt="<?= $image->alt()->or($work->title())->html() ?>"
                                  aria-label="Open image"
                                >
                                  <img src="<?= $image->url() ?>" alt="<?= $image->alt()->or($work->title())->html() ?>">
                                </button>
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



<div class="image-lightbox" hidden>
  <button class="image-lightbox-close" type="button" aria-label="Close image">&times;</button>
  <div class="image-lightbox-backdrop" aria-hidden="true"></div>
  <div class="image-lightbox-content" role="dialog" aria-modal="true" aria-label="Expanded image">
    <img class="image-lightbox-image" src="" alt="">
  </div>
</div>

<script>
  const updateArtistHighlight = () => {
    document.querySelectorAll("#main-prize, #emerging-artist").forEach((section) => {
      const artistToggle = section.querySelector(".tree-toggle-artist");
      const openWork = section.querySelector(".tree-group .tree-toggle.is-open:not(.tree-toggle-artist)");

      if (!artistToggle) return;

      artistToggle.classList.toggle("has-open-work", Boolean(openWork));
    });
  };

  const updateMainPrizeHomeLink = () => {
    const homeLink = document.querySelector(".main-prize-home-link");
    const hasOpenMainPrizePanel = Boolean(
      document.querySelector("#main-prize .tree-toggle.is-open")
    );

    if (!homeLink) return;

    homeLink.setAttribute("aria-disabled", hasOpenMainPrizePanel ? "false" : "true");
    homeLink.tabIndex = hasOpenMainPrizePanel ? 0 : -1;
    homeLink.classList.toggle("is-active", hasOpenMainPrizePanel);
  };

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

      updateArtistHighlight();
      updateMainPrizeHomeLink();
    });
  });

  document.querySelector(".main-prize-home-link")?.addEventListener("click", (event) => {
    if (event.currentTarget.getAttribute("aria-disabled") === "true") {
      event.preventDefault();
    }
  });

  updateArtistHighlight();
  updateMainPrizeHomeLink();

  const lightbox = document.querySelector(".image-lightbox");
  const lightboxImage = lightbox?.querySelector(".image-lightbox-image");
  const lightboxClose = () => {
    if (!lightbox || !lightboxImage) return;

    lightbox.hidden = true;
    lightboxImage.src = "";
    lightboxImage.alt = "";
    document.body.classList.remove("has-image-lightbox");
  };

  document.querySelectorAll(".work-image-trigger").forEach((trigger) => {
    trigger.addEventListener("click", () => {
      if (!lightbox || !lightboxImage) return;

      lightboxImage.src = trigger.dataset.imageSrc ?? "";
      lightboxImage.alt = trigger.dataset.imageAlt ?? "";
      lightbox.hidden = false;
      document.body.classList.add("has-image-lightbox");
    });
  });

  lightbox?.addEventListener("click", (event) => {
    const clickedClose = event.target.closest(".image-lightbox-close, .image-lightbox-backdrop");

    if (clickedClose) {
      lightboxClose();
    }
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && lightbox && lightbox.hidden === false) {
      lightboxClose();
    }
  });

  updateArtistHighlight();
</script>

<?php snippet('footer') ?>
