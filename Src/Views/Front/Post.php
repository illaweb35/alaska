<?php

use App\Verif;

?>
<section class="section">
  <div class="container">
    <div class="image_bandeau">
      <img src="<?= BASEPATH . 'img/Alaska_bandeau.jpg' ?>" alt="image de bandeau header Bienvenue en Alaska">
      <span>
        <h2 class="title">Billet simple pour l'Alaska</h2>
        <p>mon livre en épisode</p>
      </span>
    </div>
  </div>
  <div id="top" class="container">
    <article class="media">
      <?php if (!empty(Verif::filterName($billets->getImage()))) {
      ?>
        <div class="media-left">
          <figure class="image is-128x128">
            <img src="<?= BASEPATH . 'img/posts/' . Verif::filterName($billets->getImage()) ?>" alt="<?= Verif::filterName($billets->getTitle()) ?>">
          </figure>
        </div>
      <?php
      } ?>
      <div class="media-content">
        <div class="content">
          <p class="title is-4"><?= Verif::filterName($billets->getTitle()) ?></p>
          <p><?= $billets->getContent() ?></p>
          <small>Publié le : <em><?= date(' d - m - Y à H:i', strtotime($billets->getCreate_at())) ?></em></small>
          <p>Par <strong><?= Verif::filterName($billets->getAuthor()) ?></strong>
        </div>
      </div>
    </article>
    <hr />
    <div class="columns">
      <div class="column">
        <article class="message is-info">
          <div class="message-header">
            <p><em><strong>Commentaires pour : </strong></em><?php Verif::filterName($billets->getTitle()) ?>
            </p>
          </div>
          <div class="message-body">
            <?php if (Verif::filterName(empty($comments))) : ?>
              <p class="bold">Il n'y a pas de commentaire pour cet article.
              </p>
              <hr />
              <p class="has-text-centered">
                Soyez le premier à ecrire un commentaire.
              </p>
            <?php else : ?>
              <?php foreach ($comments as $com) : ?>
                <span class="underline">
                  <p>
                    <strong>
                      <?= Verif::filterName($com->getPseudo()) ?>
                    </strong> a écrit:
                  </p>
                </span>
                <small>Le <?= date('d - m - Y à H:i', strtotime($com->getCreate_at())) ?></small>
                <p>
                  <?= Verif::filterString($com->getContent()) ?>
                </p>
                <br />
                <p class="is-size-7">
                  <a href="<?= BASEPATH . 'Front/Signaler/' . Verif::filterInt($com->getId()) ?>">Signaler le commentaire</a>
                </p>
                <hr />
              <?php endforeach ?>
            <?php endif ?>
          </div>
        </article>
      </div>
      <div class="column">
        <article class="media">
          <div class="media-content">
            <form action="<?= BASEPATH . 'Front/Create_com/' . Verif::filterInt($billets->getId()) ?>" method="post">
              <div class="field">
                <div class="control">
                  <input class="input" id="pseudo" name="pseudo" type="text" placeholder="Votre pseudo" required /><br />
                </div>
              </div>
              <div class="field">
                <div class="control">
                  <textarea class="textarea" type="text" name="content" placeholder="Votre commentaire" required></textarea>
                  <br />
                </div>
              </div>
              <input class="input" type="hidden" name="bil_id" value="<?= Verif::filterInt($billets->getId()) ?>" />
              <div class="field is-grouped">
                <div class="control">
                  <button type="submit" class="button is-link" name="btn-comment" title="Enregistrer le commentaire">Commenter</button>
                </div>
                <div class="control">
                  <button class="button" type="reset" title="Effacer et recommencer la saisie">
                    Effacer
                  </button>
                </div>
              </div>
            </form>
          </div>
        </article>
      </div>
    </div>
  </div>
</section>