<?php

namespace App\Controller;


use PHPExcel_IOFactory;
use Cake\I18n\Time;

class AdminController extends AppController
{

    /**
     * excelから情報を取り込む
     * excelファイルを受ける
     */
    public function importFromExcel()
    {

        if ($this->request->is('post')) {
            $excel = $this->request->getData('excel');
            $name = $excel->getClientFilename();
            $path = ROOT . DS . 'upload' . DS . $name;
            $excel->moveTo($path);

            $reader = PHPExcel_IOFactory::createReader('Excel2007');
            $book = $reader->load($path);
            $array = $book->getActiveSheet(0)->toArray(null, true, true, true);
            /*
            $scheduleData = [];
            for ($i = 2; $i < 8; $i++) {
                $scheduleData[''];
                $row = $array[$i];
                $serial++;
                $entity = $this->DetailSchedules->newEntity([
                    'serial' => $serial,
                    'place' => $row['A'],
                    'mix' => $row['B'],
                    'one_transport_quantity' => $row['C'],
                    'transport_number' => $row['F'],
                    'depature_quantity_part' => $row['H'],
                    'depature_quantity_sum' => $row['I'],
                    'plan_quantity_part' => $row['J'],
                    'plan_quantity_sum' => $row['K'],
                    'duration' => new Time(strtotime(($row['P']-$row['M'])*24+'h')),
                    'depature_shchedule_id'=>1
                ]);

                if (!$this->DetailSchedules->save($entity)) {
                    $this->log(print_r($entity->getErrors()));
                    break;
                }
            }
            */
            
            $serial = 0;
            for ($i = 9; $i < count($array); $i++) {
                $row = $array[$i];
                $serial++;
                $duration = ((double)$row['P']-(double)$row['M'])*24;
                $hour = floor($duration);
                $min = (int)(($duration-$hour)*60);
                $this->log($hour.':'.$min);
                $entity = $this->DetailSchedules->newEntity([
                    'serial' => $serial,
                    'place' => $row['A'],
                    'mix' => $row['B'],
                    'one_transport_quantity' => $row['C'],
                    'transport_number' => $row['F'],
                    'depature_quantity_part' => $row['H'],
                    'depature_quantity_sum' => $row['I'],
                    'plan_quantity_part' => $row['J'],
                    'plan_quantity_sum' => $row['K'],
                    'duration' => new Time($hour.':'.$min),
                    'depature_shchedule_id'=>1
                ]);

                if (!$this->DetailSchedules->save($entity)) {
                    $this->log(print_r($entity->getErrors()));
                    break;
                }

            }
        }
    }
}