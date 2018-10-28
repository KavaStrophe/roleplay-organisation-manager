<header class="row">
	<div class="col-xs-6">
		<h1>Nulboroth Toolbox</h1>
	</div>
	<div class="col-xs-offset-2 col-xs-4 header-buttons">
		<?php if(isset($user) && isset($user['id'])):?>
			<a class="button-header" title="Réglages utilisateur" href="/users/edit/<?= $user['id']?>">
				<i class="fa fa-cog" aria-hidden="true"></i>
			</a>
			<a class="button-header" title="Déconnexion" href="/users/logout">
				<i class="fa fa-sign-out" aria-hidden="true"></i>
			</a>
		<?php else:?>
			<a class="button-header" title="S'inscrire" href="/users/add">
				<i class="fa fa-user-plus" aria-hidden="true"></i>
			</a>
			<a class="button-header" title="Connexion" href="/users/login">
				<i class="fa fa-sign-in" aria-hidden="true"></i>
			</a>
		<?php endif;?>
	</div>
</header>