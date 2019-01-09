
<body>
	<div class="container">
		<div class="form-container col-md-10 mx-auto my-auto">
			<div class="row">
				<div class="col-md-6 mx-auto">
					<?php if ($flashData): ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						  	<?php echo $flashData; ?>
						  		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    	<span aria-hidden="true">&times;</span>
						  	</button>
						</div>
					<?php endif ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 add-button"><a href="<?php echo base_url() ?>addPostPage" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add Post</a></div>
			</div>
			<table class="table table-bordered">
			  	<thead>
				    <tr>
				      	<th width="20%" scope="col">Title</th>
				      	<th scope="col">Description</th>
				      	<th width="12%" scope="col">Action</th>
				    </tr>
			  	</thead>
			  	<tbody>
			  		<?php foreach ($posts as $post): ?>
				    <tr>
			      		<td><?php echo $post->title; ?></td>
				      	<td><?php echo$post->description; ?></td>
				      	<td>
					      	<a href="<?php echo base_url() ?>editPostPage/<?php echo $post->id;?>" class="btn btn-xs btn-warning action-icon">Edit</a>
					      	<a href="<?php echo base_url() ?>deletePost/<?php echo  $post->id; ?>" class="btn btn-xs btn-danger">Delete</a>
				     	</td>
				    </tr>
				    <?php endforeach ?>
			  	</tbody>
			  	<tfoot>
			  		<tr>
			  			<td colspan="3">
			  				<div class="col-md-12 mx-auto">
								<nav aria-label="Page navigation example">
								  	<ul class="pagination">
								    	<?php echo $links; ?>
								  	</ul>
								</nav>
							</div>
			  			</td>
			  		</tr>
			  	</tfoot>
			</table>
			
		</div>
	</div>
</body>
