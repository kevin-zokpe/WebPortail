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
	require_once (APP . '/model/Company.class.php');
	require_once (APP . '/model/Skill.class.php');
	require_once (APP . '/model/Student.class.php');
	require_once (APP . '/model/Internship.class.php'); 
	
	header('Content-Type: application/json');

	$skill = htmlentities($_GET['skill']);
	$internship = Internship::getInternshipBySkill($skill);


	if ($internship) {
		foreach ($internship as $id => $result) {
			$array[$id] = array(
				'id' => $result->id,
				'id_company' => $result->company,
				'name' => $result->name,
				'description' => $result->description,
				'company' => Company::getCompanyById($result->company)->name,
				'address' => $result->address,
				'city' => $result->city,
				'zip_code' => $result->zip_code,
				'skill' => Skill::getSkillById($result->skill)->name,
				'email' => Company::getCompanyById($result->company)->email,
				'website' => Company::getCompanyById($result->company)->website
			);

			$data = json_encode($array);
		}

		echo $data;
	}

	else {
		echo json_encode(array('no_result' => 'Aucun stage disponible dans ce domaine'));
	}
?>
