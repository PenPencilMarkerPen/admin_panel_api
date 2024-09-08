<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Nav;
?>
<?php
NavBar::begin([
    'options' => ['class' => 'navbar navbar-expand-lg navbar-light bg-light'],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => [
        [
            'label' => 'Операции с продуктами',
            'items' => [
                ['label' => 'Добавить', 'url' => ['admin/product/add-product']],
            ],
        ],
    ],
]);

NavBar::end();
?>

<div class="container mt-4">
    <h1 class="mb-4">Продукты</h1>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= Html::encode($product->name) ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= Html::encode($product->category->name) ?></h6>
                        <p class="card-text"><?= Html::encode($product->description) ?></p>
                        <p class="card-text"><strong>Цена:</strong> <?= Html::encode($product->price) ?></p>
                        <div class="d-flex justify-content-between">
                            <?= Html::a('Редактировать', Url::to(['admin/product/edit', 'id' => $product->id]), ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Удалить', Url::to(['admin/product/delete', 'id' => $product->id]), ['class' => 'btn btn-danger']) ?>
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
