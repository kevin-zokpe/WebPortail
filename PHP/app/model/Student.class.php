<?php	
	class Student {
		private $id;
		private $first_name;
		private $last_name;
		private $country;
		private $skill;
		private $email;
		private $password;
		private $cv;
		private $portfolio;
		private $admin;
		private $available;
		private $activated;
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

		public static function getStudentById($id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM student WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute(array(
				':id' => $id
			));
			
			return $sth->fetch();
		}

		public static function checkEmailExist($email) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT id FROM student WHERE email = :email';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
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

		public static function getStudentIDByEmail($email) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT id FROM student WHERE email = :email';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute(array(
				':email' => $email
			));
			
			return $sth->fetch();
		}

		public static function getStudentsList() {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM student';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function getStudentsBySkill($skill) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM student WHERE skill = :skill && activated && available';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute(array(
				':skill' => $skill
			));
			
			return $sth->fetchAll();
		}

		public static function changeInternshipRequest($available, $studentId) {
			$availableBoolean = ($available == 'activate') ? true : false;

			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				UPDATE student
				SET available = :available
				WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute(array(
				':id' => $studentId,
				':available' => $availableBoolean
			));

			return $sth;
		}

		public static function countStudentsInternshipRequest() {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT COUNT(*) as count FROM student WHERE available = true';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute();
			
			return $sth->fetch()->count;
		}

		public static function getActivatedStudents($activated = true) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = ($activated == true) ? 'SELECT * FROM student WHERE activated' : 'SELECT * FROM student WHERE !activated';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function activateStudent($studentId) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				UPDATE student
				SET activated = true
				WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute(array(
				':id' => $studentId
			));
			
			return $sth;
		}

		public static function changePassword($password, $id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
			UPDATE student
			SET password = :password
			WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute(array(
				':password' => $password,
				':id' => $id
			));
			
			return $sth;
		}

		public static function changePortfolio($portfolio, $id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
			UPDATE student
			SET portfolio = :portfolio
			WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute(array(
				':portfolio' => $portfolio,
				':id' => $id
			));
			
			return $sth;
		}

		public static function editStudent($id, $first_name, $last_name, $country, $skill, $email, $portfolio, $activated) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				UPDATE student
				SET first_name = :first_name,
					last_name = :last_name,
					country = :country,
					skill = :skill,
					email = :email,
					portfolio = :portfolio,
					activated = :activated
				WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute(array(
				':id' => $id,
				':first_name' => $first_name,
				':last_name' => $last_name,
				':country' => $country,
				':skill' => $skill,
				':email' => $email,
				':portfolio' => $portfolio,
				':activated' => $activated
			));

			if ($sth) {
				return true;
			}

			return false;
		}

		public static function editCv($id, $cv) {
			PDOConnexion::setParameters('stage', 'root', 'root');
			$dbh = PDOConnexion::getInstance();
			$req = "
				UPDATE student
				SET cv = :cv
				WHERE id = :id
			";
			$sth = $dbh->prepare($req);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute(array(
				':id' => $id,
				':cv' => $cv
			));

			if ($sth) {
				return true;
			}

			return false;
		}

		public static function deleteStudent($id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'DELETE FROM student WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute(array(
				':id' => $id
			));

			$folder = dirname(dirname('../../uploads/cv'));
          	$file = $folder . '/' . $id . '.pdf';
          	
          	if (file_exists($file)) {
          		unlink($file);
          	}
		}
	}
?>
