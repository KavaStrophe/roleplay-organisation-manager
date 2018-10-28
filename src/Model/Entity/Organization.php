<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Organization Entity
 *
 * @property int $id
 * @property int $users_id
 * @property string $Name_Organization
 * @property string $Nickname_Organization
 * @property string $Origin_Organization
 * @property string $Resume_Organization
 * @property int $Effective_Organization
 * @property int $Finances_Organization
 * @property string $Activities_Organization
 * @property string $Img_Organization
 * @property string $Link_Organization
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Constitution[] $constitutions
 */
class Organization extends Entity
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
        'users_id' => true,
        'Name_Organization' => true,
        'Nickname_Organization' => true,
        'Origin_Organization' => true,
        'Resume_Organization' => true,
        'Effective_Organization' => true,
        'Finances_Organization' => true,
        'Activities_Organization' => true,
        'Img_Organization' => true,
        'Link_Organization' => true,
        'user' => true,
        'constitutions' => true
    ];
}
