<?php
echo('running!');
if (isset($_POST['usrnm'])) //check if username filled
{
    session_start(); //start a session for this user

    $_SESSION['usrnm']=$_GET['usrnm'];
    $usrnm=$_Get['usrnm'];

    //validate username
    $ul=fopen('/home/tina.liu/module2_files/user_list.txt','r');//open user list
    
    while(!feof($ul))
    {
        if($usrnm==fgets($ul))
        {
            header('LOCATION:main.php');//redirect to main page if username validated
            exit;
        }
    }
    echo('Sorry, invalid username. ');//return error if username not found
    fclose($ul);
}
else
{
    echo('Please enter a username.'); //request a username if left blank
}
?>