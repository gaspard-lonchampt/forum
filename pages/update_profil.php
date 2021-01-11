<?php

    require ("../fonctions/fonctions.php");

    if($_POST['droit'] == 'Normal'){
        setProfile(0, $_GET['id']); 
        header("Location: modif_droit.php");
        exit();
    }
    elseif($_POST['droit'] == 'Modérateur'){
        setProfile(1,$_GET['id']); 
        header("Location: modif_droit.php");
        exit();
    }
    elseif($_POST['droit'] == 'Administrateur'){
        setProfile(2,$_GET['id']); 
        header("Location: modif_droit.php");
        exit();
    }


?>