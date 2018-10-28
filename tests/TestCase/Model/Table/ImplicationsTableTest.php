<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ImplicationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ImplicationsTable Test Case
 */
class ImplicationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ImplicationsTable
     */
    public $Implications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.implications',
        'app.investigations',
        'app.laws',
        'app.constitutions',
        'app.users',
        'app.organizations',
        'app.characters_organizations_rights',
        'app.constitutions_organizations',
        'app.laws_investigations',
        'app.characters',
        'app.roles',
        'app.characters_roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Implications') ? [] : ['className' => ImplicationsTable::class];
        $this->Implications = TableRegistry::get('Implications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Implications);

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
