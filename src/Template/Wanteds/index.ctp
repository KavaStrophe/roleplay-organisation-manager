<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Wanted[]|\Cake\Collection\CollectionInterface $wanteds
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Wanted'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Organizations'), ['controller' => 'Organizations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organizations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Investigations'), ['controller' => 'Investigations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Investigation'), ['controller' => 'Investigations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="wanteds index large-9 medium-8 columns content">
    <h3><?= __('Wanteds') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DeadOrAlive_Wanted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Img_Wanted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Link_Wanted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('characters_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('organizations_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('investigations_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($wanteds as $wanted): ?>
            <tr>
                <td><?= $this->Number->format($wanted->id) ?></td>
                <td><?= h($wanted->DeadOrAlive_Wanted) ?></td>
                <td><?= h($wanted->Img_Wanted) ?></td>
                <td><?= h($wanted->Link_Wanted) ?></td>
                <td><?= $this->Number->format($wanted->characters_id) ?></td>
                <td><?= $wanted->has('organization') ? $this->Html->link($wanted->organization->id, ['controller' => 'Organizations', 'action' => 'view', $wanted->organization->id]) : '' ?></td>
                <td><?= $wanted->has('investigation') ? $this->Html->link($wanted->investigation->id, ['controller' => 'Investigations', 'action' => 'view', $wanted->investigation->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $wanted->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $wanted->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $wanted->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wanted->id)]) ?>
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
