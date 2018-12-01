 <?php
	$this->load->view('templates/header');
?>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>" class="breadcrumb-item">Accueil</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url('articles'); ?>" class="breadcrumb-item">Articles</a></li>
        <li class="breadcrumb-item active"><?php echo $articles_item['title'] ?></li>
	</ol>
</nav>

<div class="col-md-8 offset-md-2 article-box">
    <p>
        <?php
            echo '<i class="fa fa-user"></i> '. $author['username'];
        ?>
	</p>
	<hr />
    <?php

        echo '<h2>'.$articles_item['title'].'</h2>';
        echo '<p>'.$articles_item['content'].'</p>';
        echo '<hr />';
    ?>

   <!-- <?php	foreach ($comments as $comment): ?>

				<a href="<?php echo base_url().'user/view/'.$comment['user_id']; ?>" class="deco-none">
					<?php echo $comment['username']; ?>
				</a>
				<p>
					<?php echo $comment['content']; ?>
				</p>
				<p>
					<?php echo $comment['pos'] - $comment['neg']; ?> points.
				</p>
		
   <?php endforeach; ?> -->

</div>

 <?php
	$this->load->view('templates/footer');
?>