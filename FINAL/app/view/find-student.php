<?php if (App::isCompany()) : ?>
	<header id="header">
		<div class="section-title">
			<h1>Rechercher des étudiants</h1>
			<form action="index.php?page=find-student" method="POST" id="find-student" style="width: 480px; margin: auto; position: relative; bottom: 40px;">
				<select name="skill" class="form-control" data-country="<?php echo $_SESSION['country']; ?>">
					<option value="" disabled selected>Domaine de compétence</option>
					<?php
						foreach (Skill::getSkillsList() as $skill) {
							echo '<option value="' . $skill->id . '">' . $skill->name . '</option>';
						}
					?>
				</select>
			</form>
		</div>
	</header>

	<div id="main-content" class="section-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="results">Choissisez le domaine de compétence à rechercher</div>
				</div>
			</div>
		</div>
	</div>
<?php
	else:
		App::getHeader(404);
	endif;
?>
