<?php 
session_start();
require ('../include/pages/head.php'); 


require ('../include/pages/naviguation.php'); 

try 
{
    $bdd = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}


$id_user = 1;
$id_message = 10;

// $req = $bdd->query('SELECT * FROM aime');
// echo '<pre>';
// var_dump($req);
// echo '</pre>';



$req2 = $bdd->prepare(' SELECT COUNT(*) FROM aime WHERE id_message = :id_message and aime = 1');// recherche nombre like
$req2->execute(array( 'id_message' => $id_message , ));
$nombre_like = $req2->fetch();


$req2 = $bdd->prepare(' SELECT COUNT(*) FROM aime WHERE id_message = :id_message and pas_aime = 1');// recherche nombre disllike
$req2->execute(array( 'id_message' => $id_message , ));
$nombre_dislike = $req2->fetch();








// affichage si pas de LIKE ni de DISLIKE
$req = $bdd->prepare(' SELECT * FROM aime WHERE id_user = :id and id_message = :id_mess ');
$req->execute(array( 'id' => $id_user , 'id_mess' => $id_message ));
$resultat_null = $req->fetch(PDO::FETCH_ASSOC);

if ($resultat_null == null )
{

?>
</br></br></br></br></br></br></br></br></br>
<div class="container d-block ">
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">

            <div class="card-header">
                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                    <div class="media-body ml-3"> <a href="conversation.php?id=</a>
                        <div class="text-muted small">test</div>
                    </div>
                    <div class="text-muted small ml-3">
                        <div>Nombre de conversations : <strong>test</strong></div>
                        <div>Nombre de messages : <strong>test</strong></div>

                        <div class="d-flex h-25">
                            <a href="ajout_like.php"  title="j'aime"><img class="img_like" src="../img/like.png" alt=""></a>
                            <p><?php echo ' '. $nombre_like[0]; ?> </p>
                            <a href="ajout_dislike.php"  title="je n'aime pas"><img class="img_like" src="../img/dislike.png" alt=""></a>
                            <p><?php echo ' '. $nombre_dislike[0]; ?></p>
                        </div>
                        
                        </br>
                    </div>
                </div>
            </div>     
        </div>
    </div>
</div>
</div>
<?php
}




// affichage si LIKE trouvé
$req = $bdd->prepare(' SELECT * FROM aime WHERE id_user = :id and id_message = :id_mess ');
$req->execute(array( 'id' => $id_user , 'id_mess' => $id_message ));
$recherche_like = $req->fetch(PDO::FETCH_ASSOC);
$_SESSION['like']=$recherche_like;

echo '<pre>';
var_dump($_SESSION['like']);
echo '</pre>';
if ($recherche_like['aime'] == 1 )
{

?>
</br></br></br></br></br></br></br></br></br>
<div class="container d-block ">
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">

            <div class="card-header">
                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                    <div class="media-body ml-3"> <a href="conversation.php?id=</a>
                        <div class="text-muted small">test</div>
                    </div>
                    <div class="text-muted small ml-3">
                        <div>Nombre de conversations : <strong>test</strong></div>
                        <div>Nombre de messages : <strong>test</strong></div>

                        <div class="d-flex h-25">
                            <a href="supprimer_like_&_dislike.php"  title="j'aime"><img class="img_like" src="../img/like_checked.png" alt=""></a>
                            <p><?php echo ' '. $nombre_like[0]; ?> </p>
                            <a href="supprimer_like_ajout_dislike.php"  title="je n'aime pas"><img class="img_like" src="../img/dislike.png" alt=""></a>
                            <p><?php echo ' '. $nombre_dislike[0]; ?></p>
                        </div>
                        
                        </br>
                    </div>
                </div>
            </div>     
        </div>
    </div>
</div>
</div>
<?php
}




// affichage si DISLIKE trouvé
$req = $bdd->prepare(' SELECT * FROM aime WHERE id_user = :id and id_message = :id_mess ');
$req->execute(array( 'id' => $id_user , 'id_mess' => $id_message ));
$recherche_dislike = $req->fetch(PDO::FETCH_ASSOC);
$_SESSION['dislike']=$recherche_dislike;
// echo '<pre>';
// var_dump($recherche_dislike);
// echo '</pre>';
if ($recherche_dislike['pas_aime'] == 1 )
{

?>
</br></br></br></br></br></br></br></br></br>
<div class="container d-block ">
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">

            <div class="card-header">
                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                    <div class="media-body ml-3"> <a href="conversation.php?id=</a>
                        <div class="text-muted small">test</div>
                    </div>
                    <div class="text-muted small ml-3">
                        <div>Nombre de conversations : <strong>test</strong></div>
                        <div>Nombre de messages : <strong>test</strong></div>

                        <div class="d-flex h-25">
                            <a href="supprimer_dislike_ajout_like"  title="j'aime"><img class="img_like" src="../img/like.png" alt=""></a>
                            <p><?php echo ' '. $nombre_like[0]; ?> </p>
                            <a href="supprimer_like_&_dislike.php"  title="je n'aime pas"><img class="img_like" src="../img/dislike_checked.png" alt=""></a>
                            <p><?php echo ' '. $nombre_dislike[0]; ?></p>
                        </div>
                        
                        </br>
                    </div>
                </div>
            </div>     
        </div>
    </div>
</div>
</div>
<?php
}



?>




<!-- </br></br></br></br></br></br></br></br></br>
<div class="container d-block ">
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">

            <div class="card-header">
                <div class="media flex-wrap w-100 align-items-center"> <img src="../img/fuck-cat.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                    <div class="media-body ml-3"> <a href="conversation.php?id=</a>
                        <div class="text-muted small">test</div>
                    </div>
                    <div class="text-muted small ml-3">
                        <div>Nombre de conversations : <strong>test</strong></div>
                        <div>Nombre de messages : <strong>test</strong></div>
                        <div>
                            <a href=""><img class="img_like" src="../img/like.png" alt=""></a>
                            <a href=""><img class="img_like" src="../img/dislike.png" alt=""></a>
                        </div>
                        </br>
                    </div>
                </div>
            </div>     
        </div>
    </div>
</div>
</div> -->

<?php 
require ('../include/pages/footer.php'); 
?>
