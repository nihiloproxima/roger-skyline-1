<html>

<head>
	<title><?php echo $title ?></title>
    
 <!-- Required meta tags -->
 	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css"/>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <a class="navbar-brand" href="<?php echo base_url(); ?>">
  <img src="<?php echo base_url(); ?>assets/favicon.png" width="30" height="30" class="d-inline-block align-top" alt="">Roger Skyline</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav col-md-2 offset-md-10">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle my-2 my-lg-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Menu
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo base_url('user'); ?>">Profil</a>
          <a class="dropdown-item" href="<?php echo base_url('user/account'); ?>">Mon compte</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Déconnexion</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

   	<div class="main">