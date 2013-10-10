<?php
session_start();	
//include 'oauth_config.php';

function deleteDirectory($dirPath) {
    if (is_dir($dirPath)) {
        $objects = scandir($dirPath);
        foreach ($objects as $object) {
            if ($object != "." && $object !="..") {
                if (filetype($dirPath . DIRECTORY_SEPARATOR . $object) == "dir") {
                    deleteDirectory($dirPath . DIRECTORY_SEPARATOR . $object);
                } else {
                    unlink($dirPath . DIRECTORY_SEPARATOR . $object);
                }
            }
        }
    reset($objects);
    rmdir($dirPath);
    }
}

if(is_dir("./user_content/".$_SESSION['user_name']))
{
  	
	  	deleteDirectory("./user_content/".$_SESSION['user_name']);
}

if(file_exists("./user_content/".$_SESSION['user_name'].".zip"))
{
	unlink("./user_content/".$_SESSION['user_name'].".zip");
}



session_destroy();

if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}
unset($_SESSION['logged_in']);

if(!isset($_POST['auto']))
	header('Location:index.php');



?>
