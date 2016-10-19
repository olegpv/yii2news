<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;
use app\modules\sender\models\Sender;

class User extends BaseUser
{
    private $_role;
    public function rules() {
        return array_merge(parent::rules(),[
            ['role','safe']
        ]);
    }

    public function setRole($value){
        $this->_role=$value;
    }

    public function getRole(){
        $roles=\Yii::$app->authManager->getRolesByUser($this->id);
        if(count($roles)==0){
            return \Yii::$app->params['defaultRole'];
        }

        return array_pop($roles)->name;
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if($this->_role) {
            $auth = \Yii::$app->authManager;
            $role= $auth->getRole($this->_role);
            if($role) {
                $auth->revokeAll($this->getId());
                $auth->assign($role, $this->getId());
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSenders()
    {
        return $this->hasMany(UserSender::className(), ['user_id' => 'id'])->inverseOf('user');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSenders()
    {
        return $this->hasMany(Sender::className(), ['id' => 'sender_id'])->via('userSenders');
    }
}