<?php

use App\Verif;
?>
<section class="hero is-fullheight">
  <div class="hero-body">
    <div class="container has-text-centered">
      <div class="rings">
        <h1 class="title">
          Jean Forteroche
        </h1>
        <span><span></span></span>
        <span><span></span></span>
        <span><span></span></span>
      </div>
      <h2 class="subtitle ">
        Billet simple pour L'Alaska...
      </h2>
      <div class="container has-text-centered">
        <a href="#one">
          <p class="icon circle" title="Vers les derniers billets">
            <i class="fas fa-arrow-circle-down fa-5x"></i>
          </p>
        </a>
      </div>
    </div>
  </div>
</section>
<section class="section is-medium ">
  <div id="one" class="container has-text-centered">
    Suivez mon nouveau roman...par épisodes
  </div>
</section>
<section class="section">
  <div class="container">
    <div class="columns is-centered">
      <?php if (empty($billets)) : ?>
        <p>
          <strong>Il n'y a aucun billets publiés.</strong> _ Merci de revenir me visiter plus tard
        </p>
      <?php else : ?>
        <?php foreach ($billets as $bil) : ?>
          <div class="column is-3">
            <?php if (!empty(Verif::filterName($bil->getImage()))) {
            ?>
              <div class="card">
                <div class="card-image">
                  <figure class="image ">
                    <img id="homePost" src="<?= BASEPATH . '/img/posts/' . Verif::filterName($bil->getImage()) ?>" alt="<?= Verif::filterName($bil->getTitle()) ?>">
                  </figure>
                </div>
              <?php
            } ?>
              <div class="card-content">
                <div class="media">
                  <div class="media-content">
                    <p class="title is-4" title="Lien vers le détail de l'billet">
                      <a href="<?= BASEPATH . 'Front/posting/' . Verif::filterInt($bil->getId()) ?>">
                        <strong><?= Verif::filterName($bil->getTitle()) ?></strong>
                      </a>
                    </p>
                    <p class="subtitle is-6">
                      <strong><?= Verif::filterName($bil->getAuthor()) ?></strong>
                    </p>
                    <div class="content">
                      <p><?= substr($bil->getContent(), 0, 150) ?>...</p>
                      <time datetime="1-1-2016">
                        <small>Publié le : <em><?= date(' d - m - Y à H:i', strtotime($bil->getCreate_at())); ?></em></small>
                      </time>
                    </div>
                  </div>
                </div>
              </div>
              </div>
          </div>
        <?php endforeach ?>
      <?php endif ?>
    </div>
  </div>
</section>