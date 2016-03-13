<?php
	class Language {
		private $defaultLanguage = 'en';
		private $currentLanguage;
		private $translate = array();

		public function __construct() {
		    if (isset($_COOKIE['lang']) || isset($_SESSION['lang'])) {
		        if (isset($_COOKIE['lang'])) {
		            $this->currentLanguage = $_COOKIE['lang'];
		        }

		        if (isset($_SESSION['lang'])) {
		            $this->currentLanguage = $_SESSION['lang'];
		        }
		    }

		    else {
		        $this->currentLanguage = $this->defaultLanguage;
		    }

		    if (isset($_GET['lang'])) {
		    	$this->changeLanguage($_GET['lang']);
		    }

		    require_once(LANG . DS . $this->currentLanguage . '.php');
		    $this->translate = $translate;
		}

		public function changeLanguage($newLanguage) {
	        if ($this->existLanguage($newLanguage)) {
	        	$this->currentLanguage = htmlspecialchars($newLanguage);
	        }

	        else {
	        	$this->currentLanguage = $this->defaultLanguage;
	        }

	        $_SESSION['lang'] = $this->currentLanguage;
	        setcookie('lang', $this->currentLanguage, time() + (3600 * 24 * 30));
		}

		public function existLanguage($language) {
			if (file_exists(LANG . DS . $language . '.php')) {
				return true;
			}

			return false;
		}

		public function getCurrentLanguage() {
			$languageName = ($this->currentLanguage == 'fr') ? 'Français' : 'English';

			return array(
				'code' => $this->currentLanguage,
				'name' => $languageName
			);
		}

		public function getOtherLanguage() {
			if ($this->currentLanguage == 'fr') {
				return array(
					'code' => 'en',
					'name' => 'English'
				);
			}

			return array(
				'code' => 'fr',
				'name' => 'Français'
			);
		}

		public function translate($term) {
			if (!array_key_exists($this->currentLanguage, $this->translate)) {
				if (file_exists(LANG . DS . $this->currentLanguage . '.php')) {
					return $this->translate[$term];
				}
			}

			else {
				throw new Exception('Le terme "' . $term . '" n\'existe pas dans le fichier de traduction.');
			}
		}
	}
?>
