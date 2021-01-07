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

    
}

// $user2 = new Utilisateur("titi" , "pass") ;
// $user2->connexionBdd("reservationsalles", "root","");
// $user2->checkLogin(); 





?>