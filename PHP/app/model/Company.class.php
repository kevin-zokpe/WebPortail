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

		public static function getForeignCompanies($country) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM company WHERE country != :country AND activated';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
			$sth->execute(array(
				':country' => $country
			));
			
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

		public static function addCompany($name, $email, $country, $city, $description, $password, $website) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				INSERT INTO company(name, email, country, city, description, password, website, activated, register_date)
				VALUES (:name, :email, :country, :city, :description, :password, :website, false, NOW())
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute(array(
				':name' => $name,
				':email' => $email,
				':country' => $country,
				':city' => $city,
				':description' => $description,
				':password' => Bcrypt::hashPassword($password),
				':website' => $website
			));

			App::notification('Une entreprise vient de s\'inscrire', 'Une nouvelle entreprise vient de s\'inscrire sur le site. Connectez-vous pour la confirmer.');
		}

		public static function addCompanyForAdmin($name,$email,$country,$city,$description,$admin_password,$website) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				INSERT INTO company(name, email, country, city, description, password, website, activated, register_date)
				VALUES (:name, :email, :country, :city, :description, :password, :website, true, NOW())
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
			$sth->execute(array(
				':name' => $name,
				':email' => $email,
				':country' => $country,
				':city' => $city,
				':description' => $description,
				':password' => $admin_password,
				':website' => $website
			));
		}

		public static function editCompany($id,$name,$email,$country,$city,$description,$website,$activated){
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				UPDATE company
				SET name = :name,
					email = :email,
					country = :country,
					city = :city,
					description = :description,
					website = :website,
					activated = :activated
				WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
			$sth->execute(array(
				':id' => $id,
				':name' => $name,
				':email' => $email,
				':country' => $country,
				':city' => $city,
				':description' => $description,
				':website' => $website,
				':activated' => $activated
			));
		}

		public static function editLogo($id, $file) {
	 		PDOConnexion::setParameters('stages', 'root', 'root');
			$dbh = PDOConnexion::getInstance();
			$req = "UPDATE company SET logo = :logo WHERE id = :id";
			$st = $dbh->prepare($req);
			$st->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
			$st->execute(array(
				':logo' => $file,
				':id' => $id
			));
		}

			

		public static function editLogoForAdmin($file,$id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$dbh = PDOConnexion::getInstance();
			$req = "UPDATE company SET logo = :logo WHERE id = :id";
			$st = $dbh->prepare($req);
			$st->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Company');
			$st->execute(array(
				':logo' => $file,
				':id' => $id
			));
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

			$folder = dirname(dirname(BASE_URL . '/uploads/companies'));
          	
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
