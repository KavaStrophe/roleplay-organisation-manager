<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Constitution[]|\Cake\Collection\CollectionInterface $constitutions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Constitution'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Organizations'), ['controller' => 'Organizations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organizations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="constitutions index large-9 medium-8 columns content">
    <h3><?= __('Constitutions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Name_Constitution') ?></th>
                <th scope="col"><?= $this->Paginator->sort('users_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('organization_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($constitutions as $constitution): ?>
            <tr>
                <td><?= $this->Number->format($constitution->id) ?></td>
                <td><?= h($constitution->Name_Constitution) ?></td>
                <td><?= $constitution->has('user') ? $this->Html->link($constitution->user->id, ['controller' => 'Users', 'action' => 'view', $constitution->user->id]) : '' ?></td>
                <td><?= $constitution->has('organization') ? $this->Html->link($constitution->organization->id, ['controller' => 'Organizations', 'action' => 'view', $constitution->organization->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $constitution->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $constitution->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $constitution->id], ['confirm' => __('Are you sure you want to delete # {0}?', $constitution->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
