<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Nutriunit */

$this->title = 'Tạo mới';
$this->params['breadcrumbs'][] = ['label' => 'Đơn vị dinh dưỡng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nutriunit-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
