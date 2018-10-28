<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Constitution $constitution
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Constitution'), ['action' => 'edit', $constitution->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Constitution'), ['action' => 'delete', $constitution->id], ['confirm' => __('Are you sure you want to delete # {0}?', $constitution->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Constitutions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Constitution'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Organizations'), ['controller' => 'Organizations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organizations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="constitutions view large-9 medium-8 columns content">
    <h3><?= h($constitution->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name Constitution') ?></th>
            <td><?= h($constitution->Name_Constitution) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $constitution->has('user') ? $this->Html->link($constitution->user->id, ['controller' => 'Users', 'action' => 'view', $constitution->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Organization') ?></th>
            <td><?= $constitution->has('organization') ? $this->Html->link($constitution->organization->id, ['controller' => 'Organizations', 'action' => 'view', $constitution->organization->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($constitution->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Desc Constitution') ?></h4>
        <?= $this->Text->autoParagraph(h($constitution->Desc_Constitution)); ?>
    </div>
    <div class="row">
        <h4><?= __('Intro Constitution') ?></h4>
        <?= $this->Text->autoParagraph(h($constitution->Intro_Constitution)); ?>
    </div>
</div>
