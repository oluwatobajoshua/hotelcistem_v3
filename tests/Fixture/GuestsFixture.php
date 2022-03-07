<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GuestsFixture
 */
class GuestsFixture extends TestFixture
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
                'guest_title' => 'Lorem ipsum d',
                'first_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'gender_id' => '',
                'occupation' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor ',
                'address' => 'Lorem ipsum dolor sit amet',
                'state_id' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'birthday' => '2022-01-15',
                'idcard_number' => 'Lorem ipsum dolor sit a',
                'idcard_expiry' => '2022-01-15',
                'account_balance' => 1,
                'guest_type_id' => 1,
                'country_id' => 1,
                'user_id' => 1,
                'status_id' => 1,
                'comments' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created' => '2022-01-15 16:50:33',
                'modified' => '2022-01-15 16:50:33',
            ],
        ];
        parent::init();
    }
}
