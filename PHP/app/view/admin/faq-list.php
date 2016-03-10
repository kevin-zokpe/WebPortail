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
			<tr>
				<th>Question</th>
				<th>Réponse</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				if ($type == 'student') {
					foreach (Faq::getStudentsFaq() as $faq) {
						echo '<tr data-id="' . $faq->id . '">';
							echo '<td>' . $faq->question . '</td>';
							echo '<td>' . $faq->answer . '</td>';
							echo '<td><a href="index.php?page=admin/faq-edit&amp;id=' . $faq->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
							echo '<td><a href="#" title="Supprimer" data-action="delete"><i class="fa fa-trash"  data-toggle="tooltip" title="Supprimer"></i></a></td>';
						echo '</tr>';
					}
				}

				else {
					foreach (Faq::getCompaniesFaq() as $faq) {
						echo '<tr data-id="' . $faq->id . '">';
							echo '<td>' . $faq->question . '</td>';
							echo '<td>' . $faq->answer . '</td>';
							echo '<td><a href="index.php?page=admin/faq-edit&amp;id=' . $faq->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
							echo '<td><a href="#" title="Supprimer" data-action="delete"><i class="fa fa-trash" data-toggle="tooltip" title="Supprimer"></i></a></td>';
						echo '</tr>';
					}
				}
			?>
		</tbody>
	</table>
	<a href="index.php?page=admin/add-faq&amp;type=<?php echo $type; ?>" class="btn btn-primary">Ajouter une question</a>
</div>

<script>
	$('[data-action="delete"]').click(function(e) {
		e.preventDefault();

		eAjax(
			'public/webservice/admin/faq-delete.php',
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
