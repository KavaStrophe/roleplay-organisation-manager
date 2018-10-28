<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Investigation $investigation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Investigations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Laws'), ['controller' => 'Laws', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Law'), ['controller' => 'Laws', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="investigations form large-9 medium-8 columns content">
    <?= $this->Form->create($investigation) ?>
    <fieldset>
        <legend><?= __('Add Investigation') ?></legend>
        <?php
            echo $this->Form->control('State_Investigation');
            echo $this->Form->control('Resume_Investigation');
            echo $this->Form->control('Label_Investigation');
            echo $this->Form->control('Title_Investigation');
            echo $this->Form->control('Ending_Investigation');
            echo $this->Form->control('laws._ids', ['options' => $laws]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
