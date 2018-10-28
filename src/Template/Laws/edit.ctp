<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Law $law
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $law->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $law->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Laws'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Constitutions'), ['controller' => 'Constitutions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Constitution'), ['controller' => 'Constitutions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Investigations'), ['controller' => 'Investigations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Investigation'), ['controller' => 'Investigations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="laws form large-9 medium-8 columns content">
    <?= $this->Form->create($law) ?>
    <fieldset>
        <legend><?= __('Edit Law') ?></legend>
        <?php
            echo $this->Form->control('constitutions_id', ['options' => $constitutions]);
            echo $this->Form->control('Name_Law');
            echo $this->Form->control('Content_Law');
            echo $this->Form->control('Sentence_Law');
            echo $this->Form->control('investigations._ids', ['options' => $investigations]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
