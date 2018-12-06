<form action='<?php echo base_url();?>login/process' method='post' name='process'>
    <div id="login-box" class="col-md-4 offset-md-4">
		<h2 class="title"><?php echo $title; ?></h2><br />

        <?php if(! is_null($msg)) echo $msg;?>  
        <div class="input-group mb-3">
			
	        <div class="input-group-prepend">
	            <span class="input-group-text" id="basic-addon1">Addresse email</span>
	        </div>
	        <input type="input" name="email" type="email" class="form-control">
	    </div>

	        <div class="input-group">
				<div class="input-group-append">
		            <span class="input-group-text">Mot de passe</span>
		        </div>
				<input name="password" class="form-control" type="password">
	        </div>
	        <br />
	        <div>
				<span>Mot de passe <a href="#">oublié ?</a></span>
	        </div>
			<p><a href="<?php echo base_url('register');?>">Je n'ai pas de compte</a></p>

			<input class="btn btn-primary col-md-4 offset-md-4" type="submit" name="submit" value="Connexion" />
			<div>
				<?php
					echo $this->session->flashdata('error');
				?>
			</div>
 		</div>
    </div>
</form>