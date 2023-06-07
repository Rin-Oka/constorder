<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DetailSchedule Entity
 *
 * @property int $id
 * @property int $depature_shchedule_id
 * @property string|null $status
 * @property int $serial
 * @property string $place
 * @property string $mix
 * @property float $one_transport_quantity
 * @property float $transport_number
 * @property float $depature_quantity_part
 * @property float $depature_quantity_sum
 * @property float $plan_quantity_part
 * @property float $plan_quantity_sum
 * @property string|null $bp
 * @property string|null $cc
 * @property \Cake\I18n\Time $duration
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\DepatureSchedule $depature_schedule
 */
class DetailSchedule extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'depature_shchedule_id' => true,
        'status' => true,
        'serial' => true,
        'place' => true,
        'mix' => true,
        'one_transport_quantity' => true,
        'transport_number' => true,
        'depature_quantity_part' => true,
        'depature_quantity_sum' => true,
        'plan_quantity_part' => true,
        'plan_quantity_sum' => true,
        'bp' => true,
        'cc' => true,
        'duration' => true,
        'created' => true,
        'modified' => true,
        'depature_schedule' => true,
    ];
}
