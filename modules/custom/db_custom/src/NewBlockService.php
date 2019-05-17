<?php 
namespace Drupal\db_custom;
use Drupal\Core\Database\Connection;

class NewBlockService {
	private $database;
	public function __construct(Connection $connection){
		$this->database = $connection;
	}
	
	public function dbread() {
	
	}
	
}
?>