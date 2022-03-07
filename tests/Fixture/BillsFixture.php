<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BillsFixture
 */
class BillsFixture extends TestFixture
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
                'number' => 1,
                'guest_id' => 1,
                'created' => '2022-01-17 20:16:54',
                'modified' => '2022-01-17 20:16:54',
            ],
        ];
        parent::init();
    }
}
