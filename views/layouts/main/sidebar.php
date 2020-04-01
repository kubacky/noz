<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use app\models\User;
?>
<nav id="offcanvas-slide" class="nz-sidebar-left uk-visible@m">
    <?=
    Menu::widget([
        'options' => [
            'class' => 'uk-nav-default uk-nav-parent-icon',
            'uk-nav' => true
        ],
        'activeCssClass' => 'uk-active',
        'submenuTemplate' => "\n<ul class=\"uk-nav-sub\">\n{items}\n</ul>\n",
        'itemOptions' => [
            'class' => 'uk-parent',
        ],
        'items' => [
            [
                'label' => 'Offers',
                'url' => ['dashboard/offer/index'],
                'items' => [
                    [
                        'label' => 'View all offers',
                        'url' => ['dashboard/offer/index']
                    ],
                    [
                        'label' => 'Create offer',
                        'url' => ['dashboard/offer/create']
                    ]
                ]
            ],
            [
                'label' => 'Branches',
                'url' => ['dashboard/branch/index'],
                'visible' => User::isAdmin(),
                'items' => [

                    [
                        'label' => 'View all branches',
                        'url' => ['dashboard/branch/index']
                    ],
                    [
                        'label' => 'Add branch',
                        'url' => ['dashboard/branch/create']
                    ]
                ]
            ],
            [
                'label' => 'Settings',
                'url' => ['dashboard/setting'],
                'visible' => User::isAdmin(),
                'items' => [

                    [
                        'label' => 'View all users',
                        'url' => ['dashboard/setting/index']
                    ]
                ]
            ],
            [
                'label' => User::isAdmin() ? 'Users' : 'Profile',
                'url' => [User::isAdmin() ? 'dashboard/user/index' : 'dashboard/user/profile'],
                'items' => [
                    [
                        'label' => 'View all',
                        'visible' => User::isAdmin(),
                        'url' => ['dashboard/user/index']
                    ]
                ],
                'items' => [
                    [
                        'label' => 'Create user',
                        'visible' => User::isAdmin(),
                        'url' => ['dashboard/user/create']
                    ]
                ],
                'items' => [
                    [
                        'label' => 'Edit your profile',
                        'url' => ['dashboard/user/prifle']
                    ]
                ]
            ],
        ]
    ]);

    ?>
</nav>
