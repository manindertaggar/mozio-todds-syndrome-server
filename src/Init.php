<?php
require_once __DIR__.'/../vendor/autoload.php';

use Syndrome\utils\Database;


$dbCommands = array();

$dbCommands[] ="CREATE TABLE `mozio`.`records` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`deviceId` VARCHAR(255) NOT NULL , 
`data` TEXT NOT NULL , 
`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
PRIMARY KEY (`id`))";

foreach ($dbCommands as $index => $command) {
	echo "\nexecuting $index\n$command\n";
	try{
		Database::query($command);
	}catch(PDOException $e){
		echo "\nerror: $e";
	}

}