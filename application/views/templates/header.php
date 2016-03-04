<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Biblioteca</title>
	<?php if ($connesso) : ?>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css">
	<?php else : ?>
	<link href="<?php echo site_url('css/dist/bootstrap.min.css'); ?>" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo site_url("css/dist/font-awesome.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo site_url('css/dist/jquery-ui.css'); ?>">
	<?php endif ?>
	<link href="<?php echo site_url("css/sweetalert.css"); ?>" rel="stylesheet">
	<link href="<?php echo site_url('css/tablesorter.css'); ?>" rel="stylesheet">
	<link href="<?php echo site_url('css/stile.css'); ?>" rel="stylesheet">
</head>

<body>
