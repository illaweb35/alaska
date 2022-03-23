<?php

/**
 * @author    Jean-Marie HOLLAND <illaweb35@gmail.com>
 * @copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://illaweb.fr
 */

use App\Check;

if ($_SESSION['authenticated']) {
  Check::verifSession();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css" />
  <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
  <link rel="stylesheet" href="<?= BASEPATH . 'css/master.css' ?>" />
  <title><?= $title ?></title>
</head>

<body>
  <header id="haut">
    <?php
    if (isset($_SESSION['authenticated'])) {
      include_once('_partials/navbar_admin.php');
    } else {
      include_once('_partials/navbar.php');
    } ?>
  </header>
  <section class="section">
    <div class="container">
      <?= $content ?>
    </div>
  </section>
  <?php include_once('_partials//footer.php') ?>