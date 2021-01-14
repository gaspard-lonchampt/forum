<?php
session_start();



require ('../classe/class-like-dislike.php'); 
$like = new Like_dislike(null,null,null,null,null);
$like->ajout_dislike($id_message,$id_user);


                     

                      header('Location: message.php');//redirection
                      exit();


?>