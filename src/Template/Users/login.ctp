<div class="users form">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __("Connexion") ?></legend>
        <?= $this->Form->control('Login_User', [
            'label' => 'Nom de compte',
            'required' => 'required'
        ]) ?>
        <?= $this->Form->control('Password_User', [
            'type' => 'password',
            'label' => 'Mot de passe',
            'required' => 'required'
        ]) ?>
        <?= $this->Form->label('Remember_User', 'Se souvenir de moi'); ?>
        <?=  $this->Form->checkbox('Remember_User', [
                'id' => "remember-user"
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Se Connecter')); ?>
    <?= $this->Form->end() ?> 
</div> 