<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RoomActivitiesFixture
 */
class RoomActivitiesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'activity_start' => 1,
                'activity_start_datetime' => '2022-01-15 15:25:40',
                'activity_end' => 1,
                'activity_end_datetime' => '2022-01-15 15:25:40',
                'booking_id' => 1,
                'room_id' => 1,
                'created' => '2022-01-15 15:25:40',
                'status_id' => 1,
                'modified' => '2022-01-15 15:25:40',
            ],
        ];
        parent::init();
    }
}
