<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserProfile Entity
 *
 * @property int $id
 * @property string|null $staff_code
 * @property string $firstname
 * @property string $lastname
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $sex
 * @property int $user_id
 * @property \Cake\I18n\FrozenDate|null $birthday
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 */
class UserProfile extends Entity
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
        'staff_code' => true,
        'firstname' => true,
        'lastname' => true,
        'phone' => true,
        'email' => true,
        'sex' => true,
        'user_id' => true,
        'birthday' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
