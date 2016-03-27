<?php
/**
 * Created by PhpStorm.
 * User: vnabatov
 * Date: 27.03.16
 * Time: 12:00
 */
namespace console\models;

use yii\rbac\Rule;

/**
 * Checks if authorID matches user passed via params
 */
class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $group = Yii::$app->user->identity->group;
            if ($item->name === 'admin') {
                return $group == 1;
            } elseif ($item->name === 'author') {
                return $group == 1 || $group == 2;
            }
        }
        return false;
    }
}