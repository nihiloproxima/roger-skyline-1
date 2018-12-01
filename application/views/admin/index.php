<div class="col-md-4 offset-md-4 white-box">
		<h2 class="title"><?php echo $title; ?></h2><br />

		<p>Bonjour <?php echo $this->session->username ?></p>
		
		<a href="<?php echo base_url('articles/delete_all') ?>" class="btn btn-primary">Supprimer tous les articles</a>

</div>