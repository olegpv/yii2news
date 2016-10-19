<?php
/**
 * Created by PhpStorm.
 * User: ol
 * Date: 19.10.2016
 * Time: 20:52
 */

namespace app\models;

use dektrium\user\models\Profile as BaseProfile;

class Profile extends BaseProfile{
    private $_senders;

    public function rules() {
        return array_merge(parent::rules(),[
            ['senders','safe']
        ]);
    }

    public function setSenders($value){
        $this->_senders=$value;
    }

    public function getSenders(){
        if(!$this->_senders){
            $this->_senders=$this->user->senders;
        }
        return $this->_senders;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'senders'           => \Yii::t('app', 'Send messages by'),
        ];
    }
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if($this->_senders) {
            UserSender::deleteAll('user_id=:user_id',[':user_id'=>$this->user_id]);
            foreach($this->_senders as $sender_id){
                $sender=new UserSender();
                $sender->user_id=$this->user_id;
                $sender->sender_id=$sender_id;
                $sender->save(false);
            }
        }
    }

}