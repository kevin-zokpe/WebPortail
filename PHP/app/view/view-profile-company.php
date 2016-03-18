<?php
	$company = Company::getCompanyById($_GET['id']);
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row" style="margin-bottom: 15px;">
				<div class="col-md-12">
					<h1><?php echo $company->name; ?></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-9">
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label">Logo</label>
							<div class="col-sm-10">
								<img class="form-control-static" alt="Aucun" src="<?php echo $company->logo; ?>" style="width:100px;"/></p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<p class="form-control-static"><?php echo $company->email; ?></p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Pays</label>
							<div class="col-sm-10">
								<p class="form-control-static"><?php echo $company->country; ?></p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Ville</label>
							<div class="col-sm-10">
								<p class="form-control-static"><?php echo $company->city; ?></p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Description</label> 
							<div class="col-sm-10">
								<p class="form-control-static"><?php echo $company->description; ?></p>
							</div>
						</div>

						<div class="form-group">
							<label for="profile-portfolio" class="col-sm-2 control-label">Site internet</label>
							<div class="col-sm-10">
								<p class="form-control-static"><a href="<?php echo $company->website; ?>"><?php echo $company->website; ?></a></p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Date d'inscription</label>
							<div class="col-sm-10">
								<p class="form-control-static"><?php echo $company->register_date; ?></p>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>