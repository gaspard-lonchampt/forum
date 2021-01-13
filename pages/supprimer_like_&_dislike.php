<?php
session_start();

try 
{
    $bdd = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}


$_SESSION['like']['id'];

 $req = $bdd->prepare('DELETE FROM aime WHERE id = :id_like ');
                            $req->execute(array(
                           'id_like' => $_SESSION['like']['id'],                                                                         
                    
                           
                                              ));
                       $bdd = null;
                     

                      header('Location: topics-test-like.php');//redirection
                      exit();


?>