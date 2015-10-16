<?php
use yii\bootstrap\Tabs;

echo Tabs::widget([
    'items' => [
        [
            'label' => 'One',
            'content' => 'Anim pariatur cliche...',
            'active' => true
        ],
        [
            'label' => 'Two',
            'content' => 'Anim pariatur cliche...',
            'headerOptions' => [''],
            'options' => ['id' => 'myveryownID'],
        ],
        [
            'label' => 'Dropdown',
            'items' => [
                [
                    'label' => 'DropdownA',
                    'content' => 'DropdownA, Anim pariatur cliche...',
                ],
                [
                    'label' => 'DropdownB',
                    'content' => 'DropdownB, Anim pariatur cliche...',
                ],
            ],
        ],
    ],
]);