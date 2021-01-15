<header class="masthead" style="background-image: url('../img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>Vous souhaitez connaître toutes les possibilités de la balise &lt;p&gt; ? Percer tous les mystères d'un &lt;/br&gt; ? </h1>
            <h2 class="subheading">Vous êtes au bon endroit !</h2>
            <span class="meta">Le forum des devs qui déchirent</span>
          </div>
        </div>
      </div>
    </div>
  </header>

<?php


    include ('../classe/conversation.php'); 
    $conversation = new Conversation (NULL, NULL, NULL, NULL, NULL, NULL); 

    if (!isset($_SESSION['user']['id_droit'])) {
      $conversation->display_conversation_public();
    }

    elseif ($_SESSION['user']['id_droit'] == 1) {
      
      $conversation->create_conversation();
      $conversation->display_conversation_user ();
      
    }

    elseif ($_SESSION['user']['id_droit'] == 2) {
      $conversation->create_conversation();
      $conversation->display_conversation_moderateur ();
     
    }

    elseif ($_SESSION['user']['id_droit'] == 3) {
    
      $conversation->create_conversation();
      $conversation->display_conversation_admin ();
      
    }

    else {
      echo "C'est pas une science exacte, on est à une vache près";
    }



?>
