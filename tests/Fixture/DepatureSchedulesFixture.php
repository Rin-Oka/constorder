<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DepatureSchedulesFixture
 */
class DepatureSchedulesFixture extends TestFixture
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
                'active' => 1,
                'start_datetime' => '2023-06-06 12:35:40',
                'end_datetime' => '2023-06-06 12:35:40',
                'block' => 'Lorem ipsum dolor sit amet',
                'speed' => 'Lorem ipsum dolor sit amet',
                'personnel' => 'Lorem ipsum dolor sit amet',
                'created' => '2023-06-06 12:35:40',
                'modified' => '2023-06-06 12:35:40',
            ],
        ];
        parent::init();
    }
}
