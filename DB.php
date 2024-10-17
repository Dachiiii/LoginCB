<?php

class DB {

	private $statement;

	public function __construct() {
		$this->db_host = '';
		$this->db_port = 3306;
		$this->db_name = '';
		$this->db_user = '';
		$this->db_pass = '';
		$this->dsn = "mysql:host={$this->db_host};port={$this->db_port};dbname={$this->db_name}";
		try {
			$this->pdo = new PDO($this->dsn, $this->db_user, $this->db_pass);
		} catch (PDOException $e) {
			throw new PDOException($e->getMessage());
		}
	}

	public function query($sql, $params = []) {
		$this->statement = $this->pdo->prepare($sql);
		return $this->execute($params);
	}

	public function execute($params = []) {
		return $this->statement->execute($params);
	}

	public function fetch() {
		return $this->statement->fetch();
	}
}
?>