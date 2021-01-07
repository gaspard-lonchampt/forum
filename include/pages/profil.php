
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

        <?php include ('head.php'); ?>
        <header class="masthead" style="background-image: url('../img/post-bg.jpg')">
            <div class="overlay"></div>
            <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1> Modif profil </h1>
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
                <article class="form_inscription row">

                    <div class="col-12 col-lg-6">
                            <div class="img_inscription">
                                <img src="../img/laptop.jpg" alt="laptop">
                            </div>
                    </div>

                    <div class="col-12 col-lg-6">
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
                    </div>

                </article>


            </section>
        </main>

    </body>
</html>
