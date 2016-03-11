<?php	
	class Partner {
		private $id;
		private $name;
		private $logo;
		private $country;
		private $register_date;
		
		public function __construct(array $args = array()) {
			if (!empty($args)) {
				foreach($args as $p => $v) {
					$this->$p = $v;
				}
			}
		}

		public function __get($nom){
			return $this->$nom;
		}

		public function __set($n, $v){
			$this->$n = $v;
		}

		public static function getPartnerById($id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM partner WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
			$sth->execute(array(
				':id' => $id
			));
			
			return $sth->fetch();
		}

		public static function getPartnerIDByName($name) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT id FROM partner WHERE name LIKE :name';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute(array(
				':name' => $name
			));
			
			return $sth->fetch();
		}

		public static function getPartnersList() {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM partner';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function deletePartner($id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'DELETE FROM partner WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
			$sth->execute(array(
				':id' => $id
			));

			$folder = "../../uploads/partners";
          		$file = $folder . '/' . $id . '.jpg';
          		$file2 = $folder . '/' . $id . '.png';
          		if(file_exists($file)) unlink($file);
          		if(file_exists($file2)) unlink($file2);
		}

	}
?>
