<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Law $law
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Law'), ['action' => 'edit', $law->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Law'), ['action' => 'delete', $law->id], ['confirm' => __('Are you sure you want to delete # {0}?', $law->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Laws'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Law'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Constitutions'), ['controller' => 'Constitutions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Constitution'), ['controller' => 'Constitutions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Investigations'), ['controller' => 'Investigations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Investigation'), ['controller' => 'Investigations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="laws view large-9 medium-8 columns content">
    <h3><?= h($law->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Constitution') ?></th>
            <td><?= $law->has('constitution') ? $this->Html->link($law->constitution->id, ['controller' => 'Constitutions', 'action' => 'view', $law->constitution->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name Law') ?></th>
            <td><?= h($law->Name_Law) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($law->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content Law') ?></h4>
        <?= $this->Text->autoParagraph(h($law->Content_Law)); ?>
    </div>
    <div class="row">
        <h4><?= __('Sentence Law') ?></h4>
        <?= $this->Text->autoParagraph(h($law->Sentence_Law)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Investigations') ?></h4>
        <?php if (!empty($law->investigations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('State Investigation') ?></th>
                <th scope="col"><?= __('Resume Investigation') ?></th>
                <th scope="col"><?= __('Label Investigation') ?></th>
                <th scope="col"><?= __('Title Investigation') ?></th>
                <th scope="col"><?= __('Ending Investigation') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($law->investigations as $investigations): ?>
            <tr>
                <td><?= h($investigations->id) ?></td>
                <td><?= h($investigations->State_Investigation) ?></td>
                <td><?= h($investigations->Resume_Investigation) ?></td>
                <td><?= h($investigations->Label_Investigation) ?></td>
                <td><?= h($investigations->Title_Investigation) ?></td>
                <td><?= h($investigations->Ending_Investigation) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Investigations', 'action' => 'view', $investigations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Investigations', 'action' => 'edit', $investigations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Investigations', 'action' => 'delete', $investigations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $investigations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
