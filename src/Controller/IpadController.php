<?php

namespace App\Controller;

class IpadController extends AppController
{
    /**
     * TOP画面
     */
    public function index()
    {
        $this->viewBuilder()->disableAutoLayout();
        $depatureSchedule = $this->DepatureSchedules->find()->where(['active'=>1])->first();
        $detailSchedules = $this->DetailSchedules->find()->where(['depature_shchedule_id'=>$depatureSchedule->id])->order(['serial' => 'asc'])->all();
        $this->set('detailSchedules', $detailSchedules);
        $this->set('depatureSchedule', $depatureSchedule);
    }


    /**
     * 登録
     * id,bp,ccを受ける
     */
    public function runReserve()
    {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $id = $this->request->getData('id');
            $bp = $this->request->getData('bp');
            $cc = $this->request->getData('cc');
            $detailSchedule = $this->DetailSchedules->get($id);
            $this->DetailSchedules->patchEntity($detailSchedule, ['bp' => $bp, 'cc' => $cc, 'status' => 'reserve']);
            if (!$this->DetailSchedules->save($detailSchedule)) {
                $this->log($detailSchedule->getErrors());
            }
        }
        return;
    }


    /**
     * 登録キャンセル
     * idを受ける
     */
    public function cancelReserve()
    {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $id = $this->request->getData('id');
            $detailSchedule = $this->DetailSchedules->get($id);
            $this->DetailSchedules->patchEntity($detailSchedule, ['status' => null, 'bp' => null, 'cc' => null]);
            if (!$this->DetailSchedules->save($detailSchedule)) {
                $this->log($detailSchedule->getErrors());
            }
        }
        return;
    }


    /**
     * 順番を変更する
     * 順番のid配列をjsonで受け取る
     */
    public function changeSerial()
    {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $serialsubmit = json_decode($this->request->getData('serialsubmit'));
            $this->log($this->request->getData('serialsubmit'));
            $serial = 0;
            for ($i = 0; $i < count($serialsubmit); $i++) {
                $id = $serialsubmit[$i];
                $serial++;
                $detailSchedule = $this->DetailSchedules->get($id);
                $this->DetailSchedules->patchEntity($detailSchedule, ['serial' => $serial]);
                if (!$this->DetailSchedules->save($detailSchedule)) {
                    $this->log($detailSchedule->getErrors());
                }
            }

        }
        return;
    }


    /**
     * 行を削除する
     * idを受ける
     */
    public function deleteRow()
    {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $id = $this->request->getData('id');
            $detailSchedule = $this->DetailSchedules->get($id);
            if (!$this->DetailSchedules->delete($detailSchedule)) {
                $this->log($detailSchedule->getErrors());
            }
        }
        return;
    }

    /**
     * 行を削除する
     * idを受ける
     */
    public function insertRow()
    {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $serial = $this->request->getData('serial');
            $place = $this->request->getData('place');
            $transport_number = $this->request->getData('transport_number');
            $depature_quantity_sum = $this->request->getData('depature_quantity_sum');
            $depature_schedule_id = $this->request->getData('depature_schedule_id');
            $plan_quantity_part = $this->request->getData('plan_quantity_part');
            $one_transport_quantity = $this->request->getData('one_transport_quantity');
            $mix = $this->request->getData('mix');
            $bp = $this->request->getData('bp');
            $duration = $this->request->getData('duration');

            $detailSchedule = new $this->DetailSchedule->nweEntity();
            
            $detailSchedule = new $this->DetailSchedule->patchEntity(compact(
                $serial,
                $place,
                $transport_number,
                $depature_quantity_sum,
                $depature_schedule_id,
                $plan_quantity_part,
                $one_transport_quantity,
                $mix,
                $bp,
                $duration
            ));

            if (!$this->DetailSchedules->save($detailSchedule)) {
                $this->log($detailSchedule->getErrors());
            }
        }
        return;
    }


}