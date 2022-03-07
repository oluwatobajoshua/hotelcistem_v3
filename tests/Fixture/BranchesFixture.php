<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BranchesFixture
 */
class BranchesFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'address' => 'Lorem ipsum dolor sit amet',
                'company_id' => 1,
                'created' => '2022-01-15 15:25:09',
                'modified' => '2022-01-15 15:25:09',
            ],
        ];
        parent::init();
    }
}
