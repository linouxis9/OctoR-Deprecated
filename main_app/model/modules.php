<?php
/* Copyright (C) 2015 Valentin D'Emmanuele */

require_once 'model/config.php';

class ModulesHandler
        {
	public $modules;
        function __construct()
                {
		$this->dir = __DIR__."/../modules";
		$modules = array_diff(scandir($this->dir), Array(".", ".."));
		$this->modules["OctoR"]["version"] = "0.1";
		foreach($modules as $foldername)
			{
			$this->ModulesInformation($foldername);
			}
		$modules = $this->modules;
		unset($modules["OctoR"]);
                foreach($modules as $module => $array)
                        {
                        $this->Dependencies($module);
                        }
		}
	function Dependencies($module)
		{
		$this->modules[$module]["status"] = "0";
		foreach($this->modules[$module]["Dependencies"] as $dep => $version)
			{
			if ($this->modules[$dep]["version"] >= $version)
				{
				if ($this->modules[$module]["status"] == "0")
					{
					$this->modules[$module]["status"] = "0";
					}
				}
			else
				{
				$this->modules[$module]["status"] = "1";
				}
			}
		}
	function ModulesInformation($FolderName)
		{
		if (file_exists($this->dir."/".$FolderName."/"."infos.json"))
			{
			$infos = json_decode(file_get_contents($this->dir."/".$FolderName."/"."infos.json", true), true);
			$this->modules[$infos["name"]] = $infos;
			$this->modules[$infos["name"]]["folder"] =$this->dir."/".$FolderName;
			}
		}
	function ExecTasks($module)
		{
                $this->NumArgs = func_num_args();
                for ($i = 1; $i < $this->NumArgs; $i++)
                	{
                        $this->Args[] = func_get_arg($i);
                        }
		if (($this->modules[$module]['name'] = $module) && in_array($this->Args[0], $this->modules[$module]['tasks']))
			{
			require $this->modules[$module]["folder"]."/".$this->modules[$module]["main_file"];
			}
		}
	}
?>
