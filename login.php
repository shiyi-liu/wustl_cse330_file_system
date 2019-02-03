<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="UTF-8">
        <title>cse330 Module 2 site</title>
    </head>
    <body>
        <!--this file create the login page users will see initially-->
        <h3>File Sharing Site</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            Username: <input type="text" name="usrnm"><br/>
            <input type="submit" name='btn' class="btn" value="Log in">
        </form>
        
    </body>
    <?php
        if(isset($_GET['btn'])){ //if the button pressed check if filled
            if (!empty($_GET['usrnm'])) //check if username filled
            {
                session_start(); //start a session for this user

                $_SESSION['usrnm']=$_GET['usrnm'];
                $usrnm=$_GET['usrnm'];

                //validate username
                $ul=fopen('/home/crazyphysicist/module2_files/user_list.txt','r');//open user list
                
                while(!feof($ul))
                {
                    if($usrnm==trim(fgets($ul)))
                    {
                        echo("$usrnm");
                        header('LOCATION:main.php?feedback=""');//redirect to main page if username validated
                        exit;
                    }
                }
                echo('Sorry, invalid username. ');//return error if username not found
                fclose($ul);
            }
            else{
                echo('Please enter a username.'); //request a username if left blank
            }
        }
    
?>
</html>