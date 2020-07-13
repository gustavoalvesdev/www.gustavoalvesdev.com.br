<?php 

class DefaultConnection 
{
	private static $connection;
	// PRODUCTION 
	/*private static $db_name = 'sistema-rc';
	private static $db_host = 'mysql669.umbler.com';
	private static $db_user = 'gustavo-rc';
	private static $db_pass = '5[QJn{*x6q';*/

	// DEVELOPMENT
	private static $db_name = 'sistema-rc';
	private static $db_host = 'localhost';
	private static $db_user = 'root';
	private static $db_pass = '';

	private function __construct(){}

	public static function getConnection() 
	{
		if (self::$connection === null) {
			try {
				self::$connection = new PDO('mysql:host='.self::$db_host.';dbname='.self::$db_name, self::$db_user, self::$db_pass);
			} catch(PDOException $e) {
				$_SESSION['flash-danger'] = 'Falha ao obter uma conexão com o banco de dados!';
			}
		}
		return self::$connection;
	}

} 
