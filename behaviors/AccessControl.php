<?php


namespace grozzzny\admin\behaviors;


class AccessControl extends \yii\filters\AccessControl
{
    public $rules = [
        [
            'allow' => true,
            'roles' => ['@'],
        ]
    ];
}