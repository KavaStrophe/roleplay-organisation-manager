<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organization $organization
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Organization'), ['action' => 'edit', $organization->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Organization'), ['action' => 'delete', $organization->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organization->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Organizations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organization'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characters Organizations Rights'), ['controller' => 'CharactersOrganizationsRights', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characters Organizations Right'), ['controller' => 'CharactersOrganizationsRights', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Constitutions'), ['controller' => 'Constitutions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Constitution'), ['controller' => 'Constitutions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="organizations view large-9 medium-8 columns content">
    <h3><?= h($organization->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $organization->has('user') ? $this->Html->link($organization->user->id, ['controller' => 'Users', 'action' => 'view', $organization->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name Organization') ?></th>
            <td><?= h($organization->Name_Organization) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nickname Organization') ?></th>
            <td><?= h($organization->Nickname_Organization) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Origin Organization') ?></th>
            <td><?= h($organization->Origin_Organization) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($organization->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Effective Organization') ?></th>
            <td><?= $this->Number->format($organization->Effective_Organization) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Finances Organization') ?></th>
            <td><?= $this->Number->format($organization->Finances_Organization) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Resume Organization') ?></h4>
        <?= $this->Text->autoParagraph(h($organization->Resume_Organization)); ?>
    </div>
    <div class="row">
        <h4><?= __('Activities Organization') ?></h4>
        <?= $this->Text->autoParagraph(h($organization->Activities_Organization)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Characters Organizations Rights') ?></h4>
        <?php if (!empty($organization->characters_organizations_rights)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Character Id') ?></th>
                <th scope="col"><?= __('Organization Id') ?></th>
                <th scope="col"><?= __('Rights') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($organization->characters_organizations_rights as $charactersOrganizationsRights): ?>
            <tr>
                <td><?= h($charactersOrganizationsRights->character_id) ?></td>
                <td><?= h($charactersOrganizationsRights->organization_id) ?></td>
                <td><?= h($charactersOrganizationsRights->rights) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CharactersOrganizationsRights', 'action' => 'view', $charactersOrganizationsRights->character_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CharactersOrganizationsRights', 'action' => 'edit', $charactersOrganizationsRights->character_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CharactersOrganizationsRights', 'action' => 'delete', $charactersOrganizationsRights->character_id], ['confirm' => __('Are you sure you want to delete # {0}?', $charactersOrganizationsRights->character_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Constitutions') ?></h4>
        <?php if (!empty($organization->constitutions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name Constitution') ?></th>
                <th scope="col"><?= __('Desc Constitution') ?></th>
                <th scope="col"><?= __('Intro Constitution') ?></th>
                <th scope="col"><?= __('Users Id') ?></th>
                <th scope="col"><?= __('Organization Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($organization->constitutions as $constitutions): ?>
            <tr>
                <td><?= h($constitutions->id) ?></td>
                <td><?= h($constitutions->Name_Constitution) ?></td>
                <td><?= h($constitutions->Desc_Constitution) ?></td>
                <td><?= h($constitutions->Intro_Constitution) ?></td>
                <td><?= h($constitutions->users_id) ?></td>
                <td><?= h($constitutions->organization_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Constitutions', 'action' => 'view', $constitutions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Constitutions', 'action' => 'edit', $constitutions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Constitutions', 'action' => 'delete', $constitutions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $constitutions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
