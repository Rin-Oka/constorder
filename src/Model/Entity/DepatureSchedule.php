<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DepatureSchedule Entity
 *
 * @property int $id
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $start_datetime
 * @property \Cake\I18n\FrozenTime $end_datetime
 * @property string $block
 * @property string $speed
 * @property string $personnel
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class DepatureSchedule extends Entity
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
        'active' => true,
        'start_datetime' => true,
        'end_datetime' => true,
        'block' => true,
        'speed' => true,
        'personnel' => true,
        'created' => true,
        'modified' => true,
    ];
}
