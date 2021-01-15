<?php 
    // if ( $_SESSION['id_droit'] != 3)
    //     {
    //         header('Location:../index.php');
    //     }
?>

<header class="masthead" style="background-image: url('img/index.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Dev4Code</h1></br></br>
            <span class="subheading">Le forum des Devs qui Codent</span>
          </div>
        </div>
      </div>
    </div>
  </header>






<?php //----------------------------------------------A TOI DE METTRE EN DESSOUS TA METHODE POUR SUPPRIMER LES MESSAGES
    // include('../classe/class-topic.php');
    // $topic = new Topic(NULL,NULL, NULL,NULL, NULL);
    // $topic->supprimer_topic();
?>


  <div class="container mt-5 mb-5">
    <div class="row w-75 pt-5 pb-5 border m-auto">
      <div class="col-lg-8 col-md-10 mx-auto">
        <h1 class="text-center text-danger text-uppercase"> topic supprimé</h1>
        <p class="text-center text-primary">Vous allez être redirigé vers la page topic</p>

      </div>
    </div>
  </div>

<!-- --------------------------   PENSES A METTRE A JOURS LE LIEN DE REDIRECTION, LA IL POINTE SUR LA PAGE TOPIC -->
  <meta http-equiv="refresh" content="2.5;url=topics.php" />






















