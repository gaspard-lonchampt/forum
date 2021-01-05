<?php



class Topic

{

private $id;
public $id_createur;
public $sujet;
public $description;
public $date_heure_creation;
public $id_visibilite;





public function __construct($id, $id_createur, $sujet, $description, $date_heure_creation, $id_visibilite )
    {
       
        $this->id = $id;
        $this->id_createur = $id_createur ;
        $this->sujet = $sujet ;
        $this->description = $description ;
        $this->date_heure_creation = $date_heure_creation ;
        $this->id_visibilite = $id_visibilite ;

    }


function connection_bdd()

    {

            try 
            {
                $bdd = new PDO('mysql:host=localhost;dbname=discussion;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch (Exception $e)
            {
                die('Erreur : ' . $e->getMessage());
            }


        return $bdd;

    }


public function new_topic($id_createur, $sujet, $description, $date_heure_creation, $id_visibilite)
    {

        $bdd = connection_bdd();
        var_dump( $bdd);


        $req = $bdd->prepare('INSERT INTO topics (	id_createur, sujet, description, date_heure_creation, id_visibilite ) VALUES(:id_createur, :sujet, :description, :date_heure_creation, :id_visibilite )');
        $req->execute(array(
                        'id_createur' => $id_createur,      
                        'sujet' => $sujet, 
                        'id_createur' => $description, 
                        'id_createur' => $date_heure_creation, 
                        'password' => $id_visibilite,));
                    $bdd = null;

                    $_SESSION['inscription_ok'] = 'Vous avez bien été inscrit sur le site';

                    header('Location: connexion.php');//redirection
                    exit();




    var_dump( $this->id_createur, $this->sujet, $this->description);

    }











}









?>