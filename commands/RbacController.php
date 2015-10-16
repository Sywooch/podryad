<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 18.05.15
 * Time: 12:20
 */

namespace app\commands;

use app\modules\cms\models\User;
use Yii;
use yii\console\Controller;

class RbacController extends Controller{

        public function actionInit()
        {
            Yii::$app->db->createCommand('DELETE FROM {{%auth_item}}')->execute();
            Yii::$app->db->createCommand('DELETE FROM {{%auth_rule}}')->execute();

            $auth = Yii::$app->authManager;

            $customer = $auth->createRole(User::ROLE_CUSTOMER);
            $customer->description = 'Заказчик';
            $auth->add($customer);

            $contractor = $auth->createRole(User::ROLE_CONTRACTOR);
            $contractor->description = 'Подрядчик';
            $auth->add($contractor);

            $setRole = $auth->createPermission('setRole');
            $setRole->description = 'Проставление роли';
            $auth->add($setRole);

            $adminNav = $auth->createPermission('admin.nav');
            $adminNav->description = 'Отображение навигации';
            $auth->add($adminNav);

            $manager = $auth->createRole(User::ROLE_MANAGER);
            $manager->description = 'Менеджер';
            $auth->add($manager);
            $auth->addChild($manager,$setRole);
            $auth->addChild($manager, $adminNav);

            $admin = $auth->createRole(User::ROLE_ADMIN);
            $admin->description = 'Администратор';
            $auth->add($admin);
            $auth->addChild($admin,$customer);
            $auth->addChild($admin,$contractor);
            $auth->addChild($admin,$manager);
            $auth->addChild($admin,$setRole);

            //проставление ролей у пользователя admin,manager
            $role = $auth->getRole(User::ROLE_ADMIN);
            $auth->assign($role,1);
        }

}