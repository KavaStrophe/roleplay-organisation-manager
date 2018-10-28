<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organization $organization
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $organization->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $organization->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Organizations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characters Organizations Rights'), ['controller' => 'CharactersOrganizationsRights', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characters Organizations Right'), ['controller' => 'CharactersOrganizationsRights', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Constitutions'), ['controller' => 'Constitutions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Constitution'), ['controller' => 'Constitutions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="organizations form large-9 medium-8 columns content">
    <?= $this->Form->create($organization) ?>
    <fieldset>
        <legend><?= __('Edit Organization') ?></legend>
        <?php
            echo $this->Form->control('users_id', ['options' => $users]);
            echo $this->Form->control('Name_Organization');
            echo $this->Form->control('Nickname_Organization');
            echo $this->Form->control('Origin_Organization');
            echo $this->Form->control('Resume_Organization');
            echo $this->Form->control('Effective_Organization');
            echo $this->Form->control('Finances_Organization');
            echo $this->Form->control('Activities_Organization');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
