<?php
    session_start(); 

    require ('../fonctions/fonctions.php') ;

    $connexion = new PDO('mysql:host=localhost;dbname=forum', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

    $requete = $connexion->prepare("SELECT login,nom,prenom,age,id FROM utilisateurs");
    $requete->execute(); 

    $result = $requete->fetchAll(); 

?>

<table>
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
                    <input type="submit" name="valider" value="Modifier">
                </form>
            </td>
            <?php

            

        }

    ?>


</table>

<style>
    table{
        border-collapse : collapse ; 
    }
    td,th{
        border: 2px solid black ; 
        padding: 10px;
    }
</style>