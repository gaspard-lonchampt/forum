<?php
session_start();




require ('../classe/class-like-dislike.php'); 


$like = new Like_dislike(null,null,null,null,null);


$id_user = $_SESSION['user']['id'];
$id_message = $_GET['id'];
$like->Supprimer_like_et_dislike($id_message, $id_user);

header('Location: message.php?id=' .$_SESSION['id_get']);//redirection

?>