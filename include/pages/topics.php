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



    include('../classe/class-topic.php');

    $topic = new Topic(NULL,NULL, NULL,NULL, NULL);


   if  (!isset($_SESSION['user']['id_droit']))
    {
        $topic->afficher_topics_exsitants_public();
    }

    elseif (@$_SESSION['user']['id_droit'] == 1)
    {
        $topic->afficher_topics_exsitants_user_connecte();
    }

    elseif (@$_SESSION['user']['id_droit'] == 2)
    {
        $topic->afficher_topics_exsitants_moderateur();
    }

    elseif (@$_SESSION['user']['id_droit'] == 3)
    {
        $topic->afficher_topics_exsitants_admin();
        
    }

    else
    {
        echo ' y\'a un truc qui cloche Marty ' ;
    }




?>



















