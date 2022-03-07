<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LocalsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LocalsTable Test Case
 */
class LocalsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LocalsTable
     */
    protected $Locals;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Locals',
        'app.States',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Locals') ? [] : ['className' => LocalsTable::class];
        $this->Locals = $this->getTableLocator()->get('Locals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Locals);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LocalsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LocalsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
