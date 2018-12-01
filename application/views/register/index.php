<form action='<?php echo base_url();?>register/process' method='post' name='process'>
    <div id="register-box" class="col-md-4 offset-md-4">
		<h2 class="title"><?php echo $title; ?></h2><br />

        <label for="email">Adresse email</label>
	    <input type="input" name="email" type="email" class="form-control">
		<br />
		
        <label for="username">Nom d'utilisateur</label>
        <input type="input" name="username" type="text" class="form-control">
		<br />

        <label for="password">Mot de passe</label>
		<input name="password" class="form-control" type="password">
		<br />

		<label for="password-confirm">Confirmer le mot de passe</label>
		<input name="password-confirm" class="form-control" type="password">

        <br />

		<input class="btn btn-primary col-md-4 offset-md-4" type="submit" name="submit" value="Inscription" />

 	</div>
</form>