<?php
	if (!isset($_GET['skill'])) {
		header('HTTP/1.0 404 Not Found', true, 404);
	}

    define('PUBLIC_ROOT', dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
    define('ROOT', dirname(PUBLIC_ROOT));
    define('DS', DIRECTORY_SEPARATOR);
    define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
    define('DOMAIN', $_SERVER['HTTP_HOST']);
    define('PROTOCOLE', (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ? 'https' : 'http');
	define('SYSTEM', ROOT . DS . 'system');
	define('APP', ROOT . DS . 'app');
	define('LANG', ROOT . DS . 'ressources' . DS . 'lang');

	require_once(APP . '/model/PDOConnexion.php');
	require_once (APP . '/model/Student.class.php');
	require_once (APP . '/model/Skill.class.php');
	
	header('Content-Type: application/json');

	$skill = htmlentities($_GET['skill']);
	$country = htmlentities($_GET['country']);
	$student = Student::getStudentsBySkill($skill, $country);


	if ($student) {
		foreach ($student as $id => $result) {
			$array[$id] = array(
				'id'=>$result->id,
				'last_name' => $result->last_name,
				'first_name' => $result->first_name,
				'country' => $result->country,
				'skill' => Skill::getSkillById($result->skill)->name,
				'email' => $result->email,
				'cv' => $result->cv,
				'portfolio' => $result->portfolio,
				'register_date' => $result->register_date
			);

			$data = json_encode($array);
		}

		echo $data;
	}

	else {
		echo json_encode(array('no_result' => 'Aucun étudiant.'));
	}
?>
