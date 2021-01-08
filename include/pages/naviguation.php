
<!-- Navigation -->

<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="<?php 
                if (!isset($repere)) {
                    echo '../index.php';
                }
                else {
                    echo 'index.php';
                }?>">Le forum des dealers de chloroquine</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php 
                if (!isset($repere)) {
                    echo '../index.php';
                }
                else {
                    echo 'index.php';
                }?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php 
                if (!isset($repere)) {
                    echo '../pages/topics.php';
                }
                else {
                    echo 'pages/topics.php';
                }?>">Topic</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="<?php 
                if (!isset($repere) && !isset($_SESSION['user'])) {
                    echo '../pages/inscription.php';
                }
                else {
                    echo 'pages/inscription.php';
                }?>">Inscription</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php 
                if (!isset($repere) && !isset($_SESSION['user'])) {
                    echo '../pages/connexion.php';
                }
                else {
                    echo 'pages/connexion.php';
                }?>">Connexion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php 
                if (!isset($repere) && isset($_SESSION['user'])) {
                    echo '../pages/profil.php';
                }
                else {
                    echo 'pages/profil.php';
                }?>">Profil</a>
          </li>

          <?php 
            if(isset($_SESSION['user']) && !isset($repere))
            {
                echo '<li class="nav-item"><a class="deco" href="../pages/logout.php"> Déconnexion </a></li>' ;
            }
            elseif(isset($_SESSION['user']) && isset($repere))
            {
                echo '<li class="nav-item"><a class="deco" href="pages/logout.php"> Déconnexion </a></li>' ;
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
