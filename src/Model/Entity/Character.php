<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Character Entity
 *
 * @property int $id
 * @property string $FirstName_Character
 * @property int $Old_Character
 * @property string $LastName_Character
 * @property string $Gender_Character
 * @property string $Origin_Character
 * @property string $Race_Character
 * @property string $Address_Character
 * @property string $Religion_Character
 * @property string $ColorHair_Character
 * @property string $ColorEyes_Character
 * @property string $ColorSkin_Character
 * @property string $Job_Character
 * @property string $Class_Character
 * @property int $Height_Character
 * @property int $Weight_Character
 * @property string $Img_Character
 * @property int $users_id
 * @property int $PNJ_Character
 * @property string $Resume_Character
 * @property string $Link_Character
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Role[] $roles
 */
class Character extends Entity
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
        'FirstName_Character' => true,
        'Old_Character' => true,
        'LastName_Character' => true,
        'Gender_Character' => true,
        'Origin_Character' => true,
        'Race_Character' => true,
        'Address_Character' => true,
        'Religion_Character' => true,
        'ColorHair_Character' => true,
        'ColorEyes_Character' => true,
        'ColorSkin_Character' => true,
        'Job_Character' => true,
        'Class_Character' => true,
        'Height_Character' => true,
        'Weight_Character' => true,
        'Img_Character' => true,
        'users_id' => true,
        'PNJ_Character' => true,
        'Resume_Character' => true,
        'Link_Character' => true,
        'user' => true,
        'roles' => true
    ];
}
