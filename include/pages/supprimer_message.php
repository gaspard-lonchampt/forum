<?php 
    // if ( $_SESSION['id_droit'] != 3)
    //     {
    //         header('Location:../index.php');
    //     }
?>

<header class="masthead" style="background-image: url('img/index.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Dev4Code</h1></br></br>
            <span class="subheading">Le forum des Devs qui Codent</span>
          </div>
        </div>
      </div>
    </div>
  </header>












  <div class="container mt-5 mb-5">
    <div class="row w-75 pt-5 pb-5 border m-auto">
      <div class="col-lg-8 col-md-10 mx-auto">
        <h1 class="text-center text-danger">Voulez-vous confirmer la suppression de ce message ?</h1>
        <p class="text-center text-warning">Cette action sera irreversible</p>
        <div class="text-center"><a class="btn btn-danger" href="supprimer_message_validation.php?id=<?php echo $_GET['id'];?>" role="button">SUPPRIMER</a></div>
      </div>
    </div>
  </div>