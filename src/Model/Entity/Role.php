<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Role Entity
 *
 * @property int $id
 * @property int $organizations_id
 * @property string $Name_Role
 * @property string $Desc_Role
 * @property int $roles_id
 *
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\Character[] $characters
 */
class Role extends Entity
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
        'organizations_id' => true,
        'Name_Role' => true,
        'Desc_Role' => true,
        'roles_id' => true,
        'organization' => true,
        'characters' => true
    ];
}
