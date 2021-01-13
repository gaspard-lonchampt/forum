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

public function affiche_bouton_sans_like_ni_dislike($variable_1, $variable_2, $variable_3,$variable_4)
    {
        $bdd = $this->connection_bdd();
        $req = $bdd->prepare(' SELECT * FROM aime WHERE id_user = :id and id_message = :id_mess ');
        $req->execute(array( 'id' => $variable_1 , 'id_mess' => $variable_2 ));
        $resultat_null = $req->fetch(PDO::FETCH_ASSOC);

        if ($resultat_null == null )
        {

        ?>
        </br></br></br></br></br></br></br></br></br>
     

                                <div class="d-flex h-25">
                                    <a href="ajout_like.php"  title="j'aime"><img class="img_like" src="../img/like.png" alt=""></a>
                                    <p><?php echo ' '. $variable_3[0]; ?> </p>
                                    <a href="ajout_dislike.php"  title="je n'aime pas"><img class="img_like" src="../img/dislike.png" alt=""></a>
                                    <p><?php echo ' '. $variable_4[0]; ?></p>
                                </div>
           
        <?php
        }
    }

}
