<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $categories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Category'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Laws'), ['controller' => 'Laws', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Law'), ['controller' => 'Laws', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Constitutions'), ['controller' => 'Constitutions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Constitution'), ['controller' => 'Constitutions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="categories index large-9 medium-8 columns content">
    <h3><?= __('Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('laws_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('constitutions_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Number_category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Label_Category') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
            <tr>
                <td><?= $category->has('law') ? $this->Html->link($category->law->id, ['controller' => 'Laws', 'action' => 'view', $category->law->id]) : '' ?></td>
                <td><?= $category->has('constitution') ? $this->Html->link($category->constitution->id, ['controller' => 'Constitutions', 'action' => 'view', $category->constitution->id]) : '' ?></td>
                <td><?= $this->Number->format($category->Number_category) ?></td>
                <td><?= h($category->Label_Category) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $category->laws_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $category->laws_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $category->laws_id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->laws_id)]) ?>
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
