<?php
	class Autoloader {
		public static function register() {
			spl_autoload_register(array(__CLASS__, 'appAutoload'));
		}

		public static function appAutoload($class) {
			$class = str_replace('\\', '/', $class);

			if (!file_exists(APP . '/model/' . $class. '.class.php') ) {
				return false;
			}
			
			require_once (APP . '/model/' . $class. '.class.php');
		}
	}
?>