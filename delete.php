
<?php
    session_start();
    $file=$_POST['file'];
    $dir=sprintf("%s/%s",$_SESSION['dir'], $file); 
    unlink($dir); 
    header('LOCATION: main.php?feedback=deletesuccess');
?>