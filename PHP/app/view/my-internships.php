<?php
	if (App::isLogged() && $_SESSION['type'] == 'company') :
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>Stages proposés</h1>
			</div>

			<?php if (Internship::getInternshipsByCompany($member->id)) : ?>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Nom</th>
							<th>Description</th>
							<th>Entreprise</th>
							<th>Adresse</th>
							<th>Ville</th>
							<th>Code postal</th>
							<th>Domaine d'activité</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<?php
						foreach (Internship::getInternshipsByCompany($member->id) as $internship) {
							echo '<tr>';
								echo '<td>' . $internship->id . '</td>';
								echo '<td>' . $internship->name . '</td>';
								echo '<td>' . $internship->description . '</td>';
								echo '<td>' . Company::getCompanyById($internship->company)->name . '</td>';
								echo '<td>' . $internship->address . '</td>';
								echo '<td>' . $internship->city . '</td>';
								echo '<td>' . $internship->zip_code . '</td>';
								echo '<td>' . Skill::getSkillById($internship->skill)->name . '</td>';
								echo '<td><a href="index.php?page=edit-internship"><i class="fa fa-pencil"></i></a></td>';
								echo '<td><a href="#"><i class="fa fa-trash"></i></a></td>';
							echo '</tr>';
						}
					?>
				</table>
			<?php
				else:
			?>
				Vous n'avez ajouté aucun stage
			<?php
				endif;
			?>
			<a href="index.php?page=create-internship" class="btn btn-primary">Proposer un stage</a>
		</div>
	</div>
</div>
<?php
	else:
		App::getHeader(404);
	endif;
?>