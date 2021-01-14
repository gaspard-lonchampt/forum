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
                if($age > 1 && $age < 120)
                {
                    $user = new Utilisateur($login,$password,$nom,$prenom,$age,1);
                    $user->connexionBdd("forum", "root","root");
                    $user->inscription();    
                    
                    $error_login = $user->inscription();    
                }
                else{
                    $error = '<p class="error"> Veuillez indiquez votre véritable âge ! </p> ' ; 
                }

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

    
        <header class="masthead" style="background-image: url('../img/post-bg.jpg')">
            <div class="overlay"></div>
            <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1> Inscrivez-vous via ce formulaire </h1>
                    <h2 class="subheading">Pour être au courant des stocks restants.</h2>
                    <span class="meta">Posted by
                    <a href="#">Start Bootstrap</a>
                    on August 24, 2019</span>
                </div>
                </div>
            </div>
            </div>
        </header>

        <main>
            <section id="formulaire" class="container">
                <div class="row form_inscription">
                    <div class="col-12 col-lg-6">

                        <form action="inscription.php" method="POST" >
                            <div class="form-group">
                                <label for="user_name">Login :</label>
                                <input type="text" class="form-control" id="user_name" name="login" >
                                <?php if(isset($error_login)){ echo $error_login ;} ?>
                            </div>

                            <div class="form-group">
                                <label for="name">Nom : </label> 
                                <input type="text" class="form-control" id="name" name="nom" >
                            </div>

                            <div class="form-group">
                                <label for="prenom">Prenom : </label>
                                <input type="text" class="form-control" id="prenom" name="prenom" >
                            </div>

                            <div class="form-group">
                                <label for="age">Age : </label>
                                <input class="form-control" type="number" id="age" name="age">
                            </div>

                            <div class="form-group">
                                <label for="mdp"> Mot de passe : </label>
                                <input type="password" class="form-control" id="mdp" name="pass" >
                            </div>


                            <div class="form-group">
                                <label for="confirm_mdp">Confirmation de mot de passe : </label>
                                <input type="password" class="form-control" id="confirm_mdp" name="confirm_pass" >
                            </div>
                            <?php if(isset($error)){ echo $error ;} ?>
                            <div>
                                <input class="btn btn-outline-primary" type="submit" value="Envoyer" name="valider">
                            </div>    

                        </form>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="img_inscription">
                            <img src="../img/inscription.jpg">
                        </div>
                    </div>

                </div>

            </section>
        </main>
    </body>
</html>