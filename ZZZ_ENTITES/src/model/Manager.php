<?php
namespace AnneFleurMarchat\JeanForteroche\Model;
class Manager
{
	//Récupération de la la base de donnnées
	protected function dbConnect()
	{
	    $db = new \PDO('mysql:host=localhost;dbname=novel;charset=utf8', 'root', 'root');
	    return $db;
	}
}