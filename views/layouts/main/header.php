<?php
use yii\helpers\Html;
use yii\helpers\Url;

$user = Yii::$app->user->getIdentity();
?>
<header class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
        <a href="/" class="uk-navbar-item uk-logo">
            <img src="/assets/img/emma_w.svg" alt="Tante Emma" class="uk-margin-right">
        </a>
    </div>
    <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            <li class="uk-navbar-item">
                <a href="#" uk-icon="icon: user"></a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li class="uk-nav-header">
                            <?= Html::encode($user->first_name); ?>
                            <?= Html::encode($user->last_name); ?>
                        </li>
                        <li>
                            <a href="<?= Url::to(['dashboard/user/profile']); ?>">Profile</a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['/logout']); ?>">Logout</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="uk-hidden@m">
                <a href="#offcanvas-slide" uk-toggle uk-icon="icon: menu"></a>
            </li>
        </ul>
    </div>
</header>