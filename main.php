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

        $dir='/home/tina.liu/module2_files/'."$usrnm"; //set the user's directory 
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
            echo('===========The end of your file list=============');
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
        
    </body>
</html>