<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Investigation $investigation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Investigation'), ['action' => 'edit', $investigation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Investigation'), ['action' => 'delete', $investigation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $investigation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Investigations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Investigation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Laws'), ['controller' => 'Laws', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Law'), ['controller' => 'Laws', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="investigations view large-9 medium-8 columns content">
    <h3><?= h($investigation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('State Investigation') ?></th>
            <td><?= h($investigation->State_Investigation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Label Investigation') ?></th>
            <td><?= h($investigation->Label_Investigation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title Investigation') ?></th>
            <td><?= h($investigation->Title_Investigation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($investigation->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Resume Investigation') ?></h4>
        <?= $this->Text->autoParagraph(h($investigation->Resume_Investigation)); ?>
    </div>
    <div class="row">
        <h4><?= __('Ending Investigation') ?></h4>
        <?= $this->Text->autoParagraph(h($investigation->Ending_Investigation)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Laws') ?></h4>
        <?php if (!empty($investigation->laws)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Constitutions Id') ?></th>
                <th scope="col"><?= __('Name Law') ?></th>
                <th scope="col"><?= __('Content Law') ?></th>
                <th scope="col"><?= __('Sentence Law') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($investigation->laws as $laws): ?>
            <tr>
                <td><?= h($laws->id) ?></td>
                <td><?= h($laws->constitutions_id) ?></td>
                <td><?= h($laws->Name_Law) ?></td>
                <td><?= h($laws->Content_Law) ?></td>
                <td><?= h($laws->Sentence_Law) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Laws', 'action' => 'view', $laws->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Laws', 'action' => 'edit', $laws->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Laws', 'action' => 'delete', $laws->id], ['confirm' => __('Are you sure you want to delete # {0}?', $laws->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
