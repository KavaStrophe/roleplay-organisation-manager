<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Characters Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\BelongsToMany $Roles
 * @property |\Cake\ORM\Association\BelongsToMany $Wanteds
 *
 * @method \App\Model\Entity\Character get($primaryKey, $options = [])
 * @method \App\Model\Entity\Character newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Character[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Character|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Character patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Character[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Character findOrCreate($search, callable $callback = null, $options = [])
 */
class CharactersTable extends Table
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

        $this->setTable('characters');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Roles', [
            'foreignKey' => 'character_id',
            'targetForeignKey' => 'role_id',
            'joinTable' => 'characters_roles'
        ]);
        $this->belongsToMany('Wanteds', [
            'foreignKey' => 'character_id',
            'targetForeignKey' => 'wanted_id',
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
            ->scalar('FirstName_Character')
            ->maxLength('FirstName_Character', 50)
            ->requirePresence('FirstName_Character', 'create')
            ->notEmpty('FirstName_Character');

        $validator
            ->integer('Old_Character')
            ->requirePresence('Old_Character', 'create')
            ->notEmpty('Old_Character');

        $validator
            ->scalar('LastName_Character')
            ->maxLength('LastName_Character', 50)
            ->requirePresence('LastName_Character', 'create')
            ->notEmpty('LastName_Character');

        $validator
            ->scalar('Gender_Character')
            ->maxLength('Gender_Character', 10)
            ->requirePresence('Gender_Character', 'create')
            ->notEmpty('Gender_Character');

        $validator
            ->scalar('Origin_Character')
            ->maxLength('Origin_Character', 50)
            ->requirePresence('Origin_Character', 'create')
            ->notEmpty('Origin_Character');

        $validator
            ->scalar('Race_Character')
            ->maxLength('Race_Character', 50)
            ->requirePresence('Race_Character', 'create')
            ->notEmpty('Race_Character');

        $validator
            ->scalar('Address_Character')
            ->maxLength('Address_Character', 100)
            ->requirePresence('Address_Character', 'create')
            ->notEmpty('Address_Character');

        $validator
            ->scalar('Religion_Character')
            ->maxLength('Religion_Character', 100)
            ->requirePresence('Religion_Character', 'create')
            ->notEmpty('Religion_Character');

        $validator
            ->scalar('ColorHair_Character')
            ->maxLength('ColorHair_Character', 30)
            ->requirePresence('ColorHair_Character', 'create')
            ->notEmpty('ColorHair_Character');

        $validator
            ->scalar('ColorEyes_Character')
            ->maxLength('ColorEyes_Character', 30)
            ->requirePresence('ColorEyes_Character', 'create')
            ->notEmpty('ColorEyes_Character');

        $validator
            ->scalar('ColorSkin_Character')
            ->maxLength('ColorSkin_Character', 30)
            ->requirePresence('ColorSkin_Character', 'create')
            ->notEmpty('ColorSkin_Character');

        $validator
            ->scalar('Job_Character')
            ->maxLength('Job_Character', 50)
            ->requirePresence('Job_Character', 'create')
            ->notEmpty('Job_Character');

        $validator
            ->scalar('Class_Character')
            ->maxLength('Class_Character', 50)
            ->requirePresence('Class_Character', 'create')
            ->notEmpty('Class_Character');

        $validator
            ->integer('Height_Character')
            ->requirePresence('Height_Character', 'create')
            ->notEmpty('Height_Character');

        $validator
            ->integer('Weight_Character')
            ->requirePresence('Weight_Character', 'create')
            ->notEmpty('Weight_Character');

        $validator
            ->scalar('Img_Character')
            ->maxLength('Img_Character', 100)
            ->requirePresence('Img_Character', 'create')
            ->notEmpty('Img_Character');

        $validator
            ->integer('PNJ_Character')
            ->requirePresence('PNJ_Character', 'create')
            ->notEmpty('PNJ_Character');

        $validator
            ->scalar('Resume_Character')
            ->allowEmpty('Resume_Character');

        $validator
            ->scalar('Link_Character')
            ->maxLength('Link_Character', 255)
            ->allowEmpty('Link_Character');

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
