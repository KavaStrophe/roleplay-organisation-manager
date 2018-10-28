<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Implication $implication
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Implications'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Investigations'), ['controller' => 'Investigations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Investigation'), ['controller' => 'Investigations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="implications form large-9 medium-8 columns content">
    <?= $this->Form->create($implication) ?>
    <fieldset>
        <legend><?= __('Add Implication') ?></legend>
        <?php
            echo $this->Form->control('Role_Implication');
            echo $this->Form->control('investigations_id', ['options' => $investigations]);
            echo $this->Form->control('characters_id', ['options' => $characters]);
            echo $this->Form->control('Note_Implication');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
