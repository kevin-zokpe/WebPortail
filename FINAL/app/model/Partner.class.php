<?php	
	class Partner {
		private $id;
		private $name;
		private $logo;
		private $country;
		private $type;
		private $register_date;
		
		public function __construct(array $args = array()) {
			if (!empty($args)) {
				foreach($args as $p => $v) {
					$this->$p = $v;
				}
			}
		}

		public function __get($nom) {
			return $this->$nom;
		}

		public function __set($n, $v) {
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

		public static function getPartnersList($type = '') {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			
			if ($type == 'university' || $type == 'company') {
				$sql = "SELECT * FROM partner WHERE type = '{$type}'";
			}

			else {
				$sql = 'SELECT * FROM partner';
			}
			
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function getPartnersByCountry($country) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM partner WHERE country = :country';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
			$sth->execute(array(
				':country' => $country
			));
			
			return $sth->fetchAll();
		}

		public static function getPartnersUniversityByCountry($country) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM partner WHERE country = :country AND type LIKE "university"';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
			$sth->execute(array(
				':country' => $country,
			));
			
			return $sth->fetchAll();
		}

		public static function addPartner($name, $type, $country) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				INSERT INTO partner(name, type, country, register_date)
				VALUES (:name, :type, :country, NOW())
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
			$sth->execute(array(
				':name' => $name,
				':type' => $type,
				':country' => $country
			));

			if ($sth) {
				return true;
			}

			return false;
		}

		public static function editPartner($id, $name, $country) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				UPDATE partner
				SET name = :name,
					country = :country
				WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
			$sth->execute(array(
				':id' => $id,
				':name' => $name,
				':country' => $country
			));

			if ($sth) {
				return true;
			}

			return false;
		}

		public static function editLogo($id, $logo) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$dbh = PDOConnexion::getInstance();
			$req = "
				UPDATE partner
				SET logo = :logo
				WHERE id = :id
			";
			$sth = $dbh->prepare($req);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Partner');
			$sth->execute(array(
				':id' => $id,
				':logo' => $logo
			));

			if ($sth) {
				return true;
			}

			return false;
		}

		public function addLogo($id, $file) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$dbh = PDOConnexion::getInstance();
			$req = "UPDATE partner SET logo = :logo WHERE id = :id";
			$st = $dbh->prepare($req);
			$st->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$st->execute(array(
				':logo' => $file,
				':id' => $id
			));

			if ($sth) {
				return true;
			}

			return false;
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

			$folder = dirname(dirname('uploads/partners'));
          	$file = $folder . '/' . $id . '.jpg';
          	$file2 = $folder . '/' . $id . '.png';
          	
          	if (file_exists($file)) {
          		unlink($file);
          	}

          	if (file_exists($file2)) {
          		unlink($file2);
          	}
		}
	}
?>
