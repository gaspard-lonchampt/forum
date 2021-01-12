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
$id_message = 4;

// $req = $bdd->query('SELECT * FROM aime');
// echo '<pre>';
// var_dump($req);
// echo '</pre>';

$req = $bdd->prepare(' SELECT * FROM aime WHERE id_user = :id and id_message = :id_mess ');
$req->execute(array( 'id' => $id_user , 'id_mess' => $id_message ));
$donnees = $req->fetch(PDO::FETCH_ASSOC);


if ($donnees == null )
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
                        <div>
                            <a href=""  title="j'aime"><img class="img_like" src="../img/like.png" alt=""></a>
                            <p></p>
                            <a href=""  title="je n'aime pas"><img class="img_like" src="../img/dislike.png" alt=""></a>
                            <p></p>
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

echo '<pre>';
print_r($donnees);
echo '</pre>';


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
