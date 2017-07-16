<?php
require __DIR__.'/../vendor/autoload.php';
use Syndrome\Records;

// $_POST['action'] = 'add';
// $_POST['deviceId'] = 'maninder__taggar';
// $_POST['data'] = '{"a":"jsondata"}';

$_POST['action'] = 'get-all';
$_POST['deviceId'] = 'add';

if(!isset($_POST['action']) || !isset($_POST['deviceId'])){
	echo '{"isError":true,"message":"Invalid Params"}';
	return;
}

$action = $_POST['action'];

switch ($action) {
	case 'add':
	if(!isset($_POST['data'])){
		echo '{"isError":true,"message":"Missing Credentials"}';
		return;
	}
	$records =	new Records($_POST['deviceId']);
	$records->add($_POST['data']);
	break;

	case 'get-all':
	$records =	new Records($_POST['deviceId']);
	$output = array(
		"isError"=>false, 
		"data"=>array(
			"records"=>$records->getAll()
			)
		);

	die(json_encode($output));
	break;

	default:
	echo '{"isError":true,"message":"Unknown action"}';
	break;
}


