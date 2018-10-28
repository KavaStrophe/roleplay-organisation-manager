<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Role'), ['action' => 'edit', $role->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Role'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Organizations'), ['controller' => 'Organizations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organizations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="roles view large-9 medium-8 columns content">
    <h3><?= h($role->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Organization') ?></th>
            <td><?= $role->has('organization') ? $this->Html->link($role->organization->id, ['controller' => 'Organizations', 'action' => 'view', $role->organization->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name Role') ?></th>
            <td><?= h($role->Name_Role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($role->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Desc Role') ?></h4>
        <?= $this->Text->autoParagraph(h($role->Desc_Role)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Characters') ?></h4>
        <?php if (!empty($role->characters)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('FirstName Character') ?></th>
                <th scope="col"><?= __('Old Character') ?></th>
                <th scope="col"><?= __('LastName Character') ?></th>
                <th scope="col"><?= __('Gender Character') ?></th>
                <th scope="col"><?= __('Origin Character') ?></th>
                <th scope="col"><?= __('Race Character') ?></th>
                <th scope="col"><?= __('Address Character') ?></th>
                <th scope="col"><?= __('Religion Character') ?></th>
                <th scope="col"><?= __('ColorHair Character') ?></th>
                <th scope="col"><?= __('ColorEyes Character') ?></th>
                <th scope="col"><?= __('ColorSkin Character') ?></th>
                <th scope="col"><?= __('Job Character') ?></th>
                <th scope="col"><?= __('Class Character') ?></th>
                <th scope="col"><?= __('Height Character') ?></th>
                <th scope="col"><?= __('Weight Character') ?></th>
                <th scope="col"><?= __('Img Character') ?></th>
                <th scope="col"><?= __('Users Id') ?></th>
                <th scope="col"><?= __('PNJ Character') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($role->characters as $characters): ?>
            <tr>
                <td><?= h($characters->id) ?></td>
                <td><?= h($characters->FirstName_Character) ?></td>
                <td><?= h($characters->Old_Character) ?></td>
                <td><?= h($characters->LastName_Character) ?></td>
                <td><?= h($characters->Gender_Character) ?></td>
                <td><?= h($characters->Origin_Character) ?></td>
                <td><?= h($characters->Race_Character) ?></td>
                <td><?= h($characters->Address_Character) ?></td>
                <td><?= h($characters->Religion_Character) ?></td>
                <td><?= h($characters->ColorHair_Character) ?></td>
                <td><?= h($characters->ColorEyes_Character) ?></td>
                <td><?= h($characters->ColorSkin_Character) ?></td>
                <td><?= h($characters->Job_Character) ?></td>
                <td><?= h($characters->Class_Character) ?></td>
                <td><?= h($characters->Height_Character) ?></td>
                <td><?= h($characters->Weight_Character) ?></td>
                <td><?= h($characters->Img_Character) ?></td>
                <td><?= h($characters->users_id) ?></td>
                <td><?= h($characters->PNJ_Character) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Characters', 'action' => 'view', $characters->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Characters', 'action' => 'edit', $characters->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Characters', 'action' => 'delete', $characters->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characters->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
