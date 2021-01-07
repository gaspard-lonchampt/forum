<?php

    function setProfile(int $droit)
    {
        $connexion = new PDO('mysql:host=localhost;dbname=forum','root','');
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

        $requete = $connexion->prepare("UPDATE utilisateurs
                                            SET id_droit = :new_id"
        );

        $requete->bindParam(':new_id', $droit); 

        if($droit == 0 || $droit == 1 || $droit == 2)
        {
            $requete->execute(); 
            echo 'Changement effectué';
        }
        else{
            echo 'Impossible de changer les droits de l\'utilisateur' ; 
        }

    } 


?>