<header class="masthead" style="background-image: url('../img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>Dans un programme informatique typique, on trouvera suivant les langages des boucles while ou for</h1>
            <h2 class="subheading">" On ne peut comprendre la vie qu'en regardant en arrière ; on ne peut la vivre qu'en regardant en avant "
</h2>
            <span class="meta">Patrick Sébastien, 2020
              
              </span>
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
        $user->connexionBdd("forum", "root","");
        $user->profilDisplay();


require ('../include/pages/footer.php'); 

?>