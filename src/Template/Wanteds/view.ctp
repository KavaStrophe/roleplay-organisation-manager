<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Wanted $wanted
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Wanted'), ['action' => 'edit', $wanted->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Wanted'), ['action' => 'delete', $wanted->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wanted->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Wanteds'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wanted'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Organizations'), ['controller' => 'Organizations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organizations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Investigations'), ['controller' => 'Investigations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Investigation'), ['controller' => 'Investigations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="wanteds view large-9 medium-8 columns content">
    <h3><?= h($wanted->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Img Wanted') ?></th>
            <td><?= h($wanted->Img_Wanted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Link Wanted') ?></th>
            <td><?= h($wanted->Link_Wanted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Organization') ?></th>
            <td><?= $wanted->has('organization') ? $this->Html->link($wanted->organization->id, ['controller' => 'Organizations', 'action' => 'view', $wanted->organization->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Investigation') ?></th>
            <td><?= $wanted->has('investigation') ? $this->Html->link($wanted->investigation->id, ['controller' => 'Investigations', 'action' => 'view', $wanted->investigation->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($wanted->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Characters Id') ?></th>
            <td><?= $this->Number->format($wanted->characters_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DeadOrAlive Wanted') ?></th>
            <td><?= $wanted->DeadOrAlive_Wanted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Gift Wanted') ?></h4>
        <?= $this->Text->autoParagraph(h($wanted->Gift_Wanted)); ?>
    </div>
    <div class="row">
        <h4><?= __('Details Wanted') ?></h4>
        <?= $this->Text->autoParagraph(h($wanted->Details_Wanted)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Characters') ?></h4>
        <?php if (!empty($wanted->characters)): ?>
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
                <th scope="col"><?= __('Resume Character') ?></th>
                <th scope="col"><?= __('Link Character') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($wanted->characters as $characters): ?>
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
                <td><?= h($characters->Resume_Character) ?></td>
                <td><?= h($characters->Link_Character) ?></td>
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
