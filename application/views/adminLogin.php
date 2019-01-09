
<body>
	<div class="container">
		<div class="form-container col-md-6 mx-auto my-auto">
			<?php if (validation_errors() || $flashData): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  	<?php echo validation_errors(); ?>
				  	<?php echo $flashData; ?>
				  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    	<span aria-hidden="true">&times;</span>
				  	</button>
				</div>
			<?php endif ?>

			<form action="<?php echo base_url() ?>checkLogin" method="post">
			  	<div class="form-group">
				    <label for="username">Username</label>
				    <input type="text" class="form-control" id="username" value="<?php echo set_value('username'); ?>" name = "username"  placeholder="Username">
			  	</div>
			  	<div class="form-group">
				    <label for="password">Password</label>
				    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
			  	</div>
			  	<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</body>
