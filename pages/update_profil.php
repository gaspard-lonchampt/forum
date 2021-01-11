<?php
    session_start(); 
    require ("../fonctions/fonctions.php");

    if(isset($_SESSION['user']))
    {
        if($_SESSION['user']['id_droit'] != 2)
        {
            header("Location: ../index.php") ;
        }
    }
    else{
        header("Location: ../index.php") ;
    }

    if($_POST['droit'] == 'Normal'){
        setProfile(0, $_GET['id']); 
        $_SESSION['message'] = '<p class="valide changement_droit"> Changement effectuer </p>' ; 
        header("Location: modif_droit.php");
        exit();
    }
    elseif($_POST['droit'] == 'Modérateur'){
        setProfile(1,$_GET['id']); 
        $_SESSION['message'] = '<p class="valide changement_droit"> Changement effectuer </p>' ; 
        header("Location: modif_droit.php");
        exit();
    }
    elseif($_POST['droit'] == 'Administrateur'){
        setProfile(2,$_GET['id']); 
        $_SESSION['message'] = '<p class="valide changement_droit"> Changement effectuer </p>' ; 
        header("Location: modif_droit.php");
        exit();
    }


?>