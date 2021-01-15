<?php
session_start();
if ( !isset($_SESSION['user']))
{  header('Location: message.php?id='.$_SESSION['id_get'].'#mess_error_repondre_liker');}//redirection}

require ('../classe/class-like-dislike.php'); 


$like = new Like_dislike(null,null,null,null,null);

$like_et_dislike = $_SESSION['dislike'];
$id_message = $_GET['id'];
$id_user = $_SESSION['user']['id'];


$like->supprimer_like_ajout_dislike($id_message, $id_user);

header('Location: message.php?id=' .$_SESSION['id_get'].'#'.$id_message );//redirection
?>