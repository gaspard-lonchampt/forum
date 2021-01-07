<?php

class Topic

{

private $id;
public $id_createur;
public $sujet;
public $description;
public $date_heure_creation;
public $id_visibilite;

public function __construct( $id_createur, $sujet, $description, $date_heure_creation, $id_visibilite )

    {
       
        $this->id_createur = $id_createur ;
        $this->sujet = $sujet ;
        $this->description = $description ;
        $this->date_heure_creation = $date_heure_creation ;
        $this->id_visibilite = $id_visibilite ;
        $this->bdd = $this->connection_bdd() ;

    }

public function connection_bdd()



    {

            try 
            {
                $bdd = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch (Exception $e)
            {
                die('Erreur : ' . $e->getMessage());
            }


        return $bdd;

    }

    public function afficher_topics_exsitants_public()

    {
        $requete = $this->bdd->query(' SELECT * FROM topics where id_visibilite = 0' );
        $topics = $requete->fetchall();
        


        foreach ($topics as $key => $value )
            
            {   $nombre_conversations = $this->compter_nombre_conversation($value['id']);
                $nombre_messages = $this->compter_nombre_messages($value['id']);
                ?> 
            
            <div class="container d-block ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
            
                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                    <div class="media-body ml-3"> <a href="conversations.php?id=<?php echo $value['id']?>"><?php echo $value['sujet'] ?> </a>
                                        <div class="text-muted small"><?php echo $value['description'] ?></div>
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div>Nombre de conversations : <strong> <?php echo $nombre_conversations[0]; ?></strong></div>
                                        <div>Nombre de messages : <strong><?php echo $nombre_messages[0]; ?></strong></div>
                                    </div>
                                </div>
                            </div>
            
            
                        </div>
                    </div>
                </div>
            </div>
            
            
                <?php


            }
            


    }


    public function afficher_topics_exsitants_user_connecte()


    {
        $requete = $this->bdd->query(' SELECT * FROM topics where id_visibilite <= 1' );
        $topics = $requete->fetchall();



        foreach ($topics as $key => $value )
            
            {   $nombre_conversations = $this->compter_nombre_conversation($value['id']);
                $nombre_messages = $this->compter_nombre_messages($value['id']);

                ?> 
            
            <div class="container d-block ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
            
                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                    <div class="media-body ml-3"> <a href="conversations.php?id=<?php echo $value['id']?>"><?php echo $value['sujet'] ?> </a>
                                        <div class="text-muted small"><?php echo $value['description'] ?></div>
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div>Nombre de conversations : <strong> <?php echo $nombre_conversations[0]; ?></strong></div>
                                        <div>Nombre de messages : <strong><?php echo $nombre_messages[0]; ?></strong></div>
                                    </div>
                                </div>
                            </div>
            
            
                        </div>
                    </div>
                </div>
            </div>
            
            
                <?php
    
            }
            


    }



    public function afficher_topics_exsitants_moderateur()

    {
        $requete = $this->bdd->query(' SELECT * FROM topics where id_visibilite <= 2' );
        $topics = $requete->fetchall();



        foreach ($topics as $key => $value )
            
            {   $nombre_conversations = $this->compter_nombre_conversation($value['id']);
                $nombre_messages = $this->compter_nombre_messages($value['id']);

                ?> 
            
            <div class="container d-block ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
            
                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                    <div class="media-body ml-3"> <a href="conversations.php?id=<?php echo $value['id']?>"><?php echo $value['sujet'] ?> </a>
                                        <div class="text-muted small"><?php echo $value['description'] ?></div>
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div>Nombre de conversations : <strong> <?php echo $nombre_conversations[0]; ?></strong></div>
                                        <div>Nombre de messages : <strong><?php echo $nombre_messages[0]; ?></strong></div>
                                    </div>
                                </div>
                            </div>
            
            
                        </div>
                    </div>
                </div>
            </div>
            
            
                <?php

            }
            


    }
    


public function afficher_topics_exsitants_admin()

    {

        $requete = $this->bdd->query(' SELECT * FROM topics ' );
        $topics = $requete->fetchall();

        foreach ($topics as $key => $value )
            
            {   $nombre_conversations = $this->compter_nombre_conversation($value['id']);
                $nombre_messages = $this->compter_nombre_messages($value['id']);
                ?> 
            
            <div class="container d-block ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
            
                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                    <div class="media-body ml-3"> <a href="conversations.php?id=<?php echo $value['id']?>"><?php echo $value['sujet'] ?> </a>
                                        <div class="text-muted small"><?php echo $value['description'] ?></div>
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div>Nombre de conversations : <strong> <?php echo $nombre_conversations[0]; ?></strong></div>
                                        <div>Nombre de messages : <strong><?php echo $nombre_messages[0]; ?></strong></div>
                                        </br>
                                        <div ><a class="text-danger" href="supprimer_topic_confirm.php?id=<?php echo $value['id'];?>">supprimer le topic</a></div>
                                    </div>
                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
  
          
            }
            

            include('../include/pages/formulaire_creation_topic.php');

           if ( isset($_POST['submit']))
           {
            $this->new_topic();
           }
        
    }


public function new_topic()
    {


        // echo '<pre>';
        // print_r($_POST) ;
        // echo '</pre>';
        @$sujet = htmlspecialchars($_POST['Sujet']);
        @$Description = htmlspecialchars($_POST['Description']);

        date_default_timezone_set('Europe/Paris');
        $today = date("Y-m-d H:i:s"); 
      

        $req = $this->bdd->prepare('INSERT INTO topics (	id_createur, sujet, description, date_heure_creation, id_visibilite ) VALUES(:id_createur, :sujet, :description, :date_heure_creation, :id_visibilite )');
        $req->execute(array(
                        'id_createur' => $_SESSION['id_createur'],      
                        'sujet' => $sujet, 
                        'description' => $Description, 
                        'date_heure_creation' => $today, 
                        'id_visibilite' => $_POST['visibilite'],));

        $this->bdd = null;

        header('location:new_topic_cree_confirm.php');

            

    }

public function supprimer_topic()
    {


        $req = $this->bdd->prepare('DELETE FROM topics where id = :id');
        $req->execute(array(
                        'id' => $_GET['id'],      
                     ));

        $this->bdd = null;
            

    }



public function compter_nombre_conversation($a)
    {

        $req = $this->bdd->prepare('SELECT COUNT(*) FROM conversations where id_topic = :id ');
        $req->execute(array(
                'id' => $a,      
                ));

        // echo '<pre>';
        // print_r($topics) ;
        // echo '</pre>';


        return $resultat_conversations = $req->fetch();


    }


public function compter_nombre_messages($a)
    {

        $req = $this->bdd->prepare('SELECT COUNT(*) FROM messages where id_topic = :id ');
        $req->execute(array(
                'id' => $a,      
                ));


        return $resultat_messages = $req->fetch();

        // echo '<pre>';
        // print_r($resultat_messages) ;
        // echo '</pre>';

    }





}









?>