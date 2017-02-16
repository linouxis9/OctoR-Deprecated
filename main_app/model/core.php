<?php
/* Copyright (C) 2015 Valentin D'Emmanuele */

require_once 'model/config.php';


class Core implements Configuration
	{
        protected $servername = Configuration::servername;
        protected $username = Configuration::username;
        protected $password = Configuration::password;
        protected $db = Configuration::db;
        protected $salt = Configuration::salt;

	public $conn;
	function __construct()
		{
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

		if ($this->conn->connect_error)
			{
			die("Connection failed: " . $conn->connect_error);
			}

		$result = $this->conn->query("SELECT 1 FROM OctoR LIMIT 1;");
		if ($result == FALSE)
			{
			$this->create_table();
			}
		$this->users_informations();
		}
	protected function create_table()
		{
			$sql = "CREATE TABLE OctoR (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			nickname VARCHAR(30) NOT NULL,
			password VARCHAR(200) NOT NULL,
			user_group VARCHAR(20) NOT NULL,
			token VARCHAR(200),
			reg_date TIMESTAMP
			)";
		$this->conn->query($sql);
		}
}
