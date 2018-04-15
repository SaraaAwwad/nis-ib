<?php

class Database
{
	//you have only one copy
	private static $dbh;

	//private to prevent making any object from class
	private function __construct(){}

	public static function getInstance()
	{
		// three equals to compare value & type
		if(self::$dbh === null){

			self::$dbh = new PDO('mysql:://hostname=' . DB_HOST . ';dbname=' . DB_NAME , DB_USER , DB_PASS );

		}
		return self::$dbh;
	}

}