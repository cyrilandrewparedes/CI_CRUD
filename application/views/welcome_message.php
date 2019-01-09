
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
		<div class="container">
			<a href="#" class="navbar-brand">Blog</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="navbar-item"><a href="<?php echo base_url() ?>admin" class="btn btn-medium btn-primary">Sign-in</a></li>
				</ul>
			</div>
		</div>
	</nav>
	
	<div class="blog-posts">
		<div class="container">
			<h1>Blog Posts</h1>
			
			<?php foreach ($posts as $post): ?>
			<div class="col-lg-8 mx-auto text-center blog-item">
				<h3><?php echo $post->title; ?></h3>
				<p><?php echo $post->description; ?></p>
			</div>
			<?php endforeach ?>
			<div class="col-lg-8 mx-auto text-center">
				<nav aria-label="Page navigation example">
				  <ul class="pagination">
				    <?php echo $links; ?>
				  </ul>
				</nav>
			</div>
		</div>
	</div>
	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<p class="copyright">© Your Website 2018. All Rights Reserved.</p>
				</div>
				<div class="col-lg-4 text-lg-right">
					<ul class="mm-icon">
						<li><a href="#"><i class="fab fa-facebook fa-2x fa-fw"></i></a></li>
						<li><a href="#"><i class="fab fa-twitter-square fa-2x fa-fw"></i></a></li>
						<li><a href="#"><i class="fab fa-instagram fa-2x fa-fw"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
</body>
