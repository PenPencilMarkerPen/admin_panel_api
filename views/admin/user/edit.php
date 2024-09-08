<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category; 
?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'login') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'categories')->checkboxList(
        ArrayHelper::map(Category::find()->all(), 'id', 'name'),
        ['separator' => '<br>']
    ) ?>
    <div class="form-group">
        <?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
