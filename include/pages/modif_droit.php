<?php

    $connexion = new PDO('mysql:host=localhost;dbname=forum', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

    $requete = $connexion->prepare("SELECT login,nom,prenom,age,id FROM utilisateurs");
    $requete->execute(); 

    $result = $requete->fetchAll(); 

?>

<header class="masthead" style="background-image: url('../img/post-bg.jpg')">
    <div class="overlay"></div>
        <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading">
                <h1> Modification des droits </h1>
                <h2 class="subheading">Pour être au courant des stocks restants.</h2>
                <span class="meta">Posted by
                <a href="#">Start Bootstrap</a>
                on August 24, 2019</span>
            </div>
            </div>
        </div>
    </div>
</header>

<table class="modif_droit">
    <tr>
        <th> Login </th>
        <th> Nom </th>
        <th> Prénom </th>
        <th> Age </th>
        <th> Id </th>
        <th> Modifier id_droit </th>
    </tr>    

    <?php
        for($i = 0 ; isset($result[$i]); $i++)
        {
            echo '<tr></tr>' ; 
            
            for($j = 0 ; isset($result[$i][$j]) ; $j++)
            {
                echo '<td>'.$result[$i][$j].'</td>' ; 
            }
            
            $_GET['id'] = $result[$i]['id'] ;
            ?>
            
            <td>
                <form action="update_profil.php?id=<?php echo $_GET['id'] ; ?>" method="POST">
                    <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1" name="droit">
                            <option>Normal</option>
                            <option>Modérateur</option>
                            <option>Administrateur</option>
                        </select>
                    </div>
                    <input type="submit" name="valider" value="Modifier" class="btn btn-outline-info">
                </form>
            </td>
            <?php

        }
        
        ?>



</table>

<?php
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'] ; 
    }

    $_SESSION['message'] = NULL ; 
?>
