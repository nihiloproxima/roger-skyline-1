<div id="group_menu" class="col-md-3 float-right">

<form action='<?php echo base_url();?>articles/' method='post' name='index'>

	<div>
		<div class="article-box">
			<h4>Publier un article</h4>
			<label for="title">Titre</label>
			<input type="input" name="title" type="text" class="form-control">
			<br />

			<label for="content">Contenu</label>
			<textarea name="content" class="form-control" type="text" row=7></textarea>
			<br />
			
			<input class="btn btn-primary" type="submit" name="submit" value="Publier" />

		</div>
	</div>
</form>
</div>