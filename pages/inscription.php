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
            $nom = htmlspecialchars($_POST['nom']) ;
            $prenom = htmlspecialchars($_POST['prenom']) ;
            $age = htmlspecialchars($_POST['age']) ;
            $password = password_hash($_POST['pass'], PASSWORD_DEFAULT) ; 
            $confirm_pass = htmlspecialchars($_POST['confirm_pass']) ;
        
            if(!empty($login) && !empty($nom) && !empty($prenom) && !empty($age) && !empty($password) && !empty($confirm_pass))
            {
                if(($_POST['pass'] == $_POST['confirm_pass']) && (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#',$_POST['pass'])))
                {
                    $user = new Utilisateur($login,$password,$nom,$prenom,$age,0);
                    $user->connexionBdd("forum", "root","");
                    $user->inscription();    
                    
                    $error_login = $user->inscription();    
        
                }
                elseif($_POST['pass'] != $_POST['confirm_pass'])
                {
                    $error = '<p class="error"> Mot de passe différents </p>'; 
                }
                else{
                    $error = '<p class="error">Mot de passe non valide : Il doit faire au minimum 8 caractères et doit contenir 1 majuscule, 1 chiffre et 1 caractère spécial </p>' ; 
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

                        <form action="inscription.php" method="POST">
                            <div class="form-group">
                                <label for="user_name">Login</label>
                                <input type="text" class="form-control" id="user_name" name="login" >
                                <?php if(isset($error_login)){ echo $error_login ;} ?>
                            </div>

                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input type="text" class="form-control" id="name" name="nom" >
                            </div>

                            <div class="form-group">
                                <label for="prenom">Prenom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" >
                            </div>

                            <div class="form-group">
                                <label for="age">Age</label>
                                <input class="form-control" type="number" id="age" name="age">
                            </div>

                            <div class="form-group">
                                <label for="mdp"> Mot de passe </label>
                                <input type="password" class="form-control" id="mdp" name="pass" >
                            </div>


                            <div class="form-group">
                                <label for="confirm_mdp">Confirmation de mot de passe </label>
                                <input type="password" class="form-control" id="confirm_mdp" name="confirm_pass" >
                            </div>
                            <?php if(isset($error)){ echo $error ;} ?>
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
