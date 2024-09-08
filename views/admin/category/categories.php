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
            'label' => 'Операции с категориями',
            'items' => [
                ['label' => 'Добавить', 'url' => ['admin/category/add-category']],
            ],
        ],
    ],
]);

NavBar::end();
?>


<div class="container mt-4">
    <h1 class="mb-4">Категории</h1>
    <div class="row">
        <?php foreach ($categories as $category): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= Html::encode($category->name ) ?></h5>
                        <div class="d-flex justify-content-between">
                            <?= Html::a('Редактировать', Url::to(['admin/category/edit', 'id' => $category->id]), ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Удалить', Url::to(['admin/category/delete', 'id' => $category->id]), ['class' => 'btn btn-danger']) ?>
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