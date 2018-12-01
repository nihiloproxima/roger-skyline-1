<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">Accueil</li>
        <li class="breadcrumb-item active">Articles</li>
	</ol>
</nav>

<?php $this->load->view('articles/new') ?>

<?php foreach ($articles as $articles_item): ?>

	<div class="col-md-7 offset-md-2 article-box">
		<p>
			<?php
				$pseudo = $this->db->where('id', $articles_item['user_id'])
									->from('Users')
									->get();
				$pseudo = $pseudo->row_array();
				echo '<i class="fa fa-user"></i> '. $pseudo['username'];
			?>
		</p>
		<hr />
		<a href="<?php echo base_url('articles/view'); ?>/<?php echo $articles_item['id'] ?>" class="deco-none"><h4><?php echo $articles_item['title'] ?></h4></a>
		<p><?php echo $articles_item['content'] ?></p>
		<span>
			<p><a href="<?php echo base_url('articles/view'); ?>/<?php echo $articles_item['id'] ?>" class="box_link"><?php 
				echo $articles_item['pos'] - $articles_item['neg']
			?> points.</a>
			<a href="<?php echo base_url('articles/view'); ?>/<?php echo $articles_item['id'] ?>" class="box_link">
			<?php 
				echo $this->db->where('article_id', $articles_item['id'])
								->get('Comments')
								->num_rows();
			?> commentaires.</a></p>
		</span>
	</div><br />

<?php endforeach; ?>
