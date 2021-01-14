<?php 
    // if ( $_SESSION['id_droit'] != 3)
    //     {
    //         header('Location:../index.php');
    //     }
?>

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
     include('../classe/class_messages.php');
     $message = new Messages(NULL,NULL, NULL,NULL, NULL,NULL);
     $retour_id_conv = $message->recupIdconv(); 
     $message->supprimer_message();
?>


  <div class="container mt-5 mb-5">
    <div class="row w-75 pt-5 pb-5 border m-auto">
      <div class="col-lg-8 col-md-10 mx-auto">
        <h1 class="text-center text-danger text-uppercase"> Message supprimé</h1>
        <p class="text-center text-primary">Vous allez être redirigé vers la page message</p>

      </div>
    </div>
  </div>

  <?php

  ?>
  <meta http-equiv="refresh" content="2.5;url=message.php?id=<?php echo $retour_id_conv ;?>" />






















