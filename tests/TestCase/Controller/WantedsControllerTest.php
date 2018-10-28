<?php
namespace App\Test\TestCase\Controller;

use App\Controller\WantedsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\WantedsController Test Case
 */
class WantedsControllerTest extends IntegrationTestCase
{

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
