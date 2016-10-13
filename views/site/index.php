<?php
use yii\helpers\Html;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $allNews app\models\News */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <? $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
    foreach ($roles as $role) {
        echo $role->name . ',';
    }
    ?>

    <div class="body-content">

        <?php echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_news',
        ]); ?>

    </div>
</div>
