<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WantedsFixture
 *
 */
class WantedsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'DeadOrAlive_Wanted' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'Gift_Wanted' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null],
        'Details_Wanted' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null],
        'Img_Wanted' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => 'default.jpg', 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Link_Wanted' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null, 'fixed' => null],
        'characters_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'organizations_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'investigations_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_wanteds_characters1_idx' => ['type' => 'index', 'columns' => ['characters_id'], 'length' => []],
            'fk_wanteds_organizations1_idx' => ['type' => 'index', 'columns' => ['organizations_id'], 'length' => []],
            'fk_wanteds_investigations1_idx' => ['type' => 'index', 'columns' => ['investigations_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_wanteds_characters1' => ['type' => 'foreign', 'columns' => ['characters_id'], 'references' => ['characters', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_wanteds_investigations1' => ['type' => 'foreign', 'columns' => ['investigations_id'], 'references' => ['investigations', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_wanteds_organizations1' => ['type' => 'foreign', 'columns' => ['organizations_id'], 'references' => ['organizations', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_bin'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'DeadOrAlive_Wanted' => 1,
            'Gift_Wanted' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'Details_Wanted' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'Img_Wanted' => 'Lorem ipsum dolor sit amet',
            'Link_Wanted' => 'Lorem ipsum dolor sit amet',
            'characters_id' => 1,
            'organizations_id' => 1,
            'investigations_id' => 1
        ],
    ];
}
