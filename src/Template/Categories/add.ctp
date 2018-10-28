<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Laws'), ['controller' => 'Laws', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Law'), ['controller' => 'Laws', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Constitutions'), ['controller' => 'Constitutions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Constitution'), ['controller' => 'Constitutions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="categories form large-9 medium-8 columns content">
    <?= $this->Form->create($category) ?>
    <fieldset>
        <legend><?= __('Add Category') ?></legend>
        <?php
            echo $this->Form->control('Label_Category');
            echo $this->Form->control('Resume_Category');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
