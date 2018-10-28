<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->laws_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->laws_id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->laws_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Laws'), ['controller' => 'Laws', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Law'), ['controller' => 'Laws', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Constitutions'), ['controller' => 'Constitutions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Constitution'), ['controller' => 'Constitutions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="categories view large-9 medium-8 columns content">
    <h3><?= h($category->laws_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Law') ?></th>
            <td><?= $category->has('law') ? $this->Html->link($category->law->id, ['controller' => 'Laws', 'action' => 'view', $category->law->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Constitution') ?></th>
            <td><?= $category->has('constitution') ? $this->Html->link($category->constitution->id, ['controller' => 'Constitutions', 'action' => 'view', $category->constitution->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Label Category') ?></th>
            <td><?= h($category->Label_Category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number Category') ?></th>
            <td><?= $this->Number->format($category->Number_category) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Resume Category') ?></h4>
        <?= $this->Text->autoParagraph(h($category->Resume_Category)); ?>
    </div>
</div>
