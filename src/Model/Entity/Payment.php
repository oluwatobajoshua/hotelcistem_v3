<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $guest_id
 * @property float $amount
 * @property int $created
 * @property int $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Guest $guest
 */
class Payment extends Entity
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
        'user_id' => true,
        'guest_id' => true,
        'amount' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'guest' => true,
    ];
}
