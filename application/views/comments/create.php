<?php echo validation_errors(); ?>

<?php echo form_open('comments/new'); ?>
    <div id="form-new-comment" class="col-md-8 offset-md-2 white-box">

        <h2 class="title"><?php echo $title; ?></h2><br />

        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Pseudo</span>
        </div>
        <input type="input" name="pseudo"class="form-control">
        </div>

        <div class="input-group">
		<textarea name="message" class="form-control" aria-label="With textarea" row="7"></textarea>
		<div class="input-group-prepend">
            <span class="input-group-text">Message</span>
        </div>
        </div>
        <br />
        <div class="col-md-2 offset-md-5"> 
           <input class="btn btn-primary" type="submit" name="submit" value="Envoyer un commentaire" />
        </div>
    </div>
</form>

