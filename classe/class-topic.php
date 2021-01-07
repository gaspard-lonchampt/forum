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
        $this->bdd = null;


        foreach ($topics as $key => $value )
            
            { 
                ?> 
            
            <div class="container d-block ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
            
                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                    <div class="media-body ml-3"> <a href=""><?php echo $value['sujet'] ?> </a>
                                        <div class="text-muted small"><?php echo $value['description'] ?></div>
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div>Nombre de conversations<strong> php à insérer</strong></div>
                                        <div>Nombre de messages<strong> php à insérer</strong></div>
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
        $this->bdd = null;


        foreach ($topics as $key => $value )
            
            { 
                ?> 
            
            <div class="container d-block ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
            
                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                    <div class="media-body ml-3"> <a href=""><?php echo $value['sujet'] ?> </a>
                                        <div class="text-muted small"><?php echo $value['description'] ?></div>
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div>Nombre de conversations<strong> php à insérer</strong></div>
                                        <div>Nombre de messages<strong> php à insérer</strong></div>
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
        $this->bdd = null;


        foreach ($topics as $key => $value )
            
            { 
                ?> 
            
            <div class="container d-block ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
            
                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                    <div class="media-body ml-3"> <a href=""><?php echo $value['sujet'] ?> </a>
                                        <div class="text-muted small"><?php echo $value['description'] ?></div>
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div>Nombre de conversations<strong> php à insérer</strong></div>
                                        <div>Nombre de messages<strong> php à insérer</strong></div>
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

        echo '<pre>';
        print_r($_POST) ;
        echo '</pre>';


        $requete = $this->bdd->query(' SELECT * FROM topics ' );
        $topics = $requete->fetchall();
        // $this->bdd = null;


        foreach ($topics as $key => $value )
            
            { 
                ?> 
            
            <div class="container d-block ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
            
                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                    <div class="media-body ml-3"> <a href=""><?php echo $value['sujet'] ?> </a>
                                        <div class="text-muted small"><?php echo $value['description'] ?></div>
                                    </div>
                                    <div class="text-muted small ml-3">
                                        <div>Nombre de conversations<strong> php à insérer</strong></div>
                                        <div>Nombre de messages<strong> php à insérer</strong></div>
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












}









?>