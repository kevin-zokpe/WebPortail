<?php
if (App::isAdmin()) {
	if (!isset($_GET['type']) || $_GET['type'] != 'awaiting') {
		$_GET['type'] = 'activated';
	}

	$type = htmlentities($_GET['type']);
?>
<div class="col-md-12">
	<div class="page-header">
		<h1>
			Liste des étudiants
			<?php
				if ($type == 'awaiting') {
					echo '<small>En attente d\'activation</small>';
					echo '<a href="index.php?page=admin/students-list&amp;type=activated" class="btn btn-primary pull-right">Voir les étudiants confirmés <span class="badge">' . count(Student::getActivatedStudents(true)) . '</span></a>';
				}

				else {
					echo '<small>Confirmés</small>';
					echo '<a href="index.php?page=admin/students-list&amp;type=awaiting" class="btn btn-primary pull-right">En attente de confirmation <span class="badge">' . count(Student::getActivatedStudents(false)) . '</span></a>';
				}
			?>
		</h1>
	</div>

	<?php
		if ($type == 'activated') :
			if (Student::getActivatedStudents(true)) :
	?>
		<table class="table table-striped">
			<thead>
				<tr>
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
			<?php
				foreach (Student::getActivatedStudents(true) as $student) {
					echo '<tr data-id="' . $student->id . '">';
						echo '<td>' . $student->last_name . '</td>';
						echo '<td>' . $student->first_name . '</td>';
						echo '<td>' . $student->country . '</td>';
						echo '<td>' . Skill::getSkillById($student->skill)->name . '</td>';
						echo '<td><a href="mailto:' . $student->email . '">' . $student->email . '</a></td>';
						echo '<td><a href="' . $student->portfolio . '" target="_blank">' . $student->portfolio . '</a></td>';
						if ($student->available) {
							echo '<td><i class="fa fa-check" style="color: #27ae60;"></i></td>';
						}

						else {
							echo '<td><i class="fa fa-times" style="color: #c0392b;"></i></td>';
						}
						echo '<td>' . $student->register_date . '</td>';
						echo '<td><a href="index.php?page=admin/student-edit&amp;id=' . $student->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
						echo '<td><a href="#" title="Supprimer" data-action="delete" data-toggle="tooltip" title="Supprimer"><i class="fa fa-trash"></i></a></td>';
					echo '</tr>';
				}
			?>
		</table>
	<?php
			else:
				echo 'Aucun étudiant n\'a été confirmé.';
			endif;
		else:
			if (Student::getActivatedStudents(false)) :
	?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Pays</th>
					<th>Compétence</th>
					<th>Email</th>
					<th>Portfolio</th>
					<th>Date d'inscription</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<?php
				foreach (Student::getActivatedStudents(false) as $student) {
					echo '<tr data-id="' . $student->id . '">';
						echo '<td>' . $student->last_name . '</td>';
						echo '<td>' . $student->first_name . '</td>';
						echo '<td>' . $student->country . '</td>';
						echo '<td>' . Skill::getSkillById($student->skill)->name . '</td>';
						echo '<td><a href="mailto:' . $student->email . '">' . $student->email . '</a></td>';
						echo '<td><a href="'.$student->portfolio.'" target="_blank">' . $student->portfolio . '</td>';
						echo '<td>' . $student->register_date . '</td>';
						echo '<td><a href="index.php?page=admin/student-activate&amp;id=' . $student->id . '"><i class="fa fa-check" data-toggle="tooltip" title="Activer"></i></a></td>';
						
						echo '<td><a href="index.php?page=admin/student-edit&amp;id=' . $student->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
						echo '<td><a href="#" title="Supprimer" data-action="delete" data-toggle="tooltip" title="Supprimer"><i class="fa fa-trash"></i></a></td>';
					echo '</tr>';
				}
			?>
		</table>
	<?php
			else:
				echo 'Aucun étudiant n\'est en attente de confirmation.';
			endif;
		endif;
	}
	else{
		App::getHeader(404);	}
	?>
</div>
<script>
	$('[data-action="delete"]').click(function(e) {
		e.preventDefault();

		eAjax(
			'public/webservice/admin/student-delete.php',
			{'delete': true, 'id': $(this).parent().parent().data('id')},
			'deleteRow'
		);
	});

	var eAjaxData = '';

	function eAjax(url, parameters, callback) {
	    if (!confirm('Êtes-vous sûr ?')) {
	        return false;
	    }

	    $.post(url, parameters, function(data) {
	        eAjaxData = data;
	        var func = callback + "()";
	        eval(func);
	    }, "json");
	}

	function deleteRow() {
	    if (eAjaxData.status == 'true') {
	        $('[data-id="' + eAjaxData.id + '"]').fadeTo('slow', 0.01).slideUp('slow');
	    }
	    
	    else {
	        alert(eAjaxData.status);
	    }
	}
</script>
