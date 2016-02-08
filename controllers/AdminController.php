<?php

namespace nagser\users\controllers;

use nagser\users\models\User;
use nagser\users\Module;
use nagser\base\behaviors\AdminControllerBehavior;
use omgdef\multilingual\MultilingualQuery;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;

class AdminController extends \dektrium\user\controllers\AdminController {

    public function behaviors(){
        return [
            'controller' => [
                'class' => AdminControllerBehavior::className(),
                'module' => Module::className()
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete'  => ['post'],
                    'confirm' => ['post'],
                    'block'   => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'select2-list', 'ajax-search'],
                        'allow' => true,
                        'roles' => ['users-admin-index'],
                    ],
                    [
                        'actions' => ['update', 'update-profile', 'info',   ],
                        'allow' => true,
                        'roles' => ['users-admin-update'],
                    ],
                    [
                        'actions' => ['assignments'],
                        'allow' => true,
                        'roles' => ['users-admin-assignments'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['users-admin-create'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['users-admin-view'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['users-admin-delete'],
                    ],
                    [
                        'actions' => ['block'],
                        'allow' => true,
                        'roles' => ['users-admin-block'],
                    ],
                ],
            ],
        ];
    }

    public function actionView($id){
        $user = $this->findModel($id);
        return $this->render('view', [
            'user' => $user,
        ]);
    }

    /**
     * Универсальный поиск по любому полю
     * @param string $search
     * @param string $value
     * @param string $colAlias
     * @return Json
     * */
    public function actionSelect2List($search = '', $value = '', $colAlias = 'title')
    {
        /** @var User $model * */
        $model = User::className();
        /** @var User $modelObject * */
        $table = $model::tableName();
        $alias = $colAlias;
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new MultilingualQuery($model);
            $query->select('DISTINCT(' . $alias . ') AS id, ' . $alias . ' AS text')
                ->from($table)
                ->joinWith('profile');
            $query->where($alias . ' LIKE "%' . $search . '%"')
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($value > 0) {
            $out['results'] = ['id' => $value, 'text' => $model::find($value)->$colAlias];
        }
        return Json::encode($out);
    }

    /**
     * Ajax поиск пользователя по его ФИО.
     * @param string $search
     * @param string $value
     * @param string $colAlias
     * @return Json
     * */
    public function actionAjaxSearch($search = '', $value = '', $colAlias = 'title'){
        /** @var User $recordModel * */
        $recordModel = User::className();
        /** @var User $recordModelObject * */
        $table = $recordModel::tableName();
        $alias = $colAlias;
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new MultilingualQuery($recordModel);
            $query->select('*, CONCAT_WS(" &rarr; ", `name`, `email`) AS text')
                ->from($table)
                ->joinWith('profile');
            $query->where($alias . ' LIKE "%' . $search . '%"')
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
//            debug($data);
            $out['results'] = array_values($data);
        } elseif ($value > 0) {
            $out['results'] = ['id' => $value, 'text' => $recordModel::find($value)->$colAlias];
        }
        return Json::encode($out);
    }

}