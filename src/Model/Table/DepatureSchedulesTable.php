<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DepatureSchedules Model
 *
 * @method \App\Model\Entity\DepatureSchedule newEmptyEntity()
 * @method \App\Model\Entity\DepatureSchedule newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DepatureSchedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DepatureSchedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\DepatureSchedule findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DepatureSchedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DepatureSchedule[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DepatureSchedule|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DepatureSchedule saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DepatureSchedule[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DepatureSchedule[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DepatureSchedule[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DepatureSchedule[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DepatureSchedulesTable extends Table
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

        $this->setTable('depature_schedules');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->boolean('active')
            ->notEmptyString('active');

        $validator
            ->dateTime('start_datetime')
            ->requirePresence('start_datetime', 'create')
            ->notEmptyDateTime('start_datetime');

        $validator
            ->dateTime('end_datetime')
            ->requirePresence('end_datetime', 'create')
            ->notEmptyDateTime('end_datetime');

        $validator
            ->scalar('block')
            ->maxLength('block', 255)
            ->requirePresence('block', 'create')
            ->notEmptyString('block');

        $validator
            ->scalar('speed')
            ->maxLength('speed', 255)
            ->requirePresence('speed', 'create')
            ->notEmptyString('speed');

        $validator
            ->scalar('personnel')
            ->maxLength('personnel', 255)
            ->requirePresence('personnel', 'create')
            ->notEmptyString('personnel');

        return $validator;
    }
}
