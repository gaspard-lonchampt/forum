<header class="masthead" style="background-image: url('../img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>Traditionnellement, les langages interprétés offrent en revanche une certaine portabilité</h1>
            <h2 class="subheading">Une fois l'algorithme défini, l'étape suivante est de coder le programme</h2>
            <span class="meta">"Un biscuit, ça n'a pas de spirit, c'est juste un biscuit..."
        
            JCVD, 2021</span>
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



















