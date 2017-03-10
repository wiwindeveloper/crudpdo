<?php  
	$db_host 		= "localhost";
	$db_user 		= "root";
	$db_password	= "";
	$db_name		= "crudpdo";

	try
	{
		$connect = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
?>