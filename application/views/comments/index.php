<h2 class="title"><?php echo $title; ?></h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Library</li>
	</ol>
</nav>

<div class="table-responsive tableau col-md-10 offset-md-1">

    <p>Il y a actuellement <?php echo count($comments); ?> commentaires.</p>

    <table class="border table-striped col-md-12">
        <thead>
            <tr>
                <td>
                    <h4>Pseudo</h4>
                </td>
                <td>
                    <h4>Message</h4>
                </td>
                <td>
                    <h4>Date</h4>
                </td>
				<td>
					<h4 class="center">Action</h4>
       		    </tr>
        </thead>
        <tbody>
        <?php foreach ($comments as $comments_item): ?>
        <tr>
            <td>
               <h6>
                   <?php echo $comments_item['pseudo']; ?>
                </h6>
            </td>
            <td>
                <p>
                    <?php echo $comments_item['message']; ?>
                </p>
            </td>
            <td>
                <p>
                    <?php echo $comments_item['date']; ?>
                </p>
			</td>
			<td>
				<a href="<?php echo base_url() ?>comments/view/<?php echo $comments_item['id']; ?>" class="btn btn-primary custom">Voir</a>
			</td>
			<td>
				<a href="<?php echo base_url() ?>comments/update/<?php echo $comments_item['id']; ?>" class="btn btn-info custom">Modifier</a>
			</td>
			<td>
				<a href="<?php echo base_url() ?>comments/delete/<?php echo $comments_item['id']; ?>" class="btn btn-danger custom">Supprimer</a>
			</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>
