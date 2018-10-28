<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nulboroth Toolbox</title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->meta('utf8') ?>

    <?= $this->Html->css('bootstrap') ?>
    <?= $this->Html->css('fa') ?>
    <?= $this->Html->css('sw2') ?>
    <?= $this->Html->css('jquery-ui') ?>
    <?= $this->Html->css('main') ?>
    
    <?= $this->Html->script('jquery') ?>
    <?= $this->Html->script('bootstrap') ?>
    <?= $this->Html->script('sw2') ?>
    <?= $this->Html->script('dynamitable') ?>
    <?= $this->Html->script('main') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
	<?= $this->element('site_header') ?>
	<?php 
	if(isset($user) && isset($user['id']))
	       echo $this->element('site_navbar') 
	?>
    <?= $this->Flash->render() ?>
	<div class="row content">
		<div class=" col-xs-offset-0 col-xs-12  col-sm-offset-0 col-sm-12  col-md-offset-1 col-md-10 col-lg-offset-3 col-lg-6">
   			<?= $this->fetch('content') ?>
		</div>
	<div class="row">
    
</body>
<script>
$(document).ready(function(){
	$('h1').on('click', function(){
		window.location = "/";
	});
});
</script>
</html>
