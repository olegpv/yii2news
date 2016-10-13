<?php
/**
 * Created by PhpStorm.
 * User: ol
 * Date: 12.10.2016
 * Time: 15:54
 */
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller {
    public function actionInit() {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "createPost"
        $createPostPermission = $auth->createPermission('createPost');
        $createPostPermission->description = 'Create a post';
        $auth->add($createPostPermission);

        $viewPostPermission = $auth->createPermission('viewPost');
        $viewPostPermission->description = 'View a post';
        $auth->add($viewPostPermission);

        $userManagePermission = $auth->createPermission('userManage');
        $userManagePermission->description = 'User manage';
        $auth->add($userManagePermission);

        // добавляем разрешение "updatePost"
//        $updatePost = $auth->createPermission('updatePost');
//        $updatePost->description = 'Update post';
//        $auth->add($updatePost);


        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $viewPostPermission);

        $moderator = $auth->createRole('moderator');
        $auth->add($moderator);
        $auth->addChild($moderator, $user);
        $auth->addChild($moderator, $createPostPermission);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $userManagePermission);
        $auth->addChild($admin, $moderator);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        //$auth->assign($author, 2);
        //Yii::$app->
        $auth->assign($admin, 1);
    }
}