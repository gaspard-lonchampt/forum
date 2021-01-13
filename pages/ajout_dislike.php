<?php

try 
{
    $bdd = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}


$id_message= 10;
$id_user = 1;
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
                     

                      header('Location: topics-test-like.php');//redirection
                      exit();


?>