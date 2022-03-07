<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ShiftsFixture
 */
class ShiftsFixture extends TestFixture
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
                'created' => '2022-01-15 15:30:43',
                'stop_time' => '2022-01-15 15:30:43',
                'modified' => '2022-01-15 15:30:43',
                'user_id' => 1,
                'status_id' => 1,
            ],
        ];
        parent::init();
    }
}
