<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var portalium\site\models\Preference $model */

$this->title = $model->id_preference;
$this->params['breadcrumbs'][] = ['label' => 'Preferences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="preference-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_preference' => $model->id_preference], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_preference' => $model->id_preference], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_preference',
            'id_user',
            'id_setting',
            'id_workspace',
            'value:ntext',
            'date_create',
            'date_update',
        ],
    ]) ?>

</div>
