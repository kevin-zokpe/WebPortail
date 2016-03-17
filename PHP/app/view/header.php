<!DOCTYPE html>
<html lang="<?php echo $language->getCurrentLanguage()['code']; ?>">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?php echo Settings::getWebsiteDescription(); ?>">
		<link rel="icon" href="img/favicon.png">
		<title><?php echo Settings::getWebsiteName(); ?></title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<?php require_once(APP . '/view/navbar.php'); ?>

		<?php if ($msg->hasMessages()) { ?>
			<div id="notification">
				<div class="container">
					<?php $msg->display(); ?>
				</div>
			</div>
		<?php } ?>
