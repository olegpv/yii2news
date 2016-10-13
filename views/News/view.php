<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

?>
<div class="news-view">

    <?= Html::encode($model->title) ?>
    <div>
        <?= Html::encode($model->text) ?>
    </div>
</div>
