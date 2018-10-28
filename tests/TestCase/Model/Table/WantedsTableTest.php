<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WantedsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WantedsTable Test Case
 */
class WantedsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WantedsTable
     */
    public $Wanteds;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.wanteds',
        'app.characters',
        'app.users',
        'app.roles',
        'app.organizations',
        'app.constitutions',
        'app.constitutions_organizations',
        'app.characters_roles',
        'app.characters_wanteds',
        'app.investigations',
        'app.laws',
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
        $config = TableRegistry::exists('Wanteds') ? [] : ['className' => WantedsTable::class];
        $this->Wanteds = TableRegistry::get('Wanteds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Wanteds);

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
