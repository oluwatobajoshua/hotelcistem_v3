<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserProfilesFixture
 */
class UserProfilesFixture extends TestFixture
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
                'staff_code' => 'Lorem ipsum dolor sit a',
                'firstname' => 'Lorem ipsum dolor sit amet',
                'lastname' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum d',
                'email' => 'Lorem ipsum dolor sit amet',
                'sex' => '',
                'user_id' => 1,
                'birthday' => '2022-01-15',
                'created' => '2022-01-15 16:48:19',
                'modified' => '2022-01-15 16:48:19',
            ],
        ];
        parent::init();
    }
}
