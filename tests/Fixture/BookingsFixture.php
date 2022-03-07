<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BookingsFixture
 */
class BookingsFixture extends TestFixture
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
                'guest_id' => 1,
                'arrival_date' => '2022-01-17 20:07:14',
                'departure_date' => '2022-01-17 20:07:14',
                'created' => '2022-01-17 20:07:14',
                'modified' => '2022-01-17 20:07:14',
            ],
        ];
        parent::init();
    }
}
