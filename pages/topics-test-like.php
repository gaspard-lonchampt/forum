<?php 
session_start();
require ('../include/pages/head.php'); 


require ('../include/pages/naviguation.php'); 

require ('../classe/class-like-dislike.php'); 





$like = new Like_dislike(null,null,null,null,null);


$id_user = 1;
$id_message = 10;

// $nombre_like = $like->compte_nombre_like($id_message);

// $nombre_dislike = $like->compte_nombre_dislike($id_message);

$like->affiche_bouton_sans_like_ni_dislike($id_user, $id_message );

$like->affiche_bouton_avec_like($id_user, $id_message );

$like->affiche_bouton_avec_dislike($id_user, $id_message );
// $req = $bdd->query('SELECT * FROM aime');

require ('../include/pages/footer.php'); 
?>
