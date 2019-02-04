<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="UTF-8">
        <title>CSE330 Module 2 site</title>
        <link rel="stylesheet" type="text/css" href="filesite2.css">
    </head>
    <body>
        <!--this file create the login page users will see initially-->
        <h2>Super Secure File Share Service</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            Username: <input type="text" name="usrnm"><br/>
            <input type="submit" name='btn' class="btn" value="Log in">
            <input type="submit" name='btn2' class="btn2" value="Create account">
        </form>
        <br>
    <!--For logging in:-->
    <?php
        $_SESSION['admin']=false; //why do I need multiple of these?
        if(isset($_GET['btn'])){ //if the button pressed check if filled
            if (!empty($_GET['usrnm'])) //check if username filled
            {
                session_start(); //start a session for this user

                $_SESSION['usrnm']=htmlentities($_GET['usrnm']);
                $usrnm=htmlentities($_GET['usrnm']);

                //validate username
                $ul=fopen('/home/crazyphysicist/module2_files/user_list.txt','r');//open user list
                $vl=fopen('/home/crazyphysicist/module2_files/admin_list.txt','r');
                while(!feof($vl))
                {
                    if($usrnm==trim(fgets($vl)))
                    {
                        $_SESSION['admin']=true;
                        header('LOCATION:main.php?feedback=""');//redirect to main page if username validated
                        exit;
                    }
                }
                while(!feof($ul))
                {
                    if($usrnm==trim(fgets($ul)))
                    {
                        $_SESSION['admin']=false;
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

    <!--For creating an account:-->
    <?php
        $_SESSION['admin']=false;
        if(isset($_GET['btn2'])){ //if the button pressed check if filled
            if (!empty($_GET['usrnm'])) //check if username filled
            {
                session_start(); //start a session for this user

                $_SESSION['usrnm']=htmlentities($_GET['usrnm']);
                $usrnm=htmlentities($_GET['usrnm']);

                //validate username
                $ul=fopen('/home/crazyphysicist/module2_files/user_list.txt','a');//open user list
                fwrite($ul,"\n".$usrnm);
                mkdir("/home/crazyphysicist/module2_files/".$usrnm);
                fclose($ul);
                $_SESSION['admin']=false;
                header('LOCATION:main.php?feedback=""');//redirect to main page
            }
            else{
                echo('Please enter a username.'); //request a username if left blank
            }
        }
    
    ?>
    </body>
</html>