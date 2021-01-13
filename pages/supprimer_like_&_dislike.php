<?php
session_start();




require ('../classe/class-like-dislike.php'); 


$like = new Like_dislike(null,null,null,null,null);

$like_et_dislike = $_SESSION['like'];


$like->Supprimer_like_et_dislike($like_et_dislike);



?>