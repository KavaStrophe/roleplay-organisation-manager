<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Investigations Model
 *
 * @property \App\Model\Table\LawsTable|\Cake\ORM\Association\BelongsToMany $Laws
 *
 * @method \App\Model\Entity\Investigation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Investigation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Investigation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Investigation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Investigation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Investigation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Investigation findOrCreate($search, callable $callback = null, $options = [])
 */
class InvestigationsTable extends Table
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

        $this->setTable('investigations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Laws', [
            'foreignKey' => 'investigation_id',
            'targetForeignKey' => 'law_id',
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
            ->scalar('State_Investigation')
            ->maxLength('State_Investigation', 20)
            ->requirePresence('State_Investigation', 'create')
            ->notEmpty('State_Investigation');

        $validator
            ->scalar('Resume_Investigation')
            ->maxLength('Resume_Investigation', 16777215)
            ->requirePresence('Resume_Investigation', 'create')
            ->notEmpty('Resume_Investigation');

        $validator
            ->scalar('Label_Investigation')
            ->maxLength('Label_Investigation', 20)
            ->allowEmpty('Label_Investigation');

        $validator
            ->scalar('Title_Investigation')
            ->maxLength('Title_Investigation', 40)
            ->requirePresence('Title_Investigation', 'create')
            ->notEmpty('Title_Investigation');

        $validator
            ->scalar('Ending_Investigation')
            ->maxLength('Ending_Investigation', 16777215)
            ->allowEmpty('Ending_Investigation');

        return $validator;
    }
}
