<div class="col-md-8 offset-md-2 white-box">

    <h2 class="title"><?php echo $title ?></h2>

    <img class="rounded col-md-2 offset-md-1" src="https://www.qualiscare.com/wp-content/uploads/2017/08/default-user.png" alt="profil_pic"/>
	<h4 class=" col-md-2 offset-md-1 text-center"><?php echo $this->session->username ?></h4>
</div>

<h3 class="offset-md-1">Articles de <?php echo $this->session->usermame ?></h3>

<?php if (! empty($articles)) { foreach ($articles as $articles_item): ?>

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

<?php endforeach; }?>