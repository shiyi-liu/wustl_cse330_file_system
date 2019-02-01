<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="UTF-8">
        <title>cse330 Module 2 site main page</title>
    </head>
    <body>
        <h3>Welcome to file sharing site!</h3>
        <p>The file list is: </p>
        <form name='files' action='main.php' method='POST'>
        </form>
    <?php
        //initialize
        session_start();
        $usrnm=$_SESSION['usrnm'];

        $dir='/home/tina.liu/module2_files/tina';//'.$usrnm; //set the user's directory 
        echo("$dir");

        $fl=array();//creat an array to store file names for future use

        //display user's filelist
        if(is_dir($dir))
        {
            $dh=opendir($dir);
            if($dh)
            {
                $file = readdir($dh);
                $ind = 1; 
                while($file !== FALSE)
                {
                    //if($file != '.' && $file != '..')
                    //{
                        echo($ind.$file.'<br>\n');
                        array_push($fl, $file); //insert current file name into the array
                        $ind+=1; 
                    //}
                }
            }
            echo('===========The end of your file list=============');
            $_SESSION['fl']=$fl; 
        }
        else{
            echo("Your directory does not exist.");
        }

    ?>
    
    <!--View file-->
    <form name='view' action='view' method='POST'>
        <p>Please select the file you want to view: </p>
        <select name="view">
        <?php
            session_start();
            $list=$_SESSION['fl'];
            foreach($list as $value)
            {
                echo('<option value='.$value.'>$value</option>');
            }
        ?>
        </select>
        
        
    </body>
</html>