<div class="users form large-9 medium-8 columns content">
     <?= $this->Form->create($userCurrent) ?>
    <fieldset>
        <legend><?= __('Changement de mot de passe') ?></legend>
        <?php
            echo $this->Form->control('New_Password_User_Pass', [
                'type' => 'password',
                'label' => 'Nouveau mot de passe',
                'required' => 'required'
            ]);
            echo $this->Form->control('New_Password_User_Confirm_Pass', [
                'type' => 'password',
                'label' => 'Confirmer le mot de passe',
                'required' => 'required'
            ]);
            echo $this->Form->hidden('Edit_Type', [
                'value' => 'recordPassword'
            ])
        ?>
        <?= $this->Form->button(__('Envoyer'), [
            'id' => 'recordPassword'
        ]) ?>
    </fieldset>
    <?= $this->Form->end() ?> 
</div>

<script>
$(document).ready(function(){
	$('#recordPassword').on('click', function(){
		mdp = $('#new-password-user-pass').val();
		mdpConfirm = $('#new-password-user-confirm-pass').val();

		if(mdp != mdpConfirm)
		{
			event.preventDefault();
			inputError('#new-password-user-confirm-pass');
			inputError('#new-password-user-pass');
			
			swal({
				type:"error",
				title:"Erreur !",
				html: "Les deux mots de passe ne correspondent pas !"
			})
		}
	});
});
</script>
            