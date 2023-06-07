<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注文タブレット</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/hot-sneaks/jquery-ui.css">

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

    <?= $this->Html->css('ipad_index.css'); ?>
    <?= $this->Html->script('ipad_index.js'); ?>
    <?= $this->Html->css('reset'); ?>

</head>



<body>

    <input type="hidden" name="_csrfToken" id="_csrfToken" autocomplete="off"
        value="<?= $this->request->getAttribute('csrfToken') ?>">
    <?php
    $idArray = array();
    foreach ($detailSchedules as $detailSchedule) {
        $idArray[] = $detailSchedule->id;
    }
    ?>

    <input type="hidden" name="serialsubmit" id="serialsubmit" value="<?= json_encode($idArray) ?>">


    <div class="modal-container" id="modal-bpcc">
        <div class="modal-body">
            <div class="modal-close">×</div>
            <div class="modal-content">
                <h2 class="modal-title">bpとccを選択してください</h2>
                <div>

                    <div id="radio-flex">
                        <div id="bp-radio" class="bbcc-radio">
                            <input type="radio" name="bp" id="bp1" value="bp1" checked="">
                            <label for="bp1">bp1</label>
                            <input type="radio" name="bp" id="bp2" value="bp2">
                            <label for="bp2">bp2</label>
                        </div>
                        <div id="cc-radio" class="bbcc-radio">
                            <input type="radio" name="cc" id="cc1" value="cc1" checked="">
                            <label for="cc1">cc1</label>
                            <input type="radio" name="cc" id="cc2" value="cc2">
                            <label for="cc2">cc2</label>
                        </div>
                    </div>

                    <div>
                        <img src="img/confirm-reserve-button.png" id="confirm-reserve-button" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-container" id="modal-cancel">
        <div class="modal-body">
            <div class="modal-close">×</div>
            <div class="modal-content">
                <h2 class="modal-title">予約をキャンセルします。よろしいですか？</h2>
                <img src="img/confirm-reserve-button.png" id="confirm-cancel-button" alt="">
            </div>
        </div>
    </div>

    <div class="modal-container" id="modal-serial">
        <div class="modal-body">
            <div class="modal-close">×</div>
            <div class="modal-content">
                <h2 class="modal-title">位置変更を確定します。よろしいですか？</h2>
                <img src="img/confirm-serial-button.png" id="confirm-serial-button" alt="">
            </div>
        </div>
    </div>



    <main>


        <section id="left-section">
            <div id="process-table">
                <div class="th-row">
                    <div class="col1">順</div>
                    <div class="col2"></div>
                    <div class="col3">場所</div>
                    <div class="col4">配合</div>
                    <div class="col5">出荷量</div>
                    <div class="col6">回</div>
                    <div class="col7">BP</div>
                    <div class="col8">cc</div>
                    <div class="col9">start</div>
                    <div class="col10"></div>
                    <div class="col11">end</div>
                </div>
                <div id="scroll-box">
                    <?php
                    $now = new Datetime($depatureSchedule->start_datetime);
                    ?>
                    <?php foreach ($detailSchedules as $detailSchedule): ?>
                        <?php
                        $duration = new Datetime($detailSchedule->duration);
                        $end = $now;
                        $end->modify('+ ' . $duration->format('H') . ' hours');
                        $end->modify('+ ' . $duration->format('i') . ' minutes');
                        ?>
                        <div class='row status-<?= STATUS_CONVERT_ENG[$detailSchedule->status] ?>'
                            data-id='<?= $detailSchedule->id ?>'>
                            <div class="col1">
                                <?= $detailSchedule->serial ?>
                            </div>
                            <div class="col2">
                                <?= STATUS_CONVERT_KANJI[$detailSchedule->status] ?>
                            </div>
                            <div class="col3">
                                <?= $detailSchedule->place ?>
                            </div>
                            <div class="col4">
                                <?= $detailSchedule->mix ?>
                            </div>
                            <div class="col5">
                                <?= round($detailSchedule->one_transport_quantity, 3) ?>
                            </div>
                            <div class="col6">
                                <?= $detailSchedule->transport_number ?>
                            </div>
                            <div class="col7">
                                <?= $detailSchedule->bp ?>
                            </div>
                            <div class="col8">
                                <?= $detailSchedule->cc ?>
                            </div>
                            <div class="col9">
                                <?= $now->format('m/d H:i'); ?>
                            </div>
                            <div class="col10">～</div>
                            <div class="col11">
                                <?= $end->format('m/d H:i'); ?>
                            </div>
                        </div>
                        <?php $now = $end; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>


        <section id="right-section">
            <section id="right-upper">
                <?php foreach ($detailSchedules as $detailSchedule): ?>

                    <div id="property-table-<?= $detailSchedule->id ?>" class="property-table">
                        <table>
                            <tr>
                                <td colspan="2">
                                    運搬数量
                                </td>
                                <td>
                                    <?= $detailSchedule->one_transport_quantity ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    台数
                                </td>
                                <td>
                                    <?= $detailSchedule->transport_number ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    配合
                                </td>
                                <td>
                                    <?= $detailSchedule->mix ?>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">
                                    出<br>荷
                                </td>
                                <td>
                                    場所
                                </td>
                                <td>
                                    <?= $detailSchedule->depature_quantity_part ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    累計
                                </td>
                                <td>
                                    <?= $detailSchedule->depature_quantity_sum ?>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2" style="width:10%;">
                                    計<br>画
                                </td>
                                <td style="width:45;">
                                    場所
                                </td>
                                <td style="width:45%;">
                                    <?= $detailSchedule->plan_quantity_part ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    累計
                                </td>
                                <td>
                                    <?= $detailSchedule->plan_quantity_sum ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                <?php endforeach; ?>
            </section>
            <section id="right-lower">
                <div id="whole-map">
                </div>

                <div id="reserve-mode-panel">
                    <div id="reserve-mode-panel-main">
                        <div id='reserve-button-div'>
                            <?= $this->Html->image("reserve-button.png", ['id' => 'reserve-button', 'class' => 'modal-open', 'data-modal' => 'bpcc']); ?>
                        </div>
                    </div>
                    <div id='change-to-serial-mode-button-div'>
                        <?= $this->Html->image("change-to-serial-mode-button.png", ['id' => 'change-to-serial-mode-button']); ?>
                    </div>
                </div>

                <div id="change-mode-panel">
                    <div id="change-mode-panel-main">
                        <div id='delete-reserve-button-div'>
                            <?= $this->Html->image("delete-reserve-button.png", ['id' => 'delete-reserve-button', 'class' => 'modal-open', 'data-modal' => 'cancel']); ?>
                        </div>
                        <div id='change-setting-button-div'>
                            <?= $this->Html->image("change-setting-button.png", ['id' => 'change-setting-button', 'class' => 'modal-open', 'data-modal' => 'bpcc']); ?>
                        </div>
                    </div>
                    <div id='change-to-serial-mode-button-div'>
                        <?= $this->Html->image("change-to-serial-mode-button.png", ['id' => 'change-to-serial-mode-button']); ?>
                    </div>
                </div>

                <div id="serial-mode-panel">
                    <div id="serial-mode-panel-main">
                        <div id='serial-up-button-div'>
                            <?= $this->Html->image("serial-up-button.png", ['id' => 'serial-up-button']); ?>
                        </div>
                        <div id='serial-down-button-div'>
                            <?= $this->Html->image("serial-down-button.png", ['id' => 'serial-down-button']); ?>
                        </div>
                        <div id='serial-button-div'>
                            <?= $this->Html->image("serial-button.png", ['id' => 'serial-button', 'class' => 'modal-open', 'data-modal' => 'serial']); ?>
                        </div>
                    </div>
                    <div id='change-to-reserve-mode-button-div'>
                        <?= $this->Html->image("change-to-reserve-mode-button.png", ['id' => 'change-to-reserve-mode-button']); ?>
                    </div>
                </div>


            </section>

        </section>


    </main>
</body>

</html>