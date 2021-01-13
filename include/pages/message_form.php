<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container">
<form action="message.php?id=<?php echo $_GET['id'] ; ?>" method="POST" class="p-3" id="reponse">

  <div class="form-row align-items-center">
    <div class="input-group col-8">
        <div class="input-group-prepend">
            <span class="input-group-text">Message</span>
        </div>
        <textarea class="form-control" aria-label="With textarea" name="message"></textarea>
    </div>
    
    <div class="col-4 my-1">
      <button type="submit" class="btn btn-primary" name="message_valider">Envoyer</button>
    </div>
  </div>
</form>
</div>