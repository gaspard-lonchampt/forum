<?php
    session_start(); 

    if(isset($_SESSION['user']))
    {
        if($_SESSION['user']['id_droit'] != 3)
        {
            header("Location: ../index.php") ;
        }
    }
    else{
        header("Location: ../index.php") ;
    }

    require ('../fonctions/fonctions.php') ;

    include ('../include/pages/head.php'); 
    include ('../include/pages/naviguation.php'); 
    include ('../include/pages/modif_droit.php'); 
    
    require ('../include/pages/footer.php'); 

    ?>
    