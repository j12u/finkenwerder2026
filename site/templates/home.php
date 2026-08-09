<?php snippet('header') ?>

<?php
$mainPrize = page('main-prize');
$mainPrizeArtist = $mainPrize ? $mainPrize->children()->listed()->filterBy('intendedTemplate', 'artist')->first() : null;
$mainPrizeWorks = $mainPrize ? $mainPrize->children()->listed()->filterBy('intendedTemplate', 'main-prize-work') : null;

$emergingArtist = page('emerging-artist');
$emergingArtistPage = $emergingArtist ? $emergingArtist->children()->listed()->filterBy('intendedTemplate', 'artist')->first() : null;
$emergingWorks = $emergingArtist ? $emergingArtist->children()->listed()->filterBy('intendedTemplate', 'emerging-artist-work') : null;
$emergingFirstWork = $emergingWorks && $emergingWorks->isNotEmpty() ? $emergingWorks->first() : null;

$aboutPage = page('about');
$imprintPage = page('imprint');
$dataPrivacyPage = page('data-privacy');
?>

<main class="landing">
  <?php /* MOBILE LAYOUT */ ?>
  <section class="mobile-landing" aria-label="Mobile landing">
    <div class="mobile-landing-panel">
      <?php if ($kirby->languages()->count() > 1): ?>
        <nav class="mobile-language-switch">
          <?php foreach ($kirby->languages() as $language): ?>
            <a href="<?= $page->url($language->code()) ?>"<?= $kirby->language()?->code() === $language->code() ? ' aria-current="true"' : '' ?>>
              <?= strtoupper($language->code()) ?>
            </a>
          <?php endforeach ?>
        </nav>
      <?php endif ?>

      <?php if ($mainPrize && ($mainPrizeArtist || ($mainPrizeWorks && $mainPrizeWorks->isNotEmpty()))): ?>
        <section class="mobile-group">
          <button class="mobile-group-title mobile-reset-trigger" type="button"><?= $mainPrize->title()->html() ?></button>

          <?php if ($mainPrizeArtist): ?>
            <button class="mobile-branch-row mobile-branch-row-inline mobile-toggle" type="button" aria-expanded="false">
              <span class="mobile-branch-label">Artist</span>
              <span class="mobile-branch-line" aria-hidden="true"></span>
              <span class="mobile-branch-value"><?= $mainPrizeArtist->title()->html() ?></span>
            </button>
            <div class="mobile-panel">
              <?php if ($mainPrizeArtist->text()->isNotEmpty()): ?>
                <?= $mainPrizeArtist->text()->kt() ?>
              <?php endif ?>
            </div>
          <?php endif ?>

          <?php if ($mainPrizeWorks && $mainPrizeWorks->isNotEmpty()): ?>
            <p class="mobile-branch-row mobile-branch-row-last">
              <span class="mobile-branch-label">Works</span>
            </p>

            <ul class="mobile-work-list">
              <?php foreach ($mainPrizeWorks as $work): ?>
                <?php $mobileHasMainWorkDetails = $work->year()->isNotEmpty() || $work->material()->isNotEmpty() || $work->description()->isNotEmpty() || $work->images()->isNotEmpty(); ?>
                <li class="mobile-work-entry">
                  <button class="mobile-work-item mobile-toggle<?= $work->uid() === 'silent-force-red-caress' ? ' mobile-work-item-corner' : '' ?>" type="button" aria-expanded="false">
                    <?= $work->title()->html() ?>
                  </button>
                  <div class="mobile-panel mobile-work-panel">
                    <?php if ($mobileHasMainWorkDetails): ?>
                      <ul class="mobile-details-list">
                        <?php if ($work->year()->isNotEmpty()): ?>
                          <li class="mobile-details-item">
                            <span class="mobile-details-label">Year</span>
                            <span class="mobile-details-value"><?= $work->year()->html() ?></span>
                          </li>
                        <?php endif ?>
                        <?php if ($work->material()->isNotEmpty()): ?>
                          <li class="mobile-details-item">
                            <span class="mobile-details-label">Material</span>
                            <span class="mobile-details-value"><?= $work->material()->html() ?></span>
                          </li>
                        <?php endif ?>
                        <?php if ($work->description()->isNotEmpty()): ?>
                          <li class="mobile-details-item mobile-details-item-block">
                            <span class="mobile-details-label">Description</span>
                            <div class="mobile-details-richtext"><?= $work->description()->kt() ?></div>
                          </li>
                        <?php endif ?>
                      </ul>
                    <?php endif ?>

                    <?php if ($work->images()->isNotEmpty()): ?>
                      <div class="mobile-work-images">
                        <?php foreach ($work->images() as $image): ?>
                          <figure>
                            <button
                              class="work-image-trigger"
                              type="button"
                              data-image-src="<?= $image->url() ?>"
                              data-image-alt="<?= $image->alt()->or($work->title())->html() ?>"
                              aria-label="Open image"
                            >
                              <img src="<?= $image->resize(1200)->url() ?>" alt="<?= $image->alt()->or($work->title())->html() ?>">
                            </button>
                          </figure>
                        <?php endforeach ?>
                      </div>
                    <?php endif ?>
                  </div>
                </li>
              <?php endforeach ?>
            </ul>
          <?php endif ?>
        </section>
      <?php endif ?>

      <?php if ($emergingArtist && ($emergingArtistPage || ($emergingWorks && $emergingWorks->isNotEmpty()))): ?>
        <section class="mobile-group">
          <button class="mobile-group-title mobile-reset-trigger" type="button"><?= $emergingArtist->title()->html() ?></button>

          <?php if ($emergingArtistPage): ?>
            <button class="mobile-branch-row mobile-branch-row-inline mobile-toggle mobile-emerging-artist-trigger" type="button" aria-expanded="false">
              <span class="mobile-branch-label">Artist</span>
              <span class="mobile-branch-line" aria-hidden="true"></span>
              <span class="mobile-branch-value"><?= $emergingArtistPage->title()->html() ?></span>
            </button>
            <div class="mobile-panel">
              <?php if ($emergingArtistPage->text()->isNotEmpty()): ?>
                <?= $emergingArtistPage->text()->kt() ?>
              <?php endif ?>
            </div>
          <?php endif ?>

          <?php if ($emergingFirstWork): ?>
            <button class="mobile-branch-row mobile-branch-row-inline mobile-branch-row-last mobile-toggle" type="button" aria-expanded="false">
              <span class="mobile-branch-label">Works</span>
              <span class="mobile-branch-line" aria-hidden="true"></span>
              <span class="mobile-branch-value"><?= $emergingFirstWork->title()->html() ?></span>
            </button>
            <div class="mobile-panel mobile-work-panel">
              <?php $mobileHasEmergingWorkDetails = $emergingFirstWork->year()->isNotEmpty() || $emergingFirstWork->medium()->isNotEmpty() || $emergingFirstWork->duration()->isNotEmpty() || $emergingFirstWork->dimensions()->isNotEmpty() || $emergingFirstWork->courtesy()->isNotEmpty() || $emergingFirstWork->description()->isNotEmpty() || $emergingFirstWork->images()->isNotEmpty(); ?>
              <?php if ($mobileHasEmergingWorkDetails): ?>
                <ul class="mobile-details-list">
                  <?php if ($emergingFirstWork->year()->isNotEmpty()): ?>
                    <li class="mobile-details-item">
                      <span class="mobile-details-label">Year</span>
                      <span class="mobile-details-value"><?= $emergingFirstWork->year()->html() ?></span>
                    </li>
                  <?php endif ?>
                  <?php if ($emergingFirstWork->medium()->isNotEmpty()): ?>
                    <li class="mobile-details-item">
                      <span class="mobile-details-label">Medium</span>
                      <span class="mobile-details-value"><?= $emergingFirstWork->medium()->html() ?></span>
                    </li>
                  <?php endif ?>
                  <?php if ($emergingFirstWork->duration()->isNotEmpty()): ?>
                    <li class="mobile-details-item">
                      <span class="mobile-details-label">Duration</span>
                      <span class="mobile-details-value"><?= $emergingFirstWork->duration()->html() ?></span>
                    </li>
                  <?php endif ?>
                  <?php if ($emergingFirstWork->dimensions()->isNotEmpty()): ?>
                    <li class="mobile-details-item">
                      <span class="mobile-details-label">Dimensions</span>
                      <span class="mobile-details-value"><?= $emergingFirstWork->dimensions()->html() ?></span>
                    </li>
                  <?php endif ?>
                  <?php if ($emergingFirstWork->courtesy()->isNotEmpty()): ?>
                    <li class="mobile-details-item">
                      <span class="mobile-details-label">Courtesy</span>
                      <span class="mobile-details-value"><?= $emergingFirstWork->courtesy()->html() ?></span>
                    </li>
                  <?php endif ?>
                  <?php if ($emergingFirstWork->description()->isNotEmpty()): ?>
                    <li class="mobile-details-item mobile-details-item-block">
                      <span class="mobile-details-label">Description</span>
                      <div class="mobile-details-richtext"><?= $emergingFirstWork->description()->kt() ?></div>
                    </li>
                  <?php endif ?>
                </ul>
              <?php endif ?>

              <?php if ($emergingFirstWork->images()->isNotEmpty()): ?>
                <div class="mobile-work-images">
                  <?php foreach ($emergingFirstWork->images() as $image): ?>
                    <figure>
                      <button
                        class="work-image-trigger"
                        type="button"
                        data-image-src="<?= $image->url() ?>"
                        data-image-alt="<?= $image->alt()->or($emergingFirstWork->title())->html() ?>"
                        aria-label="Open image"
                      >
                        <img src="<?= $image->resize(1200)->url() ?>" alt="<?= $image->alt()->or($emergingFirstWork->title())->html() ?>">
                      </button>
                    </figure>
                  <?php endforeach ?>
                </div>
              <?php endif ?>
            </div>
          <?php endif ?>
        </section>
      <?php endif ?>

      <section class="mobile-links">
        <?php if ($aboutPage): ?>
          <button class="mobile-link-row mobile-toggle" type="button" aria-expanded="false"><?= $aboutPage->title()->html() ?></button>
          <div class="mobile-panel">
            <?php if ($aboutPage->text()->isNotEmpty()): ?>
              <?= $aboutPage->text()->kt() ?>
            <?php endif ?>
          </div>
        <?php endif ?>

        <?php if ($imprintPage): ?>
          <button class="mobile-link-row mobile-toggle" type="button" aria-expanded="false"><?= $imprintPage->title()->html() ?></button>
          <div class="mobile-panel">
            <?php if ($imprintPage->text()->isNotEmpty()): ?>
              <?= $imprintPage->text()->kt() ?>
            <?php endif ?>
          </div>
        <?php endif ?>

        <?php if ($dataPrivacyPage): ?>
          <button class="mobile-link-row mobile-toggle mobile-link-row-corner" type="button" aria-expanded="false"><?= $dataPrivacyPage->title()->html() ?></button>
          <div class="mobile-panel">
            <?php if ($dataPrivacyPage->text()->isNotEmpty()): ?>
              <?= $dataPrivacyPage->text()->kt() ?>
            <?php endif ?>
          </div>
        <?php endif ?>
      </section>
    </div>
  </section>

  <?php /* DESKTOP LAYOUT */ ?>
  <div class="desktop-landing">
  <?php if ($mainPrize): ?>

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
                <ul class="tree tree-group main-prize-work-list">
                  <?php foreach ($mainPrizeWorks as $work): ?>
                    <?php $isTerminalWork = in_array($work->uid(), ['silent-force-red-caress', 'being-strong-is-hard'], true); ?>
                    <?php $hasMainWorkDetails = $work->year()->isNotEmpty() || $work->material()->isNotEmpty() || $work->description()->isNotEmpty(); ?>
                    <?php $hoverImage = $work->images()->first(); ?>
                    <li>
                      <button
                        class="tree-toggle work-hover-trigger<?= $isTerminalWork ? ' tree-toggle-terminal' : '' ?>"
                        type="button"
                        aria-expanded="false"
                        data-hover-image="<?= $hoverImage ? $hoverImage->resize(1600)->url() : '' ?>"
                      >
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

  <?php if ($emergingArtist): ?>
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
                    <?php $hoverImage = $work->images()->first(); ?>
                    <li>
                      <button
                        class="tree-toggle work-hover-trigger<?= $isTerminalWork ? ' tree-toggle-terminal' : '' ?><?= $isEmergingLineWork ? ' tree-toggle-emerging-work-line' : '' ?>"
                        type="button"
                        aria-expanded="false"
                        data-hover-image="<?= $hoverImage ? $hoverImage->resize(1600)->url() : '' ?>"
                      >
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

  <?php if ($aboutPage): ?>
    <section class="landing-section" id="about">
      <ul class="tree tree-group">
        <li>
          <button class="tree-toggle" type="button" aria-expanded="false">
            <?= $aboutPage->title()->html() ?>
          </button>
          <ul class="tree-children">
            <?php if ($aboutPage->text()->isNotEmpty()): ?>
              <li><?= $aboutPage->text()->kt() ?></li>
            <?php endif ?>
          </ul>
        </li>
      </ul>
    </section>
  <?php endif ?>

  <?php if ($imprintPage): ?>
    <section class="landing-section" id="imprint">
      <ul class="tree tree-group">
        <li>
          <button class="tree-toggle" type="button" aria-expanded="false">
            <?= $imprintPage->title()->html() ?>
          </button>
          <ul class="tree-children">
            <?php if ($imprintPage->text()->isNotEmpty()): ?>
              <li><?= $imprintPage->text()->kt() ?></li>
            <?php endif ?>
          </ul>
        </li>
      </ul>
    </section>
  <?php endif ?>

   <?php if ($dataPrivacyPage): ?>
    <section class="landing-section" id="data-privacy">
      <ul class="tree tree-group">
        <li>
          <button class="tree-toggle" type="button" aria-expanded="false">
            <?= $dataPrivacyPage->title()->html() ?>
          </button>
          <ul class="tree-children">
            <?php if ($dataPrivacyPage->text()->isNotEmpty()): ?>
              <li><?= $dataPrivacyPage->text()->kt() ?></li>
            <?php endif ?>
          </ul>
        </li>
      </ul>
    </section>
  <?php endif ?>
  </div>



