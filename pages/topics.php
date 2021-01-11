<?php 
session_start();



require ('../include/pages/head.php'); 
require ('../include/pages/naviguation.php'); 
require ('../include/pages/topics.php'); 

echo '<pre>';
print_r($_SESSION);
echo '<pre>';

require ('../include/pages/footer.php'); 
?>
