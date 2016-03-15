<?php
    define('PUBLIC_ROOT', dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME']))));
    define('ROOT', dirname(PUBLIC_ROOT));
    define('DS', DIRECTORY_SEPARATOR);
    define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
    define('DOMAIN', $_SERVER['HTTP_HOST']);
    define('PROTOCOLE', (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ? 'https' : 'http');
	define('SYSTEM', ROOT . DS . 'system');
	define('APP', ROOT . DS . 'app');
	define('LANG', ROOT . DS . 'ressources' . DS . 'lang');

	session_start();

	require_once(APP . '/model/PDOConnexion.php');
	require_once (APP . '/model/App.class.php');
	require_once (APP . '/model/Student.class.php');
	require_once (APP . '/model/Company.class.php');
	
	header('Content-Type: application/json');

	if (isset($_POST['delete']) && isset($_POST['id']) && App::isAdmin()) {
		Student::deleteStudent(htmlentities($_POST['id']));
		
		die (
			json_encode (
				array_merge (
					$_POST, array (
						'status' => 'true'
					)
				)
			)
		);
	}

	echo json_encode (
		array_merge (
			$_POST, array (
				'status' => 'unknown error'
			)
		)
	);

	die ();
?>