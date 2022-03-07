<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoomActivitiesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoomActivitiesTable Test Case
 */
class RoomActivitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RoomActivitiesTable
     */
    protected $RoomActivities;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RoomActivities',
        'app.Bookings',
        'app.Rooms',
        'app.Statuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RoomActivities') ? [] : ['className' => RoomActivitiesTable::class];
        $this->RoomActivities = $this->getTableLocator()->get('RoomActivities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RoomActivities);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RoomActivitiesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RoomActivitiesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
