		<footer id="footer" style="border-top: 1px solid #ededed; margin-top: 30px; padding: 15px 0;">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<a href="index.php?page=terms" style="margin-right: 15px;">Conditions d'utilisation</a>
						<a href="index.php?page=legal" style="margin-right: 15px;">Mentions légales</a>
						<a href="index.php?page=about">À propos</a>
					</div>
					<div class="col-md-4 text-right">
						Copyright &copy; <?php echo date('Y') . ' <a href="index.php?page=home">' . Settings::getWebsiteName() . '</a>'; ?>
					</div>
				</div>
			</div>
		</footer>

	    <script src="js/bootstrap.min.js"></script>
	    <script type="text/javascript">
	    	$(function () {
  				$('[data-toggle="tooltip"]').tooltip()
			})
	    </script>
	</body>
</html>
