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
$id_message = 2;

// $req = $bdd->query('SELECT * FROM aime');
// echo '<pre>';
// var_dump($req);
// echo '</pre>';

$req = $bdd->prepare(' SELECT * FROM aime WHERE id = :id ');//on va chercher dans la bdd si le login existe déjà
$req->execute(array( 'id' => $id_user   ));
$donnees = $req->fetch();




echo '<pre>';
var_dump($donnees);
echo '</pre>';


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
                        </br>
                    </div>
                </div>
            </div>     
        </div>
    </div>
</div>
</div>

<?php 
require ('../include/pages/footer.php'); 
?>
