<?php
/* Copyright (C) 2015 Valentin D'Emmanuele */
require_once 'lib/OctoEngine.php';
require_once 'model/core.php';

class LoginHandler implements Configuration
	{
	public $nickname;
	protected $login;
	protected $admin;
	public $octo;
        protected $salt = Configuration::salt;

	function __construct()
		{
		$this->octo = new OctoEngine();

		if (isset($_POST['key']))
        		{
        		$_SESSION['login'] = $_POST['login'];
			$d = crypt($_POST['key'], $this->salt);
			}
		  else
			{
			$d = $_SESSION['hashkey'];
			unset($_SESSION['hashkey']);
			}
		$this->d = $d;
		$this->login_password();
		if ($this->login == 1)
			{
			$this->nickname = $_SESSION['login'];
			}
		}

	function login_password()
		{
                $this->login = $this->octo->loginme($_SESSION['login'], $this->d);
                if ($this->login == 1)
                        {
                        $_SESSION['hashkey'] = $this->d;
                        }

		}
	function returnperm()
		{
                return $this->octo->returnperm($this->nickname);
		}
	function islogin()
		{
		return $this->login;
		}

	function isadmin()
		{
		return $this->admin;
		}
	}

?>
