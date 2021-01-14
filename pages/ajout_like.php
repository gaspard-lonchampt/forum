<?php
session_start();
if ( !isset($_SESSION['user']))
{  header('Location: message.php#mess_error_repondre_liker?id='.$_SESSION['id_get'].'');}//redirection}
require ('../classe/class-like-dislike.php'); 

$id_user = $_SESSION['user']['id'];
$like = new Like_dislike(null,null,null,null,null);
$id_message = $_GET['id'];
$like->ajout_like($id_message,$id_user);
header('Location: message.php?id=' .$_SESSION['id_get'].'#'.$id_message );//redirection


?>

