<?php
session_start();
if ( !isset($_SESSION['user']))
{  header('Location: message.php?id=' .$_SESSION['id_get']);}//redirection}

require ('../classe/class-like-dislike.php'); 


$like = new Like_dislike(null,null,null,null,null);

$dislike = $_SESSION['dislike'];
$like_et_dislike = $_SESSION['dislike'];
$id_message = $_GET['id'];
$id_user = $_SESSION['user']['id'];

$like->supprimer_dislike_ajout_like( $id_message, $id_user);

header('Location: message.php?id=' .$_SESSION['id_get'].'#'.$id_message );//redirection
?>