<?php
    session_start();
    
    $file=$_POST['file'];
    $dir=sprintf("%s/%s",$_SESSION['dir'], $file);  
    //echo($dir); 

    unlink($dir); 

    header('LOCATION:main.php'); 


?>