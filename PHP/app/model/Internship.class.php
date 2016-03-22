<?php	
	class Internship {
		private $id;
		private $name;
		private $description;
		private $company;
		private $adress;
		private $city;
		private $zip_code;
		private $country;
		private $skill;
		private $student;
		
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

		public static function getInternshipById($id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM internship WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Internship');
			$sth->execute(array(
				':id' => $id
			));
			
			return $sth->fetch();
		}

		public static function getInternshipsByCompany($id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM internship WHERE company = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Internship');
			$sth->execute(array(
				':id' => $id
			));
			
			return $sth->fetchAll();
		}
		
		public static function getInternshipList() {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM internship';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Internship');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function getInternshipBySkill($skill, $country) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT I.* FROM internship I, company C WHERE I.skill = :skill AND I.company = C.id AND C.country != :country';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Internship');
			$sth->execute(array(
				':skill' => $skill,
				':country' => $country
			));
			
			return $sth->fetchAll();
		}

		public static function getInternshipByCompanyCountry($country) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT DISTINCT I.* FROM internship I , company C WHERE I.company = C.id AND C.country = :country';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Internship');
			$sth->execute(array(
				':country' => $country
			));
			
			return $sth->fetchAll();
		}

		public static function deleteInternship($id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'DELETE FROM internship WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Internship');
			$sth->execute(array(
				':id' => $id
			));
		}

		public static function addInternship($name,$description,$company,$address,$zip_code,$city,$skill){
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				INSERT INTO internship (name, description, company, address, zip_code, city, skill)
				VALUES (:name, :description, :company, :address, :zip_code, :city, :skill)
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Internship');
			$sth->execute(array(
				':name' => $name,
				':description' => $description,
				':company' => $company,
				':address' => $address,
				':zip_code' => $zip_code,
				':city' => $city,
				':skill' => $skill
			));
		}

		public static function editInternship($id,$description,$address,$city,$zip_code,$domain){
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				UPDATE internship
				SET description = :description,
					address = :address,
					city = :city,
					zip_code = :zip_code,
					skill = :skill
				WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Internship');
			$sth->execute(array(
				':id' => $id,
				':description' => $description,
				':address' => $address,
				':city' => $city,
				':zip_code' => $zip_code,
				':skill' => $domain
			));
		}
	}
?>
