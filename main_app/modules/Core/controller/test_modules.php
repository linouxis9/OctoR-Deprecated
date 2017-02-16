<?php
session_start();
require_once 'model/handle.php';
require_once "model/modules.php";
$LoginHandler = new LoginHandler();


$md = new ModulesHandler();
echo "<pre>"; // DEBUG
var_dump($md->modules);
echo "</pre>"; // END DEBUG
$md->ExecTasks("OctoR_Core", "Core_Echo_Test", "lol");

