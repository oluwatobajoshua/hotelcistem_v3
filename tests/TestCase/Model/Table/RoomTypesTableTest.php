<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoomTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoomTypesTable Test Case
 */
class RoomTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RoomTypesTable
     */
    protected $RoomTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RoomTypes',
        'app.Rooms',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RoomTypes') ? [] : ['className' => RoomTypesTable::class];
        $this->RoomTypes = $this->getTableLocator()->get('RoomTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RoomTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RoomTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RoomTypesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
