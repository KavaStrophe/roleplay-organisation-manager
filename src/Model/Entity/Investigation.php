<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Investigation Entity
 *
 * @property int $id
 * @property string $State_Investigation
 * @property string $Resume_Investigation
 * @property string $Label_Investigation
 * @property string $Title_Investigation
 * @property string $Ending_Investigation
 *
 * @property \App\Model\Entity\Law[] $laws
 */
class Investigation extends Entity
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
        'State_Investigation' => true,
        'Resume_Investigation' => true,
        'Label_Investigation' => true,
        'Title_Investigation' => true,
        'Ending_Investigation' => true,
        'laws' => true
    ];
}
