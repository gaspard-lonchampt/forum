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

    $_SESSION['id_droit'] = 2;

    include ('../classe/conversation.php'); 
    $conversation = new Conversation (NULL, NULL, NULL, NULL, NULL, NULL); 

    if (!isset($_SESSION['id_droit'])) {
      $conversation->display_conversation_public();
    }

    elseif ($_SESSION['id_droit'] == 0) {
      $conversation->display_conversation_user ();
    }

    elseif ($_SESSION['id_droit'] == 1) {
      $conversation->display_conversation_moderateur ();
    }

    elseif ($_SESSION['id_droit'] == 2) {
      $conversation->display_conversation_admin ();
    }

    else {
      echo "C'est pas une science exacte, on est à une vache près";
    }

?>
