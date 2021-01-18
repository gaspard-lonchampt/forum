<?php

    function setProfile(int $droit , $login)
    {
        $connexion = new PDO('mysql:host=localhost;dbname=forum','root','');
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

        $requete = $connexion->prepare("UPDATE utilisateurs
                                            SET id_droit = :new_id
                                                WHERE id = :id"
        );

        $requete->bindParam(':new_id', $droit); 
        $requete->bindParam(':id', $_GET['id']);

        if($droit == 1 || $droit == 2 || $droit == 3)
        {
            $requete->execute(); 
            echo 'Changement effectué';
        }
        else{
            echo 'Impossible de changer les droits de l\'utilisateur' ; 
        }

    } 


?>