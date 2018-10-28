<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users form large-9 medium-8 columns">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Inscription') ?></legend>
        <?php
            echo $this->Form->control('Login_User', [
                'label' => 'Nom de compte'
            ]);
            echo $this->Form->control('Password_User', [
                'label' => 'Mot de passe',
                'type' => 'password'
            ]);
            echo $this->Form->control('Password_User_Confirm', [
                'label' => 'Confirmer le mot de passe',
                'type' => 'password'
            ]);
        ?>
    </fieldset>
        <?= $this->Form->button(__('Envoyer'), [
            'id' => 'record'
        ]) ?>
    <?= $this->Form->end() ?>
</div>
<script>
$(document).ready(function(){
	$('#record').on('click', function(){
		mdp = $('#password-user').val();
		mdpConfirm = $('#password-user-confirm').val();

		if(mdp != mdpConfirm)
		{
			event.preventDefault();
			swal({
				type:"error",
				title:"Erreur !",
				html: "Les deux mots de passe ne correspondent pas !"
			})
		}
	});
});
</script>