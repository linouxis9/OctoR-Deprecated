<?php
session_start();
require_once 'model/handle.php';
$LoginHandler = new LoginHandler();

if (isset($_GET['disconnect']))
	{
	session_destroy();
	$_SESSION = array();
	header("Location: index.php");
	}

if ($LoginHandler->islogin() == 1)
   {
        $files = scandir(__DIR__.'/groups');
        $files = array_diff($files, array(
            '.',
            '..'
        ));
        $groups = array();
        foreach($files as $group) # Search all groups with a special php file in the groups folder
            {
            $groups[] = pathinfo($group, PATHINFO_FILENAME);
            }
	    require __DIR__.'/../view/panel.php';
        if (in_array($LoginHandler->returnperm($LoginHandler->nickname) , $groups)) # Check if the group of the user has a special php file
            {
            require __DIR__.'/groups/' . $LoginHandler->returnperm($LoginHandler->nickname) . '.php'; # Add the content of the php file if the file of the group exist
            }
          else
            {
            require __DIR__.'/controller/groups/unknown.php'; # Add the content of the php file unknown.php if the file of the group doesn't exist
            }
    }
  else
    {
    header("Location: login.php");
    }
