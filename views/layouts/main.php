<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (\Yii::$app->user->can('createPost')) {
        $menuItems[] = ['label' => 'News', 'url' => ['/admin/news']];
    }
    if (\Yii::$app->user->can('userManage')) {
        $menuItems[] = ['label' => 'Users', 'url' => ['/user/admin/index']];
    }
    $menuItems[] =
        Yii::$app->user->isGuest ? (
        ['label' => 'Login', 'url' => ['/user/security/login']]
        ) : (
        ['label' => Yii::$app->user->identity->username,
            'items' => [
                [
                    'label' => 'Profile',
                    'url' => ['/user/settings/profile'],

                ],

                '<li>'
                . Html::beginForm(['/user/security/logout'], 'post', ['class' => ''])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>',

                //'<li class="divider"></li>',
//                    '<li class="dropdown-header">Dropdown Header</li>',
//                    ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
            ]
]



        );
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
