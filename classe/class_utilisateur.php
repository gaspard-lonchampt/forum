<?php

class Utilisateur {

    private $id ;
    public $login; 
    public $password; 
    public $nom;
    public $prenom;
    public $age;
    private $id_droit;

    public function __construct($login,$password,$nom,$prenom,$age,$id_droit)
    {
        $this->login = $login ;
        $this->password = $password ;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->id_droit = $id_droit; 
    }

    public function connexionBdd($bdd, $user, $pass)
    {

    
        try{
            $connexion = new PDO('mysql:host=localhost;dbname='.$bdd,$user,$pass);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

            $this->connexion = $connexion ; 
            // echo 'connexion réussi' ;
            return $this->connexion;


        }
        catch(PDOExeption $e)
        {
            echo 'echec de la connexion : ' .$e->getMessage();
        }
    }

    public function checkLogin()
    {
        $requete = $this->connexion->prepare("SELECT COUNT(login) FROM utilisateurs WHERE login = :login "); 
        $requete->bindParam(':login',$this->login) ;
        $requete->execute();

        $count = $requete->fetchColumn() ;

        if($count == 0)
        {
            return 0 ; 
        }
        elseif($count == 1)
        {
            return 1 ; 
        }
        else
        {
            return -1 ; 
        }
    }
        
    public function inscription()
    {
        if($this->checkLogin() == 0)
        {

            $requete = $this->connexion->prepare("INSERT INTO utilisateurs(login,password,nom,prenom,age,id_droit) 
                                                            VALUES (:login, :password, :nom, :prenom, :age, :id_droit)"); 
                    
            $requete->bindParam(':login', $this->login);
            $requete->bindParam(':password', $this->password);
            $requete->bindParam(':nom', $this->nom);
            $requete->bindParam(':prenom', $this->prenom);
            $requete->bindParam(':age', $this->age);
            $requete->bindParam(':id_droit', $this->id_droit);

            $requete->execute();

            header("Location: connexion.php");
    
        }
        else{
            return '<p class="error"> Login déjà pris </p>';
           
        }
    }

    public function connect()
    {
        $requete = $this->connexion->prepare("SELECT * FROM utilisateurs WHERE login = :login ") ;

        $requete->bindParam(':login',$this->login) ;
                
        $requete->execute();
        $result = $requete->fetch() ;

        if($result && password_verify($this->password,$result['password']))
        {
            return $result ; 
        }
        
    }

    public function update($id)
    {
        if($this->checkLogin() == 0)
        {

            $requete = $this->connexion->prepare("UPDATE utilisateurs 
                        SET login = :newlogin,
                            password = :newpass,
                            nom = :newnom,
                            prenom = :newprenom,
                            age = :newage
                                WHERE id = :id "
            );

            $requete->bindParam(":newlogin", $this->login );
            $requete->bindParam(":newpass", $this->password );
            $requete->bindParam(":newnom", $this->nom );
            $requete->bindParam(":newprenom", $this->prenom );
            $requete->bindParam(":newage", $this->age );
            $requete->bindParam(":id", $id );

            $requete->execute();

            return '<p class ="valide"> Changement effectué </p>' ;

        }
        else{
            return '<p class="error"> Login déjà pris </p>' ;
        }

    }

    public function getAllinfos()
    {
        $requete = $this->connexion->prepare("SELECT * FROM utilisateurs WHERE login = :login") ;
        $requete->bindParam(':login', $this->login) ;

        $requete->execute(); 

        $result = $requete->fetch(); 

        return $result ;
    }

    public function getDroit()
    {
        $requete = $this->connexion->prepare("SELECT id_droit FROM utilisateurs WHERE login = :login") ;
        $requete->bindParam(':login',$this->login) ;

        $requete->execute();

        $result = $requete->fetch(); 

        return $result['id_droit'] ;
    }

    public function profilDisplay()
    {
        $requete = $this->connexion->prepare(
            "SELECT * FROM utilisateurs WHERE utilisateurs.id_droit=1"
        );

        $requete->execute();

        $result = $requete->fetchall(); 
        
        include ("../classe/class-topic.php");
        
       
        
        
        $topic = new Topic(NULL,NULL, NULL,NULL, NULL);

        
        foreach ($result as $key => $value ) { 
            $nombre_conversations= $topic->compter_nombre_conversation($value['id']);
            $nombre_messages = $topic->compter_nombre_messages($value['id']);
       

            ?>
        
        <div class="container d-block p-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                            <div class="media-body ml-3"> <?php echo $value['login'] ?>
                            <hr>
                            <div class="container d-flex">
                                <div class="container d-flex flex-column">
                                <div class="media-body ml-2"><?php echo "Nom:&nbsp". "<strong>". $value['nom'] ."</strong>" ?></div>
                                <div class="media-body ml-2"><?php echo "Prénom:&nbsp". "<strong>". $value['prenom'] ."</strong>" ?></div>
                                <div class="media-body ml-2"><?php echo "Age:&nbsp". "<strong>". $value['age'] ."</strong>" ?></div>
                                </div>
                                <div class="text-muted small">
                                    <div>Nombre de conversations : <strong> <?php echo $nombre_conversations[0]; ?></strong></div>
                                    <div>Nombre de messages : <strong><?php echo $nombre_messages[0]; ?></strong></div>
                                </div>
                                </div>
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


}

// $user2 = new Utilisateur("titi" , "pass") ;
// $user2->connexionBdd("reservationsalles", "root","");
// $user2->checkLogin(); 





?>