<?php
session_start();

// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
    echo "Invalid filename";
    header("Location: main.php?feedback=uploadfail");
	exit;
}

// Get the username and make sure it is valid
$username = $_SESSION['usrnm'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
    echo "Invalid username";
    header("Location: main.php?feedback=uploadfail");
	exit;
}

$dir = $_SESSION['dir'];
$full_path = sprintf("$dir/%s", $filename);

if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
	header("Location: main.php?feedback=uploadsuccess");
	exit;
}else{
	header("Location: main.php?feedback=uploadfail");
	exit;
}

?>