
<body>
	<div class="container">
		<h1>Edit Post</h1>
		<div class="form-container col-md-6 mx-auto my-auto">
			<?php if (validation_errors()): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  	<?php echo validation_errors(); ?>
				  		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    	<span aria-hidden="true">&times;</span>
				  	</button>
				</div>
			<?php endif ?>

			<form action="<?php echo base_url() ?>editPost" method="post">
			  	<?php foreach ($post as $detail): ?>
			  		<input type="hidden" name="id" value="<?php echo $detail['id'] ?>">
			  		<div class="form-group">
					    <label for="title">Title</label>
					    <input type="text" class="form-control" id="title" name = "title"  value="<?php echo $detail['title']; echo set_value('title') ?>"  placeholder="Title">
				  	</div>
				  	<div class="form-group">
					    <label for="description">Description</label>
					    <textarea class="form-control" name = "description" id="description" rows="3"><?php echo $detail['description']; echo set_value('description') ?></textarea>
				  	</div>
			  	<?php endforeach ?>
			  	<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</body>
