<?php
session_start();
require_once 'model/handle.php';
require_once "model/modules.php";

$LoginHandler = new LoginHandler();


$md = new ModulesHandler();
$md->ExecTasks("OctoR_Core", "Core_Login");

