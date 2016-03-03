<?php
	if (App::isStudent()) :
		$student = Student::getStudentById($_SESSION['id']);

		if (isset($_POST['optionsRadios'])) {
			if (Student::changeInternshipRequest($_POST['optionsRadios'], $student->id)) {
				App::redirect('index.php?page=internship-request');
			}
		}
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			$("input[name$='optionsRadios']").click(function () {
				$('#post-request').submit();
			});
		});
	</script>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row" >
					<div class="col-md-12">
						<h1>Demander un stage</h1>
						<form action="index.php?page=internship-request" method="POST" id="post-request">
							<div class="radio">
								<label>
									<input type="radio" name="optionsRadios" value="activate"<?php if ($student->available) {echo ' checked';} ?>>
									Activer la recherche de stage
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="optionsRadios" value="deactivate"<?php if (!$student->available) {echo ' checked';} ?>>
									Désactiver la recherche de stage
								</label>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	else:
		App::redirect('index.php?page=home');
	endif;
?>