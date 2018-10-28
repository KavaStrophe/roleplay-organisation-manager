<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\UsersBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\UsersBehavior Test Case
 */
class UsersBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Behavior\UsersBehavior
     */
    public $Users;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Users = new UsersBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
