<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $Role_User
 * @property string $Login_User
 * @property string $Password_User
 * @property \Cake\I18n\FrozenDate $Registred_User
 *
 * @property \App\Model\Entity\Character[] $characters
 */
class User extends Entity
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
        'Role_User' => true,
        'Login_User' => true,
        'Password_User' => true,
        'Registred_User' => true,
        'characters' => true
    ];
}
