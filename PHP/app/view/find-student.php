<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					Rechercher des étudiants
					<form action="index.php?page=find-student" method="POST" class="pull-right">
						<select name="skill" class="form-control" placeholder="x">
							<option value="" disabled selected>Domaine de compétence</option>
							<?php
								foreach (Skill::getSkillsList() as $skill) {
									echo '<option value="' . $skill->id . '">' . $skill->name . '</option>';
								}
							?>
						</select>
					</div>
				</h1>
			</div>

			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Pays</th>
						<th>Compétence</th>
						<th>Email</th>
						<th>Portfolio</th>
						<th>En recherche</th>
						<th>Date d'inscription</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>