<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DetailSchedules Model
 *
 * @property \App\Model\Table\DepatureSchedulesTable&\Cake\ORM\Association\BelongsTo $DepatureSchedules
 *
 * @method \App\Model\Entity\DetailSchedule newEmptyEntity()
 * @method \App\Model\Entity\DetailSchedule newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DetailSchedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DetailSchedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\DetailSchedule findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DetailSchedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DetailSchedule[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DetailSchedule|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DetailSchedule saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DetailSchedule[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DetailSchedule[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DetailSchedule[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DetailSchedule[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DetailSchedulesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('detail_schedules');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('DepatureSchedules', [
            'foreignKey' => 'depature_shchedule_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('depature_shchedule_id')
            ->notEmptyString('depature_shchedule_id');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->allowEmptyString('status');

        $validator
            ->integer('serial')
            ->requirePresence('serial', 'create')
            ->notEmptyString('serial');

        $validator
            ->scalar('place')
            ->maxLength('place', 255)
            ->requirePresence('place', 'create')
            ->notEmptyString('place');

        $validator
            ->scalar('mix')
            ->maxLength('mix', 255)
            ->requirePresence('mix', 'create')
            ->notEmptyString('mix');

        $validator
            ->numeric('one_transport_quantity')
            ->requirePresence('one_transport_quantity', 'create')
            ->notEmptyString('one_transport_quantity');

        $validator
            ->numeric('transport_number')
            ->requirePresence('transport_number', 'create')
            ->notEmptyString('transport_number');

        $validator
            ->numeric('depature_quantity_part')
            ->requirePresence('depature_quantity_part', 'create')
            ->notEmptyString('depature_quantity_part');

        $validator
            ->numeric('depature_quantity_sum')
            ->requirePresence('depature_quantity_sum', 'create')
            ->notEmptyString('depature_quantity_sum');

        $validator
            ->numeric('plan_quantity_part')
            ->requirePresence('plan_quantity_part', 'create')
            ->notEmptyString('plan_quantity_part');

        $validator
            ->numeric('plan_quantity_sum')
            ->requirePresence('plan_quantity_sum', 'create')
            ->notEmptyString('plan_quantity_sum');

        $validator
            ->scalar('bp')
            ->maxLength('bp', 255)
            ->allowEmptyString('bp');

        $validator
            ->scalar('cc')
            ->maxLength('cc', 255)
            ->allowEmptyString('cc');

        $validator
            ->time('duration')
            ->requirePresence('duration', 'create')
            ->notEmptyTime('duration');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('depature_shchedule_id', 'DepatureSchedules'), ['errorField' => 'depature_shchedule_id']);

        return $rules;
    }
}
