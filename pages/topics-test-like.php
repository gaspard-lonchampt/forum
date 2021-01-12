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


$id_user = 2;
$id_message = 5;

// $req = $bdd->query('SELECT * FROM aime');
// echo '<pre>';
// var_dump($req);
// echo '</pre>';



$req2 = $bdd->query(' SELECT COUNT(*) FROM aime WHERE id_message = 2 and aime = 1');// recherche nombre like
$nombre_like = $req2->fetch();


$req2 = $bdd->query(' SELECT COUNT(*) FROM aime WHERE id_message = 2 and pas_aime = 1');// recherche nombre dislike
$nombre_dislike = $req2->fetch();







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
                            <a href=""  title="j'aime"><img class="img_like" src="../img/like.png" alt=""></a>
                            <p><?php echo ' '. $nombre_like[0]; ?> </p>
                            <a href=""  title="je n'aime pas"><img class="img_like" src="../img/dislike.png" alt=""></a>
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





$req = $bdd->prepare(' SELECT aime FROM aime WHERE id_user = :id and id_message = :id_mess ');
$req->execute(array( 'id' => $id_user , 'id_mess' => $id_message ));
$recherche_like = $req->fetch(PDO::FETCH_ASSOC);
echo '<pre>';
var_dump($recherche_like);
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
                            <a href=""  title="j'aime"><img class="img_like" src="../img/like_checked.png" alt=""></a>
                            <p><?php echo ' '. $nombre_like[0]; ?> </p>
                            <a href=""  title="je n'aime pas"><img class="img_like" src="../img/dislike.png" alt=""></a>
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

$req = $bdd->prepare(' SELECT pas_aime FROM aime WHERE id_user = :id and id_message = :id_mess ');
$req->execute(array( 'id' => $id_user , 'id_mess' => $id_message ));
$recherche_dislike = $req->fetch(PDO::FETCH_ASSOC);
echo '<pre>';
var_dump($recherche_dislike);
echo '</pre>';
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
                            <a href=""  title="j'aime"><img class="img_like" src="../img/like.png" alt=""></a>
                            <p><?php echo ' '. $nombre_like[0]; ?> </p>
                            <a href=""  title="je n'aime pas"><img class="img_like" src="../img/dislike_checked.png" alt=""></a>
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
