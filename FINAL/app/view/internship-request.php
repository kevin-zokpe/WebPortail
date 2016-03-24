<?php
	if (App::isStudent()) :
		$student = Student::getStudentById($_SESSION['id']);

		if (isset($_POST['optionsRadios'])) {
			if (Student::changeInternshipRequest($_POST['optionsRadios'], $student->id)) {
				App::redirect('index.php?page=internship-request');
			}
		}
	?>
	<header id="header">
	    <div class="section-title">
	        <h1>Demander un stage</h1>
	    </div>
	</header>

	<div id="main-content" class="section-content">
	    <div class="container">
	        <div class="row">
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
<?php
	else:
		App::redirect('index.php?page=home');
	endif;
?>