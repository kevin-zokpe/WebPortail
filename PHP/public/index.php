<?php
    define('PUBLIC_ROOT', dirname($_SERVER['SCRIPT_FILENAME']));
    define('ROOT', dirname(PUBLIC_ROOT));
    define('DS', DIRECTORY_SEPARATOR);
    define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
    define('BASE_LINK', dirname($_SERVER['REQUEST_URI']));
    define('DOMAIN', $_SERVER['HTTP_HOST']);
    define('PROTOCOLE', (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ? 'https' : 'http');
	define('SYSTEM', ROOT . DS . 'system');
	define('APP', ROOT . DS . 'app');
	define('LANG', ROOT . DS . 'ressources' . DS . 'lang');

	require_once(APP . '/model/PDOConnexion.php');
	require_once (APP . '/model/Autoloader.php');
	Autoloader::register();

	session_start();
	ob_start();

	$language = new Language();
	$msg = new FlashMessages();

	if (empty($_GET['page'])) {
		$_GET['page'] = 'home';
	}

	if (substr($_GET['page'], 0, 6) == 'admin/') {
		if (App::isAdmin()) {
			if (!file_exists(APP . '/view/' . $_GET['page'] . '.php')) {
				App::getHeader(404, $language, $msg);
			}

			require_once(APP . '/view/admin/header.php');
			require_once(APP . '/view/' . $_GET['page'] . '.php');
			require_once(APP . '/view/admin/footer.php');
		}

		else {
			App::getHeader(404, $language, $msg);
		}
	}

	else {
		if (!file_exists(APP . '/view/' . $_GET['page'] . '.php')) {
			App::getHeader(404, $language, $msg);
		}

		else {
			require_once(APP . '/view/header.php');
			require_once(APP . '/view/' . $_GET['page'] . '.php');
			require_once(APP . '/view/footer.php');
		}
	}

	ob_end_flush();
?>
