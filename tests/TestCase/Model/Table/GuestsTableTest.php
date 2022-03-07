<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GuestsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GuestsTable Test Case
 */
class GuestsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GuestsTable
     */
    protected $Guests;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Guests',
        'app.Genders',
        'app.States',
        'app.GuestTypes',
        'app.Countries',
        'app.Users',
        'app.Statuses',
        'app.Bookings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Guests') ? [] : ['className' => GuestsTable::class];
        $this->Guests = $this->getTableLocator()->get('Guests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Guests);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\GuestsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\GuestsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
