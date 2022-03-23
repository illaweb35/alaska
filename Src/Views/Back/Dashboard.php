<?php

use App\Verif; ?>
<section class="section">
  <div class="container">
    <h1 class="title">Tableau de Bord</h1>
    <div class="content">
      <p>Utilisateur Connecté:
        <strong><?= Verif::filterName($_SESSION['name']) ?></strong>
      </p>
    </div>
    <div class="columns">
      <div class="column">
        <div class="box notification is-link">
          <article class="media">
            <div class="media-left">
              <figure class="image is-64x64">
                <img src="<?= BASEPATH . 'img/posts/Map_Alaska.png' ?>" alt="">
              </figure>
            </div>
            <div class="media-content">
              <p class="subtitle is-3">
                Billets
              </p>
              <p>
                <strong><?= count($all_billets) ?></strong>
                _ Billets sur le site.
              </p>
              <hr />
              <p>
                <strong><?= count($billets) ?></strong>
                _ Publié sur le site
              </p>
            </div>
          </article>
        </div>
      </div>
      <div class="column">
        <div class="box notification is-warning">
          <article class="media">
            <div class="media-left">
              <figure class="image is-64x64">
                <img src="<?= BASEPATH . '/img/Comments.png' ?>" alt="Bulles commentaires">
              </figure>
            </div>
            <div class="media-content">
              <p class="subtitle is-3">
                Commentaires
              </p>
              <p>
                <strong><?= count($comments) ?></strong>
                _ Commentaires publiés
              </p>
              <hr />
              <p>
                <strong><?= count($commentModerate) ?></strong>
                _ Commentaires à valider
              </p>
            </div>
          </article>
        </div>
      </div>
      <div class="column">
        <div class="box notification is-primary">
          <article class="media">
            <div class="media-left">
              <figure class="image is-64x64">
                <img src="<?= BASEPATH . '/img/Utilisateurs.png' ?>" alt="Utilisateurs dans un cercle">
              </figure>
            </div>
            <div class="media-content">
              <p class="subtitle is-3">
                Utilisateurs
              </p>
              <p>Nombres :
                <strong><?= count($users) ?></strong>
              </p>
            </div>
          </article>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section">
  <div class="container">
    <h2 class="title">Commentaires signalés </h2>
    <small>(Commentaires signalés par les lecteurs, à valider)</small>
    <hr />
    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
      <thead>
        <tr>
          <th>Pseudo</th>
          <th>Commentaire</th>
          <th>N° Billet</th>
          <th>Action</th>
        </tr>
      </thead>
      <?php foreach ($commentModerate as $comMod) : ?>
        <tbody>
          <td><?= Verif::filterName($comMod->getPseudo()) ?></td>
          <td><?= substr(nl2br(Verif::filterString($comMod->getContent())), 0, 100); ?> ...</td>
          <td><?= Verif::filterInt($comMod->getBil_id()) ?></td>
          <td>
            <a href="<?= BASEPATH . 'Back/Check/' . Verif::filterInt($comMod->getId()) ?>">
              <span class="icon">
                <i class="fas fa-check"></i>
              </span>
            </a>
            <a href="<?= BASEPATH . 'Backedit/Delete_com/' . Verif::filterInt($comMod->getId()) ?>">
              <span class="icon">
                <i class="fas fa-trash"></i>
              </span>
            </a>
          </td>
        </tbody>
      <?php endforeach ?>
    </table>
  </div>
</section>