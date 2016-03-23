<?php	
	class Faq {
		private $id;
		private $question_fr;
		private $question_en;
		private $answer_fr;
		private $answer_en;
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

		public function addFaq($question_fr,$answer_fr,$question_en,$answer_en,$type){
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				INSERT INTO faq(question_fr, answer_fr, question_en, answer_en, target)
				VALUES (:question_fr, :answer_fr, :question_en, :answer_en, :type)
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Faq');
			$sth->execute(array(
				':question_fr' => $question_fr,
				':answer_fr' => $answer_fr,
				':question_en' => $question_en,
				':answer_en' => $answer_en,
				':type' => $type
			));

			if ($sth) {
				return true;
			}

			return false;
		}

		public static function editFaq($id, $question_fr, $answer_fr, $question_en, $answer_en, $target) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				UPDATE faq
				SET question_fr = :question_fr,
					answer_fr = :answer_fr,
					question_en = :question_en,
					answer_en = :answer_en,
					target = :target
				WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Faq');
			$sth->execute(array(
				':id' => $id,
				':question_fr' => $question_fr,
				':answer_fr' => $answer_fr,
				':question_en' => $question_en,
				':answer_en' => $answer_en,
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
