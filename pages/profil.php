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
            $password = password_hash($_POST['pass'], PASSWORD_DEFAULT) ; 
            $confirm_pass = htmlspecialchars($_POST['confirm_pass']) ;
            $nom = htmlspecialchars($_POST['nom']) ;
            $prenom = htmlspecialchars($_POST['prenom']) ;
            $age = htmlspecialchars($_POST['age']) ;
            $id = htmlspecialchars($_SESSION['user']['id']) ; // Pour modif la bonne ligne dans la bdd 
            $id_droit = htmlspecialchars($_SESSION['user']['id_droit']) ; // Pour la modif du profil on garde toujours le même id_droit qu'avant. L'admin le fera ailleurs sur une autre page 
        
            if(!empty($login) && !empty($nom) && !empty($prenom) && !empty($age) && !empty($password) && !empty($confirm_pass))
            {
                if(($_POST['pass'] == $_POST['confirm_pass']) && (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#',$_POST['pass'])))
                {
                    $user = new Utilisateur($login,$password,$nom,$prenom,$age,$id_droit);
                    $user->connexionBdd("forum", "root","");
                    $msg = $user->update($id);    

                    $infos_utilisateur = $user->getAllinfos(); 
                    $_SESSION['user'] = $infos_utilisateur ; 
        
                }
                elseif($_POST['pass'] != $_POST['confirm_pass'])
                {
                    $msg = '<p class="error"> Mot de passe différents </p>'; 
                }
                else{
                    $msg = '<p class="error">Mot de passe non valide : Il doit faire au minimum 8 caractères et doit contenir 1 majuscule, 1 chiffre et 1 caractère spécial </p>' ; 
                }
            }
            else{
                $msg = '<p class="error"> Veuillez remplir tous les champs </p>'; 
            }
        }
        
        ?>

    <body>
        
        <main>
            <section id="formulaire">
                <article class="contenu_formulaire">
                    <form action="profil.php" method="POST">

                        <div class="form-group">
                            <label for="user_name"> Nouveau login</label>
                            <input type="text" class="form-control" id="user_name" name="login" value="<?php echo $_SESSION['user']['login'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="name">Nouveau nom</label>
                            <input type="text" class="form-control" id="name" name="nom" value="<?php echo $_SESSION['user']['nom'] ?>" >
                        </div>

                        <div class="form-group">
                            <label for="prenom">Nouveau prenom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $_SESSION['user']['prenom'] ?>" >
                        </div>

                        <div class="form-group">
                            <label for="age">Nouvel age</label>
                            <input class="form-control" type="number" id="age" name="age" value="<?php echo $_SESSION['user']['age'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="mdp"> Nouveau mot de passe </label>
                            <input type="password" class="form-control" id="mdp" name="pass" >
                        </div>


                        <div class="form-group">
                            <label for="confirm_mdp">Confirmation du nouveau mot de passe </label>
                            <input type="password" class="form-control" id="confirm_mdp" name="confirm_pass" >
                        </div>
                        <?php if(isset($msg)) { echo $msg ;} ?>
                        <div>
                            <input class="btn btn-outline-primary" type="submit" value="Modifier mon profil" name="valider">
                        </div>

                    </form>
                </article>

            </section>
        </main>

    </body>
</html>
