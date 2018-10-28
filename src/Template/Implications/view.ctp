<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Implication $implication
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Implication'), ['action' => 'edit', $implication->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Implication'), ['action' => 'delete', $implication->id], ['confirm' => __('Are you sure you want to delete # {0}?', $implication->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Implications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Implication'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Investigations'), ['controller' => 'Investigations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Investigation'), ['controller' => 'Investigations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="implications view large-9 medium-8 columns content">
    <h3><?= h($implication->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Role Implication') ?></th>
            <td><?= h($implication->Role_Implication) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Investigation') ?></th>
            <td><?= $implication->has('investigation') ? $this->Html->link($implication->investigation->id, ['controller' => 'Investigations', 'action' => 'view', $implication->investigation->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Character') ?></th>
            <td><?= $implication->has('character') ? $this->Html->link($implication->character->id, ['controller' => 'Characters', 'action' => 'view', $implication->character->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($implication->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Note Implication') ?></h4>
        <?= $this->Text->autoParagraph(h($implication->Note_Implication)); ?>
    </div>
</div>
