<?php if (App::isStudent()) : ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('select[name="skill"]').change(function() {
				var selectedSkill = $(this).val();

				$.getJSON(
					"public/webservice/internships.php", {"skill": selectedSkill}, function(result) {
						if (result.no_result) {
							$('#results').html('Aucun stage disponible dans ce domaine');
						}

						else {
							var table = '<table class="table table-striped"><thead><tr><th>Entrepise</th><th>Poste</th><th>Mission</th><th>Adresse</th><th>Ville</th><th>Zip_code</th><th></th></tr></thead><tbody>';
							
							for (i = 0; i < result.length; i++) {
								var internshipInfo = result[i];
								table += '<tr><td>' + internshipInfo.company + '</td><td>' + internshipInfo.name + '</td><td>' + internshipInfo.description + '</td><td>' + internshipInfo.address + '</td><td>' + internshipInfo.city + '</td><td>' + internshipInfo.zip_code + '</td>' + '<td><i class="fa fa-envelope"></i> <a href="mailto:' + internshipInfo.email + '">Contacter</a></td>';
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
						Rechercher des stages
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