<?php
	$id = htmlentities($_GET['id']);

	if (!isset($id) || empty($id)) {
		App::redirect('index.php?page=find-internship');
	}
	
	else {
		$internship = Internship::getInternshipById($id);
		$skill = Skill::getSkillById($id);
		$company = Company::getCompanyById($id);
?>
<header id="header">
	<div class="section-title">
		<h1>
			<?php echo $internship->name; ?>
			<small><?php echo $skill->name; ?></small>
		</h1>
	</div>
</header>

<div id="main-content" class="section-content">
	<div class="container">
		<div class="row">
			<h3>Entreprise</h3>
			<p><?php echo $company->name; ?></p>

			<h3>Description</h3>
			<p><?php echo $internship->description; ?></p>

			<h3>Lieu du stage</h3>
			<p><?php echo $internship->address . '<br/>' . $internship->city . ', ' . $internship->zip_code; ?></p>

			<button type="submit" class="btn btn-primary btn-lg" style="margin-top:30px;">Contacter</button>
		</div>
	</div>
</div>
<?php
	}
?>