<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApisTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApisTable Test Case
 */
class ApisTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ApisTable
     */
    protected $Apis;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Apis',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Apis') ? [] : ['className' => ApisTable::class];
        $this->Apis = $this->getTableLocator()->get('Apis', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Apis);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ApisTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
