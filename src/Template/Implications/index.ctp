<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Implication[]|\Cake\Collection\CollectionInterface $implications
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Implication'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Investigations'), ['controller' => 'Investigations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Investigation'), ['controller' => 'Investigations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="implications index large-9 medium-8 columns content">
    <h3><?= __('Implications') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Role_Implication') ?></th>
                <th scope="col"><?= $this->Paginator->sort('investigations_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('characters_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($implications as $implication): ?>
            <tr>
                <td><?= $this->Number->format($implication->id) ?></td>
                <td><?= h($implication->Role_Implication) ?></td>
                <td><?= $implication->has('investigation') ? $this->Html->link($implication->investigation->id, ['controller' => 'Investigations', 'action' => 'view', $implication->investigation->id]) : '' ?></td>
                <td><?= $implication->has('character') ? $this->Html->link($implication->character->id, ['controller' => 'Characters', 'action' => 'view', $implication->character->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $implication->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $implication->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $implication->id], ['confirm' => __('Are you sure you want to delete # {0}?', $implication->id)]) ?>
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
