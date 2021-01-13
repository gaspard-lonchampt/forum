<?php
session_start();


require ('../classe/class-like-dislike.php'); 


$like = new Like_dislike(null,null,null,null,null);

$dislike = $_SESSION['dislike'];


$like->supprimer_dislike_ajout_like( $dislike)


?>