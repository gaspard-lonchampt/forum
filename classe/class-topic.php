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


function connection_bdd()

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




public function recherche_topics_existants()
    {



        $requete = $this->bdd->query(' SELECT * FROM topics ' );
        $topics = $requete->fetchall();
        $bdd = null;

        return $topics;
    // var_dump($donnees_messages );

    }






public function new_topic()
    {


        // var_dump( $bdd);


        $req = $this->bdd->prepare('INSERT INTO topics (	id_createur, sujet, description, date_heure_creation, id_visibilite ) VALUES(:id_createur, :sujet, :description, :date_heure_creation, :id_visibilite )');
        $req->execute(array(
                        'id_createur' => $this->$id_createur,      
                        'sujet' => $sujet, 
                        'id_createur' => $description, 
                        'id_createur' => $date_heure_creation, 
                        'password' => $id_visibilite,));

        $this->bdd = null;

                    $_SESSION['inscription_ok'] = 'Vous avez bien été inscrit sur le site';

                    header('Location: connexion.php');//redirection


    var_dump( $this->bdd );

    }











}









?>