<?php 
session_start();
if (!isset($_SESSION['user']['id']))
{$_SESSION['visiteur'] =0 ;}
require ('../include/pages/head.php'); 
require ('../include/pages/naviguation.php'); 
require ('../include/pages/topics.php'); 

require ('../include/pages/footer.php'); 
?>
