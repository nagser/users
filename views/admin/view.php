<?
/**
 * @var $user app\modules\users\models\User
 * */

$this->title = Yii::t('user', 'User profile');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('user', 'Manage users'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-heading">
    <div class="media clearfix">
        <div class="media-left pr30">
            <a href="#">
                <img class="media-object mw150" src="http://admindesigns.com/demos/absolute/1.1/assets/img/avatars/profile_avatar.jpg" alt="...">
            </a>
        </div>
        <div class="media-body va-m">
            <h2 class="media-heading"><?= $user->profile->name?></h2>
            <p class="lead"><?= $user->profile->bio?></p>
            <div class="media-links">
                <ul class="list-inline list-unstyled">
                    <li>
                        <a href="#" title="facebook link">
                            <span class="fa fa-facebook-square fs35 text-primary"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="twitter link">
                            <span class="fa fa-twitter-square fs35 text-info"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="google plus link">
                            <span class="fa fa-google-plus-square fs35 text-danger"></span>
                        </a>
                    </li>
                    <li class="hidden">
                        <a href="#" title="behance link">
                            <span class="fa fa-behance-square fs35 text-primary"></span>
                        </a>
                    </li>
                    <li class="hidden">
                        <a href="#" title="pinterest link">
                            <span class="fa fa-pinterest-square fs35 text-danger-light"></span>
                        </a>
                    </li>
                    <li class="hidden">
                        <a href="#" title="linkedin link">
                            <span class="fa fa-linkedin-square fs35 text-info"></span>
                        </a>
                    </li>
                    <li class="hidden">
                        <a href="#" title="github link">
                            <span class="fa fa-github-square fs35 text-dark"></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#" title="phone link">
                            <span class="fa fa-phone-square fs35 text-system"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="email link">
                            <span class="fa fa-envelope-square fs35 text-muted"></span>
                        </a>
                    </li>
                    <li class="hidden">
                        <a href="#" title="external link">
                            <span class="fa fa-external-link-square fs35 text-muted"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"><?= Yii::t('user', 'Information')?></span>
                 <span class="panel-controls">
                    <?= \yii\bootstrap\Html::a(\yii\bootstrap\Html::tag('i', '', ['class' => 'fa fa-pencil-square-o']), ['update', 'id' => $user->id])?>
                </span>
            </div>
            <div class="panel-body pn">
                <table class="table mbn tc-icon-1 tc-med-2 tc-bold-last">
                    <tr>
                        <td><i class="fa fa-envelope-o"></i></td>
                        <td><?= Yii::t('user', 'Email') ?></td>
                        <td><?= Yii::$app->formatter->asEmail($user->email)?></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-calendar"></i></td>
                        <td><?= Yii::t('user', 'Registration time') ?></td>
                        <td><?= Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$user->created_at]) ?></td>
                    </tr>
                    <? if ($user->registration_ip !== null): ?>
                        <tr>
                            <td><i class="fa fa-plug"></i></td>
                            <td><?= Yii::t('user', 'Registration IP') ?></td>
                            <td><?= $user->registration_ip ?></td>
                        </tr>
                    <?endif?>
                    <tr>
                        <td><i class="fa fa-check"></i></td>
                        <td><?= Yii::t('user', 'Confirmation status') ?></td>
                        <? if ($user->isConfirmed): ?>
                            <td class="text-success"><?= Yii::t('user', 'Confirmed at {0, date, MMMM dd, YYYY HH:mm}', [$user->confirmed_at]) ?></td>
                        <? else: ?>
                            <td class="text-danger"><?= Yii::t('user', 'Unconfirmed') ?></td>
                        <? endif ?>
                    </tr>
                    <tr>
                        <td><i class="fa fa-ban"></i></td>
                        <td><?= Yii::t('user', 'Block status') ?></td>
                        <? if ($user->isBlocked): ?>
                            <td class="text-danger"><?= Yii::t('user', 'Blocked at {0, date, MMMM dd, YYYY HH:mm}', [$user->blocked_at]) ?></td>
                        <? else: ?>
                            <td class="text-success"><?= Yii::t('user', 'Not blocked') ?></td>
                        <? endif ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"><?= Yii::t('user', 'Profile')?></span>
                <span class="panel-controls">
                    <?= \yii\bootstrap\Html::a(\yii\bootstrap\Html::tag('i', '', ['class' => 'fa fa-pencil-square-o']), ['update-profile', 'id' => $user->id])?>
                </span>
            </div>
            <div class="panel-body pn">
                <table class="table mbn tc-icon-1 tc-med-2 tc-bold-last">
                    <tr>
                        <td><i class="fa fa-map-marker"></i></td>
                        <td><?= $user->profile->getAttributeLabel('location')?></td>
                        <td><?= $user->profile->location?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
