<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Témoignages</h2>

      		<?php
			foreach(Testimony::getTestimonialsList() as $testimony) {
          			echo '
            				<br />
            				<div class="row">
        					<div class="col-md-offset-2 col-md-8">
                					<h3>' . $testimony->description . '</h3>
                					<p><b>' . $testimony->author . '</b>, ' . $testimony->register_date . '</p>
              					</div>
            				</div>
          			';
        		}

        		if(App::isStudent()){
          			echo '<a href="index.php?page=create-testimony&type=student" class="btn btn-primary">Ajouter un témoignage</a>';
        		}	

        		if(App::isCompany()){
          			echo '<a href="index.php?page=create-testimony&type=company" class="btn btn-primary">Ajouter un témoignage</a>';
        		}
      		?>
		</div>
	</div>
</div>
</div>
