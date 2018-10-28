<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Constitutions Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\OrganizationsTable|\Cake\ORM\Association\BelongsToMany $Organizations
 *
 * @method \App\Model\Entity\Constitution get($primaryKey, $options = [])
 * @method \App\Model\Entity\Constitution newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Constitution[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Constitution|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Constitution patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Constitution[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Constitution findOrCreate($search, callable $callback = null, $options = [])
 */
class ConstitutionsTable extends Table
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

        $this->setTable('constitutions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Organizations', [
            'foreignKey' => 'constitution_id',
            'targetForeignKey' => 'organization_id',
            'joinTable' => 'constitutions_organizations'
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
            ->scalar('Name_Constitution')
            ->maxLength('Name_Constitution', 100)
            ->requirePresence('Name_Constitution', 'create')
            ->notEmpty('Name_Constitution');

        $validator
            ->scalar('Desc_Constitution')
            ->allowEmpty('Desc_Constitution');

        $validator
            ->scalar('Intro_Constitution')
            ->maxLength('Intro_Constitution', 16777215)
            ->allowEmpty('Intro_Constitution');

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
        $rules->add($rules->existsIn(['users_id'], 'Users'));

        return $rules;
    }
}
