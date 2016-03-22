<div class="container">
	<div class="row">
		<div class="col-md-12">
		<?php
			if($language->getCurrentLanguage()['code']=='fr'){
		?>
			<h2>FAQ Etudiant</h2>
			<?php
				foreach(Faq::getStudentsFaq() as $faq) {
					echo '
						<br />
						<div class="row">
							<div class="col-md-offset-2 col-md-8">
								<p><b>' . $faq->question_fr . '</b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-offset-2 col-md-8">' . $faq->answer_fr . '</div>
						</div>
					';
				}
			?>

			<h2>FAQ Entreprise</h2>
			<?php
				foreach(Faq::getCompaniesFaq() as $faq) {
					echo '
						<br />
						<div class="row">
							<div class="col-md-offset-2 col-md-8">
								<p><b>' . $faq->question_fr . '</b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-offset-2 col-md-8">' . $faq->answer_fr . '</div>
						</div>
					';
				}
			}
			else{

			?>
			<h2>Student FAQ</h2>
			<?php
				foreach(Faq::getStudentsFaq() as $faq) {
					echo '
						<br />
						<div class="row">
							<div class="col-md-offset-2 col-md-8">
								<p><b>' . $faq->question_en . '</b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-offset-2 col-md-8">' . $faq->answer_en . '</div>
						</div>
					';
				}
			?>

			<h2>Company FAQ</h2>
			<?php
				foreach(Faq::getCompaniesFaq() as $faq) {
					echo '
						<br />
						<div class="row">
							<div class="col-md-offset-2 col-md-8">
								<p><b>' . $faq->question_en . '</b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-offset-2 col-md-8">' . $faq->answer_en . '</div>
						</div>
					';
				}
			}
			
			?>
		</div>
	</div>
</div>
