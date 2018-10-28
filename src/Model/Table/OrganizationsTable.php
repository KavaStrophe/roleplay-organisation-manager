<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Organizations Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ConstitutionsTable|\Cake\ORM\Association\BelongsToMany $Constitutions
 *
 * @method \App\Model\Entity\Organization get($primaryKey, $options = [])
 * @method \App\Model\Entity\Organization newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Organization[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Organization|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Organization patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Organization[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Organization findOrCreate($search, callable $callback = null, $options = [])
 */
class OrganizationsTable extends Table
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

        $this->setTable('organizations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Constitutions', [
            'foreignKey' => 'organization_id',
            'targetForeignKey' => 'constitution_id',
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
            ->scalar('Name_Organization')
            ->maxLength('Name_Organization', 100)
            ->requirePresence('Name_Organization', 'create')
            ->notEmpty('Name_Organization');

        $validator
            ->scalar('Nickname_Organization')
            ->maxLength('Nickname_Organization', 100)
            ->requirePresence('Nickname_Organization', 'create')
            ->notEmpty('Nickname_Organization');

        $validator
            ->scalar('Origin_Organization')
            ->maxLength('Origin_Organization', 50)
            ->requirePresence('Origin_Organization', 'create')
            ->notEmpty('Origin_Organization');

        $validator
            ->scalar('Resume_Organization')
            ->maxLength('Resume_Organization', 16777215)
            ->requirePresence('Resume_Organization', 'create')
            ->notEmpty('Resume_Organization');

        $validator
            ->integer('Effective_Organization')
            ->requirePresence('Effective_Organization', 'create')
            ->notEmpty('Effective_Organization');

        $validator
            ->integer('Finances_Organization')
            ->requirePresence('Finances_Organization', 'create')
            ->notEmpty('Finances_Organization');

        $validator
            ->scalar('Activities_Organization')
            ->requirePresence('Activities_Organization', 'create')
            ->notEmpty('Activities_Organization');

        $validator
            ->scalar('Img_Organization')
            ->maxLength('Img_Organization', 100)
            ->requirePresence('Img_Organization', 'create')
            ->notEmpty('Img_Organization');

        $validator
            ->scalar('Link_Organization')
            ->maxLength('Link_Organization', 255)
            ->allowEmpty('Link_Organization');

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
