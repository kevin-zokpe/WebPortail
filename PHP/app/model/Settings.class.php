<?php
	class Settings {
		private $id;
		private $tag;
		private $value;
		private $placeholder;
		private $data_type;

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

		public static function getSettingsList() {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "SELECT * FROM settings";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Settings');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function getSettingById($id) {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM settings WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
			$sth->execute(array(
				':id' => $id
			));
			
			return $sth->fetch();
		}

		public static function getWebsiteName() {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "SELECT value FROM settings WHERE tag = 'website_name'";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Settings');
			$sth->execute();
			
			return $sth->fetch()->value;
		}

		public static function getWebsiteDescription() {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "SELECT value FROM settings WHERE tag = 'website_description'";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Settings');
			$sth->execute();
			
			return $sth->fetch()->value;
		}

		public static function getNotificationEmail() {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "SELECT value FROM settings WHERE tag = 'notification_email'";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Settings');
			$sth->execute();
			
			return $sth->fetch()->value;
		}

		public static function isActivatedNotification() {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "SELECT value FROM settings WHERE tag = 'activate_notification'";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Settings');
			$sth->execute();

			if ($sth->fetch()->value == 'true') {
				return true;
			}

			return false;
		}

		public static function getRecaptchaKey($type = 'public') {
			PDOConnexion::setParameters('stages', 'root', 'root');
			$db = PDOConnexion::getInstance();

			$keyType = ($type == 'private') ? 'recaptcha_private_key' : 'recaptcha_public_key';
			$sql = "SELECT value FROM settings WHERE tag = :keyType";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Settings');
			$sth->execute(array(
				':keyType' => $keyType
			));
			
			return $sth->fetch()->value;
		}
	}
?>
