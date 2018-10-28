<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LawsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LawsTable Test Case
 */
class LawsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LawsTable
     */
    public $Laws;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.laws',
        'app.constitutions',
        'app.users',
        'app.organizations',
        'app.characters_organizations_rights',
        'app.constitutions_organizations',
        'app.investigations',
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
        $config = TableRegistry::exists('Laws') ? [] : ['className' => LawsTable::class];
        $this->Laws = TableRegistry::get('Laws', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Laws);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
