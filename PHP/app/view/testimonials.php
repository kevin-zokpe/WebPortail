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
      ?>
			 
		</div>
	</div>
</div>
</div>
