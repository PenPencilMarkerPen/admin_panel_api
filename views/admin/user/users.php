<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Nav;
?>
<?php
NavBar::begin([
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => [
        [
            'label' => 'Операции с пользователями',
            'items' => [
                ['label' => 'Добавить', 'url' => ['admin/user/add-user']],
            ],
        ],
    ],
]);

NavBar::end();
?>
<div class="container mt-4">
    <h1 class="mb-4">Пользователи</h1>
    <div class="row">
        <?php foreach ($users as $user): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= Html::encode($user->username) ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= Html::encode($user->login) ?></h6>
                        <div class="d-flex justify-content-between">
                            <?= Html::a('Редактировать', Url::to(['admin/user/edit', 'id' => $user->id]), ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Удалить', Url::to(['admin/user/delete', 'id' => $user->id]), ['class' => 'btn btn-danger']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-4">
        <?= LinkPager::widget([
            'pagination' => $pagination,
            'options' => ['class' => 'pagination justify-content-center'],
            'linkOptions' => ['class' => 'page-link'],
            'activePageCssClass' => 'active',
            'pageCssClass' => 'page-item',
        ]) ?>
    </div>
</div>


