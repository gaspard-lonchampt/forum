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

public function affiche_bouton_sans_like_ni_dislike($variable_1, $variable_2)
    {
        $bdd = $this->connection_bdd();
        $req = $bdd->prepare(' SELECT * FROM aime WHERE id_user = :id and id_message = :id_mess ');
        $req->execute(array( 'id' => $variable_1 , 'id_mess' => $variable_2 ));
        $resultat_null = $req->fetch(PDO::FETCH_ASSOC);

        $nombre_like = $this->compte_nombre_like($variable_2);

        $nombre_dislike = $this->compte_nombre_dislike($variable_2);

        if ($resultat_null == null )
        {

        ?>
        
     

                                <div class="d-flex h-25">
                                    <a href="ajout_like.php"  title="j'aime"><img class="img_like" src="../img/like.png" alt=""></a>
                                    <p><?php echo ' '. $nombre_like[0]; ?> </p>
                                    <a href="ajout_dislike.php"  title="je n'aime pas"><img class="img_like" src="../img/dislike.png" alt=""></a>
                                    <p><?php echo ' '. $nombre_dislike[0]; ?></p>
                                </div>
           
        <?php
        }
    }



public function affiche_bouton_avec_like($variable_1, $variable_2)
    {
        $bdd = $this->connection_bdd();
        $req = $bdd->prepare(' SELECT * FROM aime WHERE id_user = :id and id_message = :id_mess ');
        $req->execute(array( 'id' => $variable_1 , 'id_mess' => $variable_2 ));
        $recherche_like = $req->fetch(PDO::FETCH_ASSOC);
        

        $nombre_like = $this->compte_nombre_like($variable_2);

        $nombre_dislike = $this->compte_nombre_dislike($variable_2);

        if (@$recherche_like['aime'] == 1 )
        {
        
        ?>
        

        
                                <div class="d-flex h-25">
                                    <a href="supprimer_like_&_dislike.php"  title="j'aime"><img class="img_like" src="../img/like_checked.png" alt=""></a>
                                    <p><?php echo ' '. $nombre_like[0]; ?> </p>
                                    <a href="supprimer_like_ajout_dislike.php"  title="je n'aime pas"><img class="img_like" src="../img/dislike.png" alt=""></a>
                                    <p><?php echo ' '. $nombre_dislike[0]; ?></p>
                                </div>
                                
 
        <?php
        }
        return $_SESSION['like']=$recherche_like;
    }   




public function affiche_bouton_avec_dislike($variable_1, $variable_2)
    {
        $bdd = $this->connection_bdd();
        $req = $bdd->prepare(' SELECT * FROM aime WHERE id_user = :id and id_message = :id_mess ');
        $req->execute(array( 'id' => $variable_1 , 'id_mess' => $variable_2 ));
        $recherche_dislike = $req->fetch(PDO::FETCH_ASSOC);
        

        $nombre_like = $this->compte_nombre_like($variable_2);

        $nombre_dislike = $this->compte_nombre_dislike($variable_2);

        if (@$recherche_dislike['pas_aime'] == 1 )
        {
        
        ?>
       

        
                    <div class="d-flex h-25">
                            <a href="supprimer_dislike_ajout_like.php"  title="j'aime"><img class="img_like" src="../img/like.png" alt=""></a>
                            <p><?php echo ' '. $nombre_like[0]; ?> </p>
                            <a href="supprimer_like_&_dislike.php"  title="je n'aime pas"><img class="img_like" src="../img/dislike_checked.png" alt=""></a>
                            <p><?php echo ' '. $nombre_dislike[0]; ?></p>
                        </div>
                                
 
        <?php
        }
        return $_SESSION['dislike']=$recherche_dislike;;
    }   





public function Supprimer_like_et_dislike($a)
    {

        $bdd = $this->connection_bdd();
        $req = $bdd->prepare('DELETE FROM aime WHERE id = :id_like ');
        $req->execute(array('id_like' => $a['id']));
        $bdd = null;

        header('Location: messages.php');//redirection

    }


    
public function supprimer_dislike_ajout_like($a)
    {
        $bdd = $this->connection_bdd();

        $req = $bdd->prepare('DELETE FROM aime WHERE id = :id_like ');
        $req->execute(array('id_like' => $a['id']));
                    
                            
        $id_message= $a['id_message'];
        $id_user = $a['id_user'];
        $aime = 1;
        $pas_aime = 0;

        $req = $bdd->prepare('INSERT INTO aime(id_message, id_user,aime,pas_aime) VALUES(:id_message, :id_user, :aime, :pas_aime)');
        $req->execute(array(
            'id_message' => $id_message,                                                                         
            'id_user' => $id_user,
            'aime' => $aime,
            'pas_aime' => $pas_aime,
                    ));
        $bdd = null;


        header('Location: messages.php');//redirection
    }


public function supprimer_like_ajout_dislike($a)
    {
        $bdd = $this->connection_bdd();
        $req = $bdd->prepare('DELETE FROM aime WHERE id = :id_like ');
        $req->execute(array('id_like' => $a['id'] ));
                
        $id_message= $a['id_message'];
        $id_user = $a['id_user'];
        $aime = 0;
        $pas_aime = 1;

        $req = $bdd->prepare('INSERT INTO aime(id_message, id_user,aime,pas_aime) VALUES(:id_message, :id_user, :aime, :pas_aime)');
        $req->execute(array(
            'id_message' => $id_message,                                                                         
            'id_user' => $id_user,
            'aime' => $aime,
            'pas_aime' => $pas_aime,
                    ));
        $bdd = null;

        header('Location: messages.php');//redirection
    }


public function ajout_dislike($id_message,$id_user)
    {
        $bdd = $this->connection_bdd();
        
        
        $id_message = $value['id'];
        $id_user = $_SESSION['user']['id'];
        $aime = 0;
        $pas_aime = 1;
        $req = $bdd->prepare('INSERT INTO aime(id_message, id_user,aime,pas_aime) VALUES(:id_message, :id_user, :aime, :pas_aime)');
                                    $req->execute(array(
                                   'id_message' => $id_message,                                                                         
                                   'id_user' => $id_user,
                                   'aime' => $aime,
                                   'pas_aime' => $pas_aime,
                                                      ));
                               $bdd = null;
                             
        
                              header('Location: message.php');//redirection
        
    }



}
