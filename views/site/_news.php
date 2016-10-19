<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>
<div class="post">
    <h2>
        <?php if (Yii::$app->user->can('viewPost')): ?>
            <a href="<?= Yii::$app->urlManager->createUrl(['news/news/view', 'id' => $model->id]) ?>">
                <?= Html::encode($model->title); ?>
            </a>
        <?php else: ?>
            <?= Html::encode($model->title); ?>
        <?php endif ?>
    </h2>

    <?= Html::encode($model->text) ?>
</div>