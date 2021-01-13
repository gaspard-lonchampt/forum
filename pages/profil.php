<?php


// rajouter redirection en fonction de l'index
session_start();

if(!isset($_SESSION['user']))
{
    header("Location: ../index.php") ; 
}

include ("../classe/class_utilisateur.php"); 
include ('../include/pages/naviguation.php'); 
include ('../include/pages/profil.php'); 


require ('../include/pages/footer.php'); 

?>