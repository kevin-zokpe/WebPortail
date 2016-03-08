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

		public function __get($nom){
			return $this->$nom;
		}

		public function __set($n, $v){
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
	}
?>
