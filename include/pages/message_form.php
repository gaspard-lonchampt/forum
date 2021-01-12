<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<form action="messages.php" method="POST" class="p-3">
  <div class="form-row align-items-center">
    <div class="input-group col-8">
        <div class="input-group-prepend">
            <span class="input-group-text">Message</span>
        </div>
        <textarea class="form-control" aria-label="With textarea" name="message"></textarea>
    </div>
    
    <div class="col-4 my-1">
      <button type="submit" class="btn btn-primary" name="valider">Envoyer</button>
    </div>
  </div>
</form>