<?php	
	class Faq {
		private $id;
		private $question;
		private $answer;
		private $target;
		
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

		public static function getFaqById($id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM faq WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Faq');
			$sth->execute(array(
				':id' => $id
			));
			
			return $sth->fetch();
		}

		public static function getStudentsFaq() {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM faq WHERE target LIKE "student"';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Faq');
			$sth->execute();
			
			return $sth->fetchAll();
		}
		
		public static function getCompaniesFaq() {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM faq WHERE target LIKE "company"';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Faq');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function editFaq($id, $question, $answer, $target) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				UPDATE faq
				SET question = :question,
					answer = :answer,
					target = :target
				WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Faq');
			$sth->execute(array(
				':id' => $id,
				':question' => $question,
				':answer' => $answer,
				':target' => $target
			));

			if ($sth) {
				return true;
			}

			return false;
		}

		public static function deleteFaq($id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'DELETE FROM faq WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Faq');
			$sth->execute(array(
				':id' => $id
			));
		}
	}
?>
