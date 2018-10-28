<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity
 *
 * @property int $laws_id
 * @property int $constitutions_id
 * @property int $Number_category
 * @property string $Label_Category
 * @property string $Resume_Category
 *
 * @property \App\Model\Entity\Law $law
 * @property \App\Model\Entity\Constitution $constitution
 */
class Category extends Entity
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
        'Label_Category' => true,
        'Resume_Category' => true,
        'law' => true,
        'constitution' => true
    ];
}
