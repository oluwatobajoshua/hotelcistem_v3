<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GuestTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GuestTypesTable Test Case
 */
class GuestTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GuestTypesTable
     */
    protected $GuestTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.GuestTypes',
        'app.Guests',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('GuestTypes') ? [] : ['className' => GuestTypesTable::class];
        $this->GuestTypes = $this->getTableLocator()->get('GuestTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->GuestTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\GuestTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\GuestTypesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
