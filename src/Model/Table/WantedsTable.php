<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Wanteds Model
 *
 * @property \App\Model\Table\CharactersTable|\Cake\ORM\Association\BelongsTo $Characters
 * @property \App\Model\Table\OrganizationsTable|\Cake\ORM\Association\BelongsTo $Organizations
 * @property \App\Model\Table\InvestigationsTable|\Cake\ORM\Association\BelongsTo $Investigations
 * @property \App\Model\Table\CharactersTable|\Cake\ORM\Association\BelongsToMany $Characters
 *
 * @method \App\Model\Entity\Wanted get($primaryKey, $options = [])
 * @method \App\Model\Entity\Wanted newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Wanted[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Wanted|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Wanted patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Wanted[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Wanted findOrCreate($search, callable $callback = null, $options = [])
 */
class WantedsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('wanteds');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Characters', [
            'foreignKey' => 'characters_id'
        ]);
        $this->belongsTo('Organizations', [
            'foreignKey' => 'organizations_id'
        ]);
        $this->belongsTo('Investigations', [
            'foreignKey' => 'investigations_id'
        ]);
        $this->belongsToMany('Characters', [
            'foreignKey' => 'wanted_id',
            'targetForeignKey' => 'character_id',
            'joinTable' => 'characters_wanteds'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->boolean('DeadOrAlive_Wanted')
            ->requirePresence('DeadOrAlive_Wanted', 'create')
            ->notEmpty('DeadOrAlive_Wanted');

        $validator
            ->scalar('Gift_Wanted')
            ->requirePresence('Gift_Wanted', 'create')
            ->notEmpty('Gift_Wanted');

        $validator
            ->scalar('Details_Wanted')
            ->requirePresence('Details_Wanted', 'create')
            ->notEmpty('Details_Wanted');

        $validator
            ->scalar('Img_Wanted')
            ->maxLength('Img_Wanted', 100)
            ->allowEmpty('Img_Wanted');

        $validator
            ->scalar('Link_Wanted')
            ->maxLength('Link_Wanted', 255)
            ->allowEmpty('Link_Wanted');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['characters_id'], 'Characters'));
        $rules->add($rules->existsIn(['organizations_id'], 'Organizations'));
        $rules->add($rules->existsIn(['investigations_id'], 'Investigations'));

        return $rules;
    }
}
