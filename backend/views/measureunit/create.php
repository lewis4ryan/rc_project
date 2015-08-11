<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Measureunit */

$this->title = 'Tạo đơn vị';
$this->params['breadcrumbs'][] = ['label' => 'Đơn vị đo lường', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="measureunit-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
