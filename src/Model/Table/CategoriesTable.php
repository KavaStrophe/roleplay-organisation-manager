<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Categories Model
 *
 * @property \App\Model\Table\LawsTable|\Cake\ORM\Association\BelongsTo $Laws
 * @property \App\Model\Table\ConstitutionsTable|\Cake\ORM\Association\BelongsTo $Constitutions
 *
 * @method \App\Model\Entity\Category get($primaryKey, $options = [])
 * @method \App\Model\Entity\Category newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Category[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Category|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Category patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Category[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Category findOrCreate($search, callable $callback = null, $options = [])
 */
class CategoriesTable extends Table
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

        $this->setTable('categories');
        $this->setDisplayField('laws_id');
        $this->setPrimaryKey(['laws_id', 'constitutions_id', 'Number_category']);

        $this->belongsTo('Laws', [
            'foreignKey' => 'laws_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Constitutions', [
            'foreignKey' => 'constitutions_id',
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
            ->integer('Number_category')
            ->allowEmpty('Number_category', 'create');

        $validator
            ->scalar('Label_Category')
            ->maxLength('Label_Category', 20)
            ->requirePresence('Label_Category', 'create')
            ->notEmpty('Label_Category');

        $validator
            ->scalar('Resume_Category')
            ->maxLength('Resume_Category', 16777215)
            ->allowEmpty('Resume_Category');

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
        $rules->add($rules->existsIn(['laws_id'], 'Laws'));
        $rules->add($rules->existsIn(['constitutions_id'], 'Constitutions'));

        return $rules;
    }
}
