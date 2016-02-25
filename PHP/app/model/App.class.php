<?php
	class App {
		public static $siteTitle = 'Web Portal';

		public static function isCurrentPage($page) {
			if ($_GET['page'] == $page) {
				echo ' class="active"';
			}
		}

		public static function isLogged() {
			if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
				return true;
			}

			return false;
		}

		public static function error($log) {
			echo '
				<div class="erreur">
					<div class="container">
						<i class="fa fa-times-circle"></i>
						' . $log . '
					</div>
				</div>
			';
		}

		public static function success($log) {
			echo '
				<div class="success">
					<div class="container">
						<i class="fa fa-check"></i>
						' . $log . '
					</div>
				</div>
			';
		}

		public static function getGravatar($email, $size = 80, $defaultImg = 'wavatar', $maximumRating = 'g', $img = false, $additional = array()) {
			$url = 'http://www.gravatar.com/avatar/';
			$url .= md5(strtolower(trim($email)));
			$url .= "?s=$size&d=$defaultImg&r=$maximumRating";
			
			if ($img) {
				$url = '<img src="' . $url . '"';
				foreach ($additional as $key => $val) {
					$url .= ' ' . $key . '="' . $val . '"';
				}
				$url .= ' />';
			}

			return $url;
		}

		public static function getHeader($code) {
			switch ($code) {
				case 404:
					header("HTTP/1.0 404 Not Found");
					require_once(APP . '/view/error.php');
				break;

				case 403:
					header("HTTP/1.0 403 Forbidden");
				break;
			}
		}

		public static function redirect($url) {
			header('Location: ' . $url);
		}

		public static function dd($var) {
			echo '<pre>';
				var_dump($var);
			echo '</pre>';
			die();
		}

		public static function url($url) {
			$url = strip_tags($url);
			$url = strtolower($url);

			trim($url);
			$url = preg_replace('%[.,:\'"/\\\\[\]{}\%\-_!?]%simx', ' ', $url);
			$url = str_ireplace(' ', '-', $url);
			$url = str_ireplace('---', '-', $url);
			$url = str_ireplace('-|', '', $url);
			$url = str_ireplace('-&', '', $url);
			$url = self::removeAccents($url);

			return $url;
		}

		private static function removeAccents($str, $charset = 'utf-8') {
			$str = htmlentities($str, ENT_NOQUOTES, $charset);

			$str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
			$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
			$str = preg_replace('#&[^;]+;#', '', $str);

			return $str;
		}
	}
?>