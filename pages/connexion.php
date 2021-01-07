<?php

session_start();
require("../classes/class_utilisateur.php"); 

?>

<DOCTYPE! html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Inscription </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    </head>
    
<?php

if(isset($_POST['valider']))
{
    $login = htmlspecialchars($_POST['login']) ;
    $password = htmlspecialchars($_POST['pass']) ; 

    if(!empty($login) && !empty($password))
    {
        $user = new Utilisateur($login, $password, NULL ,NULL, NULL, NULL );
        $user->connexionBdd("forum", "root","");
        $result = $user->connect();
        if($result)
        {
            var_dump($result); 

            $_SESSION['user'] = $result; 

            header("Location: profil.php");
        }
        else{
            $error = '<p class="error"> Login ou mot de passe incorrect </p>' ;
        }
    }
    else{
        $error = '<p class="error"> Veuillez remplir tous les champs </p>'; 
    }
}


?>

    <body>
        
        <main>
            <section id="formulaire">
            <div class="row">
                    <div class="col-12">

                        <form action="connexion.php" method="POST">
                            <div class="form-group">
                                <label for="user_name">Login</label>
                                <input type="text" class="form-control" id="user_name" name="login">
                            </div>

                            <div class="form-group">
                                <label for="mdp"> Mot de passe </label>
                                <input type="password" class="form-control" id="mdp" name="pass" >
                            </div>
                            <?php if(isset($error)) { echo $error ; } ?>
                            <div>
                                <input class="btn btn-outline-primary" type="submit" value="Envoyer" name="valider">
                            </div>    

                        </form>

                    </div>
                </div>

            </section>    
        </main>

    </body>
</html>


