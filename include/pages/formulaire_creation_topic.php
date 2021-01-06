
<div id='form1' class="container d-flex align-items-center mt-5 border pt-5 pb-5">
    <div  class="row  h-75 d-flex align-items-center  mx-auto w-75">
      <div class=" col-12   d-flex flex-column justify-content-center ">


  
      

        <form name="connexion"  action="profil.php"  method="post">
        <h1 class="text-uppercase text-center mb-3">créer un nouveau topic</h1>

                <p class="text-center text-primary"><?php if(isset($login_modifie)){echo $login_modifie;}?></p>
                <p class="text-center text-primary"><?php if(isset($mot_passe_change)){echo $mot_passe_change;}?></p>
                <p class="text-center text-danger"><?php if(isset($champs_vides)){echo $champs_vides;}?></p>
                <p class="text-center text-danger"><?php if(isset($login_deja_pris)){echo $login_deja_pris;}?></p>
                <p class="text-center text-danger"><?php if(isset($mdp_pas_identiques)){echo $mdp_pas_identiques;}?></p>
                <p class="text-center text-danger"><?php if(isset($erreur_format_mdp)){echo $erreur_format_mdp;}?></p>
                <p class="text-center text-danger"><?php if(isset($tous_champs_vides)){echo $tous_champs_vides;}?></p>
                


                <fieldset>
          <div class="control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>Sujet</label>
              <input type="text" class="form-control" placeholder="Sujet" name="Sujet"  data-validation-required-message="Veuillez saisir le sujet.">
              <p class="help-block text-danger"></p>
            </div>
          </div>

          <div class="control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>Description</label>
              <input type="text" class="form-control" placeholder="Description" name="Description"  data-validation-required-message="Veuillez saisir votre mot de passe.">
              <p class="help-block text-danger"></p>
            </div>
          </div>


          <p class='text-uppercase mt-5  mb-2'>visibilté :</p>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
                Publique
            </label>
            </div>

            <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
            <label class="form-check-label" for="exampleRadios2">
                Utilisateurs connectés
            </label>
            </div>

            <div class="form-check disabled">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" >
            <label class="form-check-label" for="exampleRadios3">
                Modérateurs
            </label>
            </div>

            <div class="form-check disabled">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="option4" checked>
            <label class="form-check-label" for="exampleRadios4">
                Admin
            </label>
            </div>

          <br>
          <p class="text-center text-danger"><?php if(isset($saisir_password)){echo $saisir_password;}?></p>
          <p class="text-center text-danger"><?php if(isset($erreur_password)){echo $erreur_password;}?></p>
      
          <div id="success"></div>
          <button type="submit" name="submit" class="btn btn-primary" id="sendMessageButton">ENVOYER</button>
        </form>
      </div>
    </div>
  </div>