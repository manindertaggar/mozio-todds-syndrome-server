<?php
namespace Syndrome;
use Syndrome\utils\Database;
use PDOException;

class Records{
	private $deviceId;

	public function __construct($deviceId){
		$this->deviceId = $deviceId;
		$this->verifyDeviceId();
	}

	private function verifyDeviceId(){

	}

	public function getAll(){
		$sql = 'SELECT * FROM records where `deviceId` = :deviceId';
		$data= array();
		$data['deviceId'] = $this->deviceId;

		try{
			$result = Database::query($sql, $data);
			$records= array();
			while(($data = $result->fetch())!=null){
				$records[] = json_decode($data['data'], true); 

			}

			return $records;
		}catch(PDOException $e){
			echo $e;
			die ('{"isError":true,"message":"Internal Database exception"}');
		}
	}


	public function add($data){
		$sql = 'INSERT INTO records (`deviceId`, `data`) VALUES(:deviceId,:data)';
		$params= array();
		$params['deviceId'] = $this->deviceId;
		$params['data'] = $data;

		try{
			$result = Database::query($sql, $params);
		}catch(PDOException $e){
			echo $e;
			die ('{"isError":true,"message":"Internal Database exception"}');
		}
	}
}