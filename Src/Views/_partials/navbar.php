<?php
/**
 * @author    Jean-Marie HOLLAND <illaweb35@gmail.com>
 *@copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
 *
 *@license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 *@link       https://illaweb.fr
 */
?>
<nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <div class="navbar-item">
      <a class="navbar-item" href="<?= BASEPATH ?>" title="Retour à la page d'accueil">
        <img src="<?= BASEPATH . 'img/Logo.png' ?>" alt="alaska Logo">
        <div class="brand-content">
          <div class="brand-title">
            <h1 class="title">Blog</h1>
          </div>
          <div class="brand-subtitle">
            <p>Billet simple pour l'Alaska</p>
          </div>
        </div>
      </a>
    </div>
    <button class="button navbar-burger" data-target="navMenu">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
  <div class="navbar-menu" id="navMenu">
    <div class="navbar-end">
      <a href="<?= BASEPATH ?>" class="navbar-item">Accueil</a>
      <a href="<?= BASEPATH . 'Front/ListPost' ?>" class="navbar-item">Blog</a>
      <a href="<?= BASEPATH . 'Main/Login' ?>" class="navbar-item">Admin</a>
    </div>
  </div>
</nav>