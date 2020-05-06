<?php
namespace AnneFleurMarchat\JeanForteroche\Model;
class Manager
{
	//Récupération de la la base de donnnées
	protected function dbConnect()
	{
	    $db = new \PDO('mysql:host=jeanfortkmafm.mysql.db;dbname=jeanfortkmafm;charset=utf8', 'jeanfortkmafm', 'Nouveauroman2020');
	    return $db;
	}
}