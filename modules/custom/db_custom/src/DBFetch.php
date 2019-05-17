<?php

namespace Drupal\db_custom;

use Drupal\Core\Database\Connection;

class DBFetch {
	private $database;
	public function __construct(Connection $connection) {
		$this->database = $connection;
	}
	public function dbread() {
		$get_info = $this->database->select ( 'profiles', 'cs' )->fields ( 'cs', [
				'first_name'
		] )->execute ()->fetchAll ();

		return array_shift ( $get_info );
	}
	public function dbwrite($insert) {
		$fields = array (
				'first_name' => $insert
		);
		$this->database->insert ( 'profiles' )->fields ( $fields )->execute ();
		return 'Success';
	}
}
?>