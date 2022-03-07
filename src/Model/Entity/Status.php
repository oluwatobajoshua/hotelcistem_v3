<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Status Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $category
 *
 * @property \App\Model\Entity\Guest[] $guests
 * @property \App\Model\Entity\RoomActivity[] $room_activities
 * @property \App\Model\Entity\Room[] $rooms
 * @property \App\Model\Entity\Shift[] $shifts
 */
class Status extends Entity
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
        'name' => true,
        'description' => true,
        'category' => true,
        'guests' => true,
        'room_activities' => true,
        'rooms' => true,
        'shifts' => true,
    ];
}
