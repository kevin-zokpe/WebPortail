<?php
	if (!isset($_GET['type'])) {
		App::redirect('index.php?page=admin/faq-list&type=student');
	}
	
	$type = ($_GET['type'] == 'student') ? 'student' : 'company';
?>
<div class="col-md-12">
	<div class="page-header">
		<h1>
			Liste des FAQ
			<?php
				if ($type == 'student') {
					echo '<small>Étudiants</small>';
					echo '<a href="index.php?page=admin/faq-list&type=company" class="btn btn-primary pull-right">Voir la liste des entreprises</a>';
				}

				else {
					echo '<small>Entreprises</small>';
					echo '<a href="index.php?page=admin/faq-list&type=student" class="btn btn-primary pull-right">Voir la liste des étudiants</a>';
				}
			?>
		</h1>
	</div>
	<table class="table table-striped">
		<thead>
			<th>#</th>
			<th>Question</th>
			<th>Réponse</th>
			<th></th>
			<th></th>
		</thead>
		<?php
			if ($type == 'student') {
				foreach (Faq::getStudentsFaq() as $faq) {
					echo '<tr>';
						echo '<td>' . $faq->id . '</td>';
						echo '<td>' . $faq->question . '</a></td>';
						echo '<td>' . $faq->answer . '</td>';
						echo '<td><a href="index.php?page=admin/faq-edit&amp;id=' . $faq->id . '"><i class="fa fa-pencil"></i></a></td>';
						echo '<td><a href="#"><i class="fa fa-trash"></i></a></td>';
					echo '</tr>';
				}
			}

			else {
				foreach (Faq::getCompaniesFaq() as $faq) {
					echo '<tr>';
						echo '<td>' . $faq->id . '</td>';
						echo '<td>' . $faq->question . '</a></td>';
						echo '<td>' . $faq->answer . '</td>';
						echo '<td><a href="index.php?page=admin/faq-edit&amp;id=' . $faq->id . '"><i class="fa fa-pencil"></i></a></td>';
						echo '<td><a href="#"><i class="fa fa-trash"></i></a></td>';
					echo '</tr>';
				}
			}
		?>
	</table>
</div>