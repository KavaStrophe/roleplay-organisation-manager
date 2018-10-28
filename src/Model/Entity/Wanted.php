<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Wanted Entity
 *
 * @property int $id
 * @property bool $DeadOrAlive_Wanted
 * @property string $Gift_Wanted
 * @property string $Details_Wanted
 * @property string $Img_Wanted
 * @property string $Link_Wanted
 * @property int $characters_id
 * @property int $organizations_id
 * @property int $investigations_id
 *
 * @property \App\Model\Entity\Character[] $characters
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\Investigation $investigation
 */
class Wanted extends Entity
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
        'DeadOrAlive_Wanted' => true,
        'Gift_Wanted' => true,
        'Details_Wanted' => true,
        'Img_Wanted' => true,
        'Link_Wanted' => true,
        'characters_id' => true,
        'organizations_id' => true,
        'investigations_id' => true,
        'characters' => true,
        'organization' => true,
        'investigation' => true
    ];
}
