<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Wanted $wanted
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Wanteds'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Organizations'), ['controller' => 'Organizations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organizations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Investigations'), ['controller' => 'Investigations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Investigation'), ['controller' => 'Investigations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="wanteds form large-9 medium-8 columns content">
    <?= $this->Form->create($wanted) ?>
    <fieldset>
        <legend><?= __('Add Wanted') ?></legend>
        <?php
            echo $this->Form->control('DeadOrAlive_Wanted');
            echo $this->Form->control('Gift_Wanted');
            echo $this->Form->control('Details_Wanted');
            echo $this->Form->control('Img_Wanted');
            echo $this->Form->control('Link_Wanted');
            echo $this->Form->control('characters_id');
            echo $this->Form->control('organizations_id', ['options' => $organizations, 'empty' => true]);
            echo $this->Form->control('investigations_id', ['options' => $investigations, 'empty' => true]);
            echo $this->Form->control('characters._ids', ['options' => $characters]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
