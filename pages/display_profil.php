<header class="masthead" style="background-image: url('../img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>Man must explore, and this is exploration at its greatest</h1>
            <h2 class="subheading">Problems look mighty small from 150 miles up</h2>
            <span class="meta">Posted by
              <a href="#">Start Bootstrap</a>
              on August 24, 2019</span>
          </div>
        </div>
      </div>
    </div>
  </header>

<?php

// rajouter redirection en fonction de l'index
session_start();

if(!isset($_SESSION['user']))
{
    header("Location: ../index.php") ; 
}
require ('../include/pages/head.php');  
include ('../include/pages/naviguation.php'); 
include ("../classe/class_utilisateur.php"); 

        $user = new Utilisateur(NULL, NULL, NULL ,NULL, NULL, NULL );
        $user->connexionBdd("forum", "root","root");
        $user->profilDisplay();


require ('../include/pages/footer.php'); 

?>