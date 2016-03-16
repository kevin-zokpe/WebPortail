<?php	
	class Company {
		private $id;
		private $name;
		private $email;
		private $password;
		private $country;
		private $city;
		private $description;
		private $website;
		private $activated;
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

		public static function getCompanyById($id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM company WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
			$sth->execute(array(
				':id' => $id
			));
			
			return $sth->fetch();
		}

		public static function getCompanyIDByEmail($email) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT id FROM company WHERE email = :email';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
			$sth->execute(array(
				':email' => $email
			));
			
			return $sth->fetch();
		}

		public static function checkEmailExist($email) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT id FROM company WHERE email = :email';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
			$sth->execute(array(
				':email' => $email
			));
			
			$res = $sth->fetch();
			
			if(isset($res->id)){
				return true;
			}
			else{
				return false;
			}
		}

		public static function getCompaniesList() {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM company';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function getCompaniesListInFrance() {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM company WHERE country LIKE "France"';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function getCompaniesListInIrland() {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM company WHERE country LIKE "Irlande"';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function getActivatedCompanies($activated = true) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = ($activated == true) ? 'SELECT * FROM company WHERE activated' : 'SELECT * FROM company WHERE !activated';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function activateCompany($companyId) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				UPDATE company
				SET activated = true
				WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
			$sth->execute(array(
				':id' => $companyId
			));
			
			return $sth;
		}

		public static function changePassword($password, $id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
			UPDATE company
			SET password = :password
			WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
			$sth->execute(array(
				':password' => $password,
				':id' => $id
			));
			
			return $sth;
		}

		public static function deleteCompany($id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'DELETE FROM company WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
			$sth->execute(array(
				':id' => $id
			));

			$folder = "../../uploads/companies";
          		$file = $folder . '/' . $id . '.jpg';
          		$file2 = $folder . '/' . $id . '.png';
          		if(file_exists($file)) unlink($file);
          		if(file_exists($file2)) unlink($file2);
		}
	}
?>
