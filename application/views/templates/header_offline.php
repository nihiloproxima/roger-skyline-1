<html>

<head>
	<title><?php echo $title ?></title>
    
 <!-- Required meta tags -->
 	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <link rel="icon" href="<?=base_url()?>assets/favicon.png" type="image/gif">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/auth.css" type="text/css"/>
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
		<a class="navbar-brand" href="<?php echo base_url(); ?>">
		<img src="<?php echo base_url(); ?>assets/favicon.png" width="30" height="30" class="d-inline-block align-top" alt="">Roger Skyline</a>

		<ul id="row_display" class="offset-md-9 nav navbar-nav navbar-right">
			<span>
			<li class="white"><a href="<?php echo base_url(); ?>login" ><i class="fa fa-sign-in-alt"></i> Connexion</a></li>
			<li class="white"><a href="<?php echo base_url(); ?>register"><i class="fas fa-user"></i> Inscription</a></li>
			</span>

		</ul>
	</nav>

   	<div class="main">
