<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvestigationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InvestigationsTable Test Case
 */
class InvestigationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InvestigationsTable
     */
    public $Investigations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.investigations',
        'app.laws',
        'app.constitutions',
        'app.users',
        'app.organizations',
        'app.constitutions_organizations',
        'app.laws_investigations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Investigations') ? [] : ['className' => InvestigationsTable::class];
        $this->Investigations = TableRegistry::get('Investigations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Investigations);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
