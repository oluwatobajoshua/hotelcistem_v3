<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AddressesFixture
 */
class AddressesFixture extends TestFixture
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
                'state_id' => 1,
                'created' => '2022-01-17 20:40:10',
                'modified' => '2022-01-17 20:40:10',
                'guest_id' => 1,
            ],
        ];
        parent::init();
    }
}
