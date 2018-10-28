<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organization[]|\Cake\Collection\CollectionInterface $organizations
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Organization'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characters Organizations Rights'), ['controller' => 'CharactersOrganizationsRights', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characters Organizations Right'), ['controller' => 'CharactersOrganizationsRights', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Constitutions'), ['controller' => 'Constitutions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Constitution'), ['controller' => 'Constitutions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="organizations index large-9 medium-8 columns content">
    <h3><?= __('Organizations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('users_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Name_Organization') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Nickname_Organization') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Origin_Organization') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Effective_Organization') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Finances_Organization') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($organizations as $organization): ?>
            <tr>
                <td><?= $this->Number->format($organization->id) ?></td>
                <td><?= $organization->has('user') ? $this->Html->link($organization->user->id, ['controller' => 'Users', 'action' => 'view', $organization->user->id]) : '' ?></td>
                <td><?= h($organization->Name_Organization) ?></td>
                <td><?= h($organization->Nickname_Organization) ?></td>
                <td><?= h($organization->Origin_Organization) ?></td>
                <td><?= $this->Number->format($organization->Effective_Organization) ?></td>
                <td><?= $this->Number->format($organization->Finances_Organization) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $organization->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $organization->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $organization->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organization->id)]) ?>
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
