<?php
session_start();


require ('../classe/class-like-dislike.php'); 


$like = new Like_dislike(null,null,null,null,null);

$like_et_dislike = $_SESSION['dislike'];
$id_message = $_SESSION['id_message'];
$id_user = $_SESSION['user']['id'];


$like->supprimer_like_ajout_dislike($id_message, $id_user);

header('Location: message.php?id=' .$_SESSION['id_get']);//redirection
?>