
<?php

if(isset($_POST['valider']))
{
    $login = htmlspecialchars($_POST['login']) ;
    $password = htmlspecialchars($_POST['pass']) ; 

    if(!empty($login) && !empty($password))
    {
        $user = new Utilisateur($login, $password, NULL ,NULL, NULL, NULL );
        $user->connexionBdd("forum", "root","root");
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
        <?php include ('head.php'); ?>
        <header class="masthead" style="background-image: url('../img/post-bg.jpg')">
            <div class="overlay"></div>
            <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1> Page de connexion</h1>
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
