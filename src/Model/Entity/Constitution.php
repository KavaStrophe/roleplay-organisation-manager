<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Constitution Entity
 *
 * @property int $id
 * @property string $Name_Constitution
 * @property string $Desc_Constitution
 * @property string $Intro_Constitution
 * @property int $users_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Organization $organization
 */
class Constitution extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'Name_Constitution' => true,
        'Desc_Constitution' => true,
        'Intro_Constitution' => true,
        'users_id' => true,
        'user' => true,
        'organization' => true
    ];
}