<div class="image-lightbox" hidden>
  <div class="image-lightbox-backdrop" aria-hidden="true"></div>
  <div class="image-lightbox-content" role="dialog" aria-modal="true" aria-label="Expanded image">
    <img class="image-lightbox-image" src="" alt="">
  </div>
</div>

<div class="work-hover-preview" aria-hidden="true">
  <img class="work-hover-preview-image" src="" alt="">
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

  const hasOpenDesktopPanel = () => Boolean(
    document.querySelector(".desktop-landing .tree-toggle.is-open")
  );

  let activeHoverTrigger = null;

  const closeAllPanels = () => {
    document.querySelectorAll(".tree-children.is-open").forEach((child) => {
      child.classList.remove("is-open");
    });

    document.querySelectorAll(".tree-toggle.is-open").forEach((openToggle) => {
      openToggle.classList.remove("is-open");
      openToggle.setAttribute("aria-expanded", "false");
    });
  };

  const mainPrizeWorkList = document.querySelector("#main-prize .main-prize-work-list");
  const mainPrizeWorkItems = mainPrizeWorkList ? [...mainPrizeWorkList.children] : [];

  const resetMainPrizeWorkOrder = () => {
    if (!mainPrizeWorkList) return;

    mainPrizeWorkItems.forEach((item) => {
      mainPrizeWorkList.append(item);
    });
  };

  const moveMainPrizeWorkToTop = (toggle) => {
    if (!mainPrizeWorkList) return;

    const item = toggle.closest("li");

    if (!item) return;

    mainPrizeWorkList.prepend(item);
  };

  const animateMainPrizeWorkList = (change) => {
    if (!mainPrizeWorkList) {
      change();
      return;
    }

    const oldPositions = new Map();

    mainPrizeWorkItems.forEach((item) => {
      oldPositions.set(item, item.getBoundingClientRect().top);
    });

    change();

    mainPrizeWorkItems.forEach((item) => {
      const oldTop = oldPositions.get(item);
      const newTop = item.getBoundingClientRect().top;

      item.style.transition = "none";
      item.style.transform = `translateY(${oldTop - newTop}px)`;
    });

    requestAnimationFrame(() => {
      mainPrizeWorkItems.forEach((item) => {
        item.style.transition = "transform 0.4s";
        item.style.transform = "";
      });
    });
  };

  document.querySelectorAll(".tree-toggle").forEach((toggle) => {
    toggle.addEventListener("click", () => {
      const nested = toggle.nextElementSibling;

      if (!nested) return;

      const isOpen = nested.classList.contains("is-open");
      const isMainPrizeWorkToggle = Boolean(
        mainPrizeWorkList &&
        mainPrizeWorkList.contains(toggle) &&
        toggle.classList.contains("tree-toggle-artist") === false
      );

      animateMainPrizeWorkList(() => {
        closeAllPanels();
        resetMainPrizeWorkOrder();

        if (!isOpen) {
          if (isMainPrizeWorkToggle) {
            moveMainPrizeWorkToTop(toggle);
          }

          nested.classList.add("is-open");
          toggle.classList.add("is-open");
          toggle.setAttribute("aria-expanded", "true");
        }
      });

      updateArtistHighlight();
      updateMainPrizeHomeLink();
      syncWorkHoverPreview();
    });
  });

  document.querySelector(".main-prize-home-link")?.addEventListener("click", (event) => {
    if (event.currentTarget.getAttribute("aria-disabled") === "true") {
      event.preventDefault();
    }
  });

  updateArtistHighlight();
  updateMainPrizeHomeLink();

  const workHoverPreview = document.querySelector(".work-hover-preview");
  const workHoverPreviewImage = workHoverPreview?.querySelector(".work-hover-preview-image");
  function showWorkHoverPreview(src) {
    if (hasOpenDesktopPanel()) return;
    if (!workHoverPreview || !workHoverPreviewImage || !src) return;

    workHoverPreviewImage.src = src;
    workHoverPreview.classList.add("is-visible");
  }

  function hideWorkHoverPreview() {
    if (!workHoverPreview || !workHoverPreviewImage) return;

    workHoverPreview.classList.remove("is-visible");
    workHoverPreviewImage.src = "";
  }

  function syncWorkHoverPreview() {
    const previewImage = activeHoverTrigger?.dataset.hoverImage ?? "";

    if (hasOpenDesktopPanel() || !previewImage) {
      hideWorkHoverPreview();
      return;
    }

    showWorkHoverPreview(previewImage);
  }

  document.querySelectorAll(".work-hover-trigger").forEach((trigger) => {
    trigger.addEventListener("mouseenter", () => {
      activeHoverTrigger = trigger;
      syncWorkHoverPreview();
    });

    trigger.addEventListener("mouseleave", () => {
      if (activeHoverTrigger === trigger) {
        activeHoverTrigger = null;
      }

      syncWorkHoverPreview();
    });

    trigger.addEventListener("focus", () => {
      activeHoverTrigger = trigger;
      syncWorkHoverPreview();
    });

    trigger.addEventListener("blur", () => {
      if (activeHoverTrigger === trigger) {
        activeHoverTrigger = null;
      }

      syncWorkHoverPreview();
    });
  });

  document.querySelectorAll(".mobile-toggle").forEach((toggle) => {
    toggle.addEventListener("click", () => {
      const panel = toggle.nextElementSibling;

      if (!panel || !panel.classList.contains("mobile-panel")) return;

      const isOpen = panel.classList.contains("is-open");

      panel.classList.toggle("is-open", !isOpen);
      toggle.setAttribute("aria-expanded", isOpen ? "false" : "true");
    });
  });

  const closeMobilePanels = () => {
    document.querySelectorAll(".mobile-panel.is-open").forEach((panel) => {
      panel.classList.remove("is-open");
    });

    document.querySelectorAll(".mobile-toggle[aria-expanded=\"true\"]").forEach((toggle) => {
      toggle.setAttribute("aria-expanded", "false");
    });
  };

  document.querySelectorAll(".mobile-reset-trigger").forEach((trigger) => {
    trigger.addEventListener("click", () => {
      closeMobilePanels();
    });
  });

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
    const clickedClose = event.target.closest(".image-lightbox-image, .image-lightbox-backdrop");

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
