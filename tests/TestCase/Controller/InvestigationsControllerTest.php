<?php
namespace App\Test\TestCase\Controller;

use App\Controller\InvestigationsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\InvestigationsController Test Case
 */
class InvestigationsControllerTest extends IntegrationTestCase
{

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
        'app.characters',
        'app.characters_organizations_rights',
        'app.roles',
        'app.characters_roles',
        'app.organizations',
        'app.laws_investigations'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
