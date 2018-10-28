<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Laws Model
 *
 * @property \App\Model\Table\ConstitutionsTable|\Cake\ORM\Association\BelongsTo $Constitutions
 * @property \App\Model\Table\InvestigationsTable|\Cake\ORM\Association\BelongsToMany $Investigations
 *
 * @method \App\Model\Entity\Law get($primaryKey, $options = [])
 * @method \App\Model\Entity\Law newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Law[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Law|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Law patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Law[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Law findOrCreate($search, callable $callback = null, $options = [])
 */
class LawsTable extends Table
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

        $this->setTable('laws');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Constitutions', [
            'foreignKey' => 'constitutions_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Investigations', [
            'foreignKey' => 'law_id',
            'targetForeignKey' => 'investigation_id',
            'joinTable' => 'laws_investigations'
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
            ->scalar('Name_Law')
            ->maxLength('Name_Law', 50)
            ->requirePresence('Name_Law', 'create')
            ->notEmpty('Name_Law');

        $validator
            ->scalar('Content_Law')
            ->requirePresence('Content_Law', 'create')
            ->notEmpty('Content_Law');

        $validator
            ->scalar('Sentence_Law')
            ->requirePresence('Sentence_Law', 'create')
            ->notEmpty('Sentence_Law');

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
        $rules->add($rules->existsIn(['constitutions_id'], 'Constitutions'));

        return $rules;
    }
}
