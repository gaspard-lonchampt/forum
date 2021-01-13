<?php
session_start();


require ('../classe/class-like-dislike.php'); 


$like = new Like_dislike(null,null,null,null,null);

$like_et_dislike = $_SESSION['dislike'];


$like->supprimer_like_ajout_dislike($like_et_dislike);


?>