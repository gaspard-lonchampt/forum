<?php
include ('class-topic.php');


class Like_dislike extends Topic

{

private $id;
public $id_message;
public $id_user;
public $aime;
public $pas_aime;

public function __construc($id, $id_message, $id_user, $aime, $pas_aime)
{
$this->id = $id;
$this->id_message = $id_message;
$this->id_user = $id_user;
$this->aime = $aime;
$this->pas_aime = $pas_aime;
}

public function connection_bdd()
    {
        return $bdd = parent::connection_bdd();
    }

public function compte_nombre_like($variable)
    {  
        $bdd = $this->connection_bdd();
        $req2 = $bdd->prepare(' SELECT COUNT(*) FROM aime WHERE id_message = :id_message and aime = 1');// recherche nombre like
        $req2->execute(array( 'id_message' => $variable , ));
        return $req2->fetch();
    }

public function compte_nombre_dislike($variable)
    {
        $bdd = $this->connection_bdd();
        $req2 = $bdd->prepare(' SELECT COUNT(*) FROM aime WHERE id_message = :id_message and pas_aime = 1');// recherche nombre like
        $req2->execute(array( 'id_message' => $variable , ));
        return $req2->fetch();
    }



}
