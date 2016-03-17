<?php if (App::isCompany()) : ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('select[name="skill"]').change(function() {
				var selectedSkill = $(this).val();

				$.getJSON(
					"public/webservice/students.php", {"skill": selectedSkill}, function(result) {
						if (result.no_result) {
							$('#results').html('Aucun étudiant.');
						}

						else {
							var table = '<table class="table table-striped"><thead><tr><th>Nom</th><th>Prénom</th><th>Pays</th><th>Compétence</th><th>Email</th><th>CV</th><th>Portfolio</th><th>Date d\'inscription</th><th></th></tr></thead><tbody>';
							
							for (i = 0; i < result.length; i++) {
								var studentInfo = result[i];
								table += '<tr><td>' + studentInfo.last_name + '</td><td>' + studentInfo.first_name + '</td><td>' + studentInfo.country + '</td><td>' + studentInfo.skill + '</td><td><a href="mailto:' + studentInfo.email + '">' + studentInfo.email + '</a></td><td>' + studentInfo.cv + '<td><a href="'+studentInfo.portfolio+'" target="_blank">' + studentInfo.portfolio + '</a></td><td>' + studentInfo.register_date + '</td><td><i class="fa fa-envelope"></i> <a href="mailto:' + studentInfo.email + '">Contacter</a></td><td><i class="fa fa-user"></i> <a href="index.php?page=view-profile-student&id=' + studentInfo.id + '">Voir le profil</a></td></tr>';
							}

							table += '</tbody></table>';
							$("#results").html(table);
						}
					}
				)
			});
		});
	</script>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h1>
						Rechercher des étudiants
						<form action="index.php?page=find-student" method="POST" class="pull-right">
							<select name="skill" class="form-control">
								<option value="" disabled selected>Domaine de compétence</option>
								<?php
									foreach (Skill::getSkillsList() as $skill) {
										echo '<option value="' . $skill->id . '">' . $skill->name . '</option>';
									}
								?>
							</select>
						</form>
					</h1>
				</div>

				<div id="results">Choissisez le domaine de compétence à rechercher</div>
			</div>
		</div>
	</div>
<?php
	else:
		App::getHeader(404);
	endif;
?>
