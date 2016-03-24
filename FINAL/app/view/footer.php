		<footer id="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-6"><a href="index.php?page=home"><?php echo Settings::getWebsiteName(); ?></a> - Copyright &copy; <?php echo date('Y'); ?></div>
					<div class="col-md-6">
						<ul id="footer-nav">
							<li<?php App::isCurrentPage('home'); ?>><a href="index.php?page=home">Accueil</a></li>
							<li<?php App::isCurrentPage('faq'); ?>><a href="index.php?page=faq">FAQ</a></li>
							<li<?php App::isCurrentPage('testimonials'); ?>><a href="index.php?page=testimonials">Témoignages</a></li>
							<li<?php App::isCurrentPage('about'); ?>><a href="index.php?page=about">À propos</a></li>
							<li<?php App::isCurrentPage('terms'); ?>><a href="index.php?page=terms">Mentions légales</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/flexslider.min.js"></script>
		<script src="js/script.js"></script>
	    <script type="text/javascript">
	    	$(function () {
  				$('[data-toggle="tooltip"]').tooltip()
			})
	    </script>
	</body>
</html>