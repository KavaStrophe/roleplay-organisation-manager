<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Implication Entity
 *
 * @property int $id
 * @property string $Role_Implication
 * @property int $investigations_id
 * @property int $characters_id
 * @property string $Note_Implication
 *
 * @property \App\Model\Entity\Investigation $investigation
 * @property \App\Model\Entity\Character $character
 */
class Implication extends Entity
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
        'Role_Implication' => true,
        'investigations_id' => true,
        'characters_id' => true,
        'Note_Implication' => true,
        'investigation' => true,
        'character' => true
    ];
}
