<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="UTF-8">
        <title>CSE330 Module 2 site main page</title>
    </head>
    <body>
        <h2>Welcome 
        
        <?php //initialize
        session_start();
        $usrnm=$_SESSION['usrnm'];
        echo $usrnm;
        ?>!

        </h2>

        <h3>Your files: </h3>
        <form name='files' action='main.php' method='POST'>
        </form>
    <?php
        $dir='/home/crazyphysicist/module2_files/'."$usrnm"; //set the user's directory 
        $_SESSION['dir']=$dir; //store user dir path for future use

        //display user's filelist
        if(is_dir($dir))
        {
            $fl=scandir($dir);
            foreach($fl as $value){
                if($value !="." && $value!=".."){
                    echo($value."<br/>");
                }
            }
            echo('===========End of file list=============');
            $_SESSION['fl']=$fl; //store it as session var for future use
        }
        else{
            echo("Your directory does not exist.");
        }

    ?>
    
    <!--View file-->
    <form name='view' action='view.php' method='POST'>
        <p>Please select the file you want to view: </p>
        <select name="file">
        <?php
            session_start();
            $list=$_SESSION['fl'];
            foreach($list as $value)
            {
                if($value!='.' && $value!='..'){
                    echo "\t<option value=$value> $value </option> <br/>\n";
                }
            }
        ?>
        </select>
        <input type="submit" name='viewSub' value='View File'/>
    </form> 
    
    <!--Delete file-->
    <form name='delete' action='delete.php' method='POST'>
        <p>Please select the file you want to delete: </p>
        <select name="file">
        <?php
            session_start();
            $list=$_SESSION['fl'];
            foreach($list as $value)
            {
                if($value!='.' && $value!='..'){
                    echo "\t<option value=$value name='file'> $value </option> <br/>\n";
                }
            }
        ?>
        </select>
        <input type='submit' name='deleteSub' value='Delete File'/>
    </form>    

    <!--Upload file from course wikipage-->
    <form enctype="multipart/form-data" action="uploader.php" method="POST">
	<p>
		<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
		<label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" />
	</p>
	<p>
		<input type="submit" value="Upload File" />
	</p>
    </form> 

    <?php
    $feedback = $_GET["feedback"];
    switch($feedback){
    case "uploadsuccess":
        echo "Upload Success!";
        break;
    case "uploadfail":
        echo "Upload Failed!";
        break;
    case "deletesuccess":
        echo "Delete Success!";
        break;
    case "invalidf":
        echo "Invalid Filename!";
        break;
    case "invalidu":
        echo "Invalid Username!";
        break;
    case "toobig":
        echo "File Too Big!";
        break;
    default:
        break;
    }
    
    ?>

    <p></p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <input type="submit" name='btn' class="btn" value="Log out">
    </form>

    <p></p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <input type="submit" name='btn2' class="btn2" value="Delete account">
    </form>

    <?php

    if(isset($_GET['btn'])){
        session_destroy();
        header('LOCATION: login.php?loggedout');
    }

    if(isset($_GET['btn2'])){
        session_destroy();
        
        header('LOCATION: login.php?loggedout');
    }
    ?>
    </body>
</html>