<div class="col-md-12">
	<h1>Liste des étudiants</h1>
	<table class="table table-striped">
		<thead>
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
		</thead>
		<?php
			foreach (Student::getStudentsList() as $student) {
				echo '<tr>';
					echo '<td>' . $student->id . '</td>';
					echo '<td>' . $student->last_name . '</a></td>';
					echo '<td>' . $student->first_name . '</td>';
					echo '<td>' . $student->country . '</td>';
					echo '<td>' . Skill::getSkillById($student->skill)->name . '</td>';
					echo '<td>' . $student->email . '</td>';
					echo '<td>' . $student->portfolio . '</td>';
					if ($student->available) {
						echo '<td><i class="fa fa-check" style="color: #27ae60;"></i></td>';
					}

					else {
						echo '<td><i class="fa fa-times" style="color: #c0392b;"></i></td>';
					}
					echo '<td>' . $student->register_date . '</td>';
					echo '<td><a href="index.php?page=admin/student-edit&amp;id=' . $student->id . '"><i class="fa fa-pencil"></i></a></td>';
					echo '<td><a href="#"><i class="fa fa-trash"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
</div>