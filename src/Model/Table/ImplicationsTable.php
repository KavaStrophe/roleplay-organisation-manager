<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Implications Model
 *
 * @property \App\Model\Table\InvestigationsTable|\Cake\ORM\Association\BelongsTo $Investigations
 * @property \App\Model\Table\CharactersTable|\Cake\ORM\Association\BelongsTo $Characters
 *
 * @method \App\Model\Entity\Implication get($primaryKey, $options = [])
 * @method \App\Model\Entity\Implication newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Implication[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Implication|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Implication patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Implication[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Implication findOrCreate($search, callable $callback = null, $options = [])
 */
class ImplicationsTable extends Table
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

        $this->setTable('implications');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Investigations', [
            'foreignKey' => 'investigations_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Characters', [
            'foreignKey' => 'characters_id',
            'joinType' => 'INNER'
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
            ->scalar('Role_Implication')
            ->maxLength('Role_Implication', 45)
            ->requirePresence('Role_Implication', 'create')
            ->notEmpty('Role_Implication');

        $validator
            ->scalar('Note_Implication')
            ->allowEmpty('Note_Implication');

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
        $rules->add($rules->existsIn(['investigations_id'], 'Investigations'));
        $rules->add($rules->existsIn(['characters_id'], 'Characters'));

        return $rules;
    }
}
