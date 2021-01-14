<?php
session_start();
require ('../classe/class-like-dislike.php'); 

$id_user = $_SESSION['user']['id'];
$like = new Like_dislike(null,null,null,null,null);
$id_message = $_GET['id'];
$like->ajout_like($id_message,$id_user);

header('Location: message.php?id=' .$_SESSION['id_get']);//redirection


?>

