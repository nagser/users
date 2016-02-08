<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use nagser\users\models\UserSearch;
use nagser\base\widgets\GridView\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\web\View;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var UserSearch $searchModel
 */

$this->title = Yii::t('user', 'Manage users');
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
	<?= Html::a(Yii::t('user', 'New user'), ['/user/admin/create'], ['class' => 'btn btn-default'])?>
</p>

<?= GridView::widget([
    'dataProvider' 	=> $dataProvider,
    'filterModel'  	=> $searchModel,
    'columns' => [
        [
            'attribute' => 'username',
            'filterType' => GridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'pluginOptions' => [
                    'ajax' => [
                        'colAlias' => 'username',
                    ]
                ],
            ]
        ],
        [
            'attribute' => 'email',
            'format' => 'email',
            'filterType' => GridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'pluginOptions' => [
                    'ajax' => [
                        'colAlias' => 'email',
                    ]
                ],
            ]
        ],
        [
            'attribute' => 'registration_ip',
            'value' => function ($model) {
                return $model->registration_ip == null
                    ? '<span class="not-set">' . Yii::t('user', '(not set)') . '</span>'
                    : $model->registration_ip;
            },
            'format' => 'html',
            'filterType' => GridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'pluginOptions' => [
                    'ajax' => [
                        'colAlias' => 'registration_ip',
                    ]
                ],
            ]
        ],
        [
            'attribute' => 'created_at',
            'value' => function ($model) {
                if (extension_loaded('intl')) {
                    return Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$model->created_at]);
                } else {
                    return date('Y-m-d G:i:s', $model->created_at);
                }
            },
            'filter' => DatePicker::widget([
                'model'      => $searchModel,
                'attribute'  => 'created_at',
                'dateFormat' => 'php:Y-m-d',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
        ],
        [
            'header' => Yii::t('user', 'Confirmation'),
            'headerOptions' => [
                'class' => 'minWidth',
            ],
            'value' => function ($model) {
                if ($model->isConfirmed) {
                    return '<div class="text-center"><span class="text-success">' . Yii::t('user', 'Confirmed') . '</span></div>';
                } else {
                    return Html::a(Yii::t('user', 'Confirm'), ['confirm', 'id' => $model->id], [
                        'class' => 'btn btn-xs btn-success btn-block',
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('user', 'Are you sure you want to confirm this user?'),
                    ]);
                }
            },
            'format' => 'raw',
            'visible' => Yii::$app->getModule('user')->enableConfirmation,
        ],
        [
            'header' => Yii::t('user', 'Block status'),
            'headerOptions' => [
                'class' => 'minWidth',
            ],
            'value' => function ($model) {
                if ($model->isBlocked) {
                    return Html::a(Yii::t('user', 'Unblock'), ['block', 'id' => $model->id], [
                        'class' => 'btn btn-xs btn-success btn-block jsDialog',
                        'data-modal-type' => 'confirm',
                        'data-pjax' => true,
                        'data-confirm' => false,
                        'data-message' => Yii::t('user', 'Are you sure you want to unblock this user?')
                    ]);
                } else {
                    return Html::a(Yii::t('user', 'Block'), ['block', 'id' => $model->id], [
                        'class' => 'btn btn-xs btn-danger btn-block jsDialog',
                        'data-modal-type' => 'confirm',
                        'data-pjax' => true,
                        'data-confirm' => false,
                        'data-button-type' => 'POST',
                        'data-message' => Yii::t('user', 'Are you sure you want to block this user?')
                    ]);
                }
            },
            'format' => 'raw',
        ],
        [
            'class' => 'nagser\base\widgets\ActionColumn\ActionColumn',
            'template' => '{view} {delete}',
        ],
    ],
]); ?>
