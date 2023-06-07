<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DetailSchedulesFixture
 */
class DetailSchedulesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'depature_shchedule_id' => 1,
                'status' => 'Lorem ipsum dolor sit amet',
                'serial' => 1,
                'place' => 'Lorem ipsum dolor sit amet',
                'mix' => 'Lorem ipsum dolor sit amet',
                'one_transport_quantity' => 1,
                'transport_number' => 1,
                'depature_quantity_part' => 1,
                'depature_quantity_sum' => 1,
                'plan_quantity_part' => 1,
                'plan_quantity_sum' => 1,
                'bp' => 'Lorem ipsum dolor sit amet',
                'cc' => 'Lorem ipsum dolor sit amet',
                'duration' => '12:35:41',
                'created' => '2023-06-06 12:35:41',
                'modified' => '2023-06-06 12:35:41',
            ],
        ];
        parent::init();
    }
}
