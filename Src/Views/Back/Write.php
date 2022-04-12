<?php

use App\Verif;
?>
<section class="section">
  <div class="container">
    <h1 class="title">Poster un Billet</h1>
    <div class="content">
      <p>Utilisateur Connecté: <strong><?= Verif::filterName($_SESSION['name']) ?></strong></p>
    </div>
    <div class="box">
      <form action="<?= BASEPATH . 'Backedit/Create' ?>" method="post" enctype="multipart/form-data">
        <div class="field">
          <label for="Titre" name="title" class="label">Titre du billet</label>
          <input type="text" name="title" class="input" placeholder="Ici votre titre " value="
          <?php if (isset($_POST['title'])) {
            echo Verif::filterName($_POST['title']);
          } ?>" autofocus />
        </div>
        <div class="field">
          <div class="control">
            <textarea class="textarea" id="TinyModif" rows="8" type="text" name="content" value="
            <?php if (isset($_POST['content'])) {
              echo Verif::filterString($_POST['content']);
            } ?>">
            </textarea>
          </div>
        </div>
        <div class="columns">
          <div class="column">
            <div class="box">
              <p class="title is-5">Image à la une</p>
              <div class="field">
                <div class="file is-warning has-name is-boxed">
                  <label class="file-label">
                    <input class="file-input" type="file" name="image" />
                    <span class="file-cta">
                      <span class="file-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                      </span>
                      <span class="file-label">
                        Enregistrer l'image
                      </span>
                    </span>
                    <span>
                    </span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="box">
              <div class="field">
                <label class="label">Auteur</label>
                <input type="text" name="author" class="input" value="Jean Forteroche" />
              </div>
            </div>
            <div class="field">
              <label class="checkbox switch">
                <input type="checkbox" name="posted" />
                <span class="slider round"></span>
              </label>
              Poster
            </div>
          </div>
        </div>
    </div>
    <div class="column">
      <div class="field is-grouped">
        <div class="control">
          <button type="submit" class="button is-link" name="btn-billet" title="Enregistrer le billet">Enregistrer</button>
        </div>
        <div class="control">
          <button class="button" type="reset" title="effacer et recommencer la saisie">
            Effacer
          </button>
        </div>
      </div>
    </div>
    </form>
  </div>
  </div>
</section>