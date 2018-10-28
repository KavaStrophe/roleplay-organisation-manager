<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConstitutionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConstitutionsTable Test Case
 */
class ConstitutionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConstitutionsTable
     */
    public $Constitutions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.constitutions',
        'app.users',
        'app.organizations',
        'app.characters_organizations_rights'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Constitutions') ? [] : ['className' => ConstitutionsTable::class];
        $this->Constitutions = TableRegistry::get('Constitutions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Constitutions);

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
