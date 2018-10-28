<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Constitution $constitution
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Constitutions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Organizations'), ['controller' => 'Organizations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organizations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="constitutions form large-9 medium-8 columns content">
    <?= $this->Form->create($constitution) ?>
    <fieldset>
        <legend><?= __('Add Constitution') ?></legend>
        <?php
            echo $this->Form->control('Name_Constitution');
            echo $this->Form->control('Desc_Constitution');
            echo $this->Form->control('Intro_Constitution');
            echo $this->Form->control('users_id', ['options' => $users]);
            echo $this->Form->control('organization_id', ['options' => $organizations, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
