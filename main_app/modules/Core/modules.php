<?php
switch ($this->Args[0]) {
    case "Core_Main_Panel":
	require __DIR__.'/controller/panel.php';
        break;
    case "Core_Login":
        require __DIR__.'/controller/login.php';
        break;
    case "Core_Register":
        require __DIR__.'/controller/register.php';
        break;
    case "Core_Echo_Test":
        echo "TEST ".$this->Args[1]." TEST";
        break;
}
