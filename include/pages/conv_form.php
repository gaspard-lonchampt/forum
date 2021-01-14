<form action="conversation.php?id=<?php echo $_GET['id'];?>" method="POST" >
  <div class="container border p-4">
  <h1 class="text-center">Créer une nouvelle conversation</h1>
  <div class="form-group container d-flex flex-column justify-content-center p-4">
    <label for="Votre sujet">Sujet</label>
    <input type="text" class="form-control" id="conversation_sujet" name="conversation_sujet">
  </div>
  <button type="submit" class="btn btn-primary ml-4 " name="conversation_submit">Créer</button>
  </div>
</form>