<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Character $character
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $character->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $character->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Characters'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characters Organizations Rights'), ['controller' => 'CharactersOrganizationsRights', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characters Organizations Right'), ['controller' => 'CharactersOrganizationsRights', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="characters form large-9 medium-8 columns content">
    <?= $this->Form->create($character) ?>
    <fieldset>
        <legend><?= __('Edit Character') ?></legend>
        <?php
            echo $this->Form->control('FirstName_Character');
            echo $this->Form->control('Old_Character');
            echo $this->Form->control('LastName_Character');
            echo $this->Form->control('Gender_Character');
            echo $this->Form->control('Origin_Character');
            echo $this->Form->control('Race_Character');
            echo $this->Form->control('Address_Character');
            echo $this->Form->control('Religion_Character');
            echo $this->Form->control('ColorHair_Character');
            echo $this->Form->control('ColorEyes_Character');
            echo $this->Form->control('ColorSkin_Character');
            echo $this->Form->control('Job_Character');
            echo $this->Form->control('Class_Character');
            echo $this->Form->control('Height_Character');
            echo $this->Form->control('Weight_Character');
            echo $this->Form->control('Img_Character');
            echo $this->Form->control('users_id', ['options' => $users]);
            echo $this->Form->control('roles._ids', ['options' => $roles]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
