<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div>
			<h2>FAQ Etudiant</h2>
			<?php
				PDOConnexion::setParameters('stages','root','root');
				foreach(Faq::getStudentsFaq() as $faq){
				echo "<br/><div class='row'><div class='col-md-offset-2 col-md-8'><p><b>" . $faq->question . "</b></p></div></div>
					<div class='row'><div class='col-md-offset-2 col-md-8'>" . $faq->answer . "</div></div>";
				}
			?>
			<h2>FAQ Entreprise</h2>
			<?php
				PDOConnexion::setParameters('stages','root','root');
				foreach(Faq::getCompanyFaq() as $faq){
				echo "<br/><div class='row'><div class='col-md-offset-2 col-md-8'><p><b>" . $faq->question . "</b></p></div></div>
					<div class='row'><div class='col-md-offset-2 col-md-8'>" . $faq->answer . "</div></div>";
				}
			?>
		</div>
	</div>
</div>