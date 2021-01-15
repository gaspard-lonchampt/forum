<header class="masthead" style="background-image: url('../img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>" La programmation représente donc ici la rédaction du code source d'un logiciel "</h1>
            <h2 class="subheading">" L'ignorant affirme, le savant doute, le sage réfléchit "
</h2>
            <span class="meta">Alexandre, 2021
</span>
          </div>
        </div>
      </div>
    </div>
</header>

<?php


    include ('../classe/class_messages.php'); 
    $message = new Messages (NULL, NULL, NULL, NULL, NULL, NULL); 

    if (!isset($_SESSION['user']['id_droit'])) {
        $message->afficheMessagesPublic();
    }

    elseif ($_SESSION['user']['id_droit'] == 1) {
      
        $message->create_message();
        $message->afficheMessagesConnect();
      
    }

    elseif ($_SESSION['user']['id_droit'] == 2) {
        
        $message->create_message();
        $message->afficheMessagesModo();
        
     
    }

    elseif ($_SESSION['user']['id_droit'] == 3) {
    
        $message->create_message();
        $message->afficheMessagesAdmin();
    }

    else {
      echo "Erreur";
    }

    $_SESSION['id_get'] = $_GET['id'];

?>