<?php

namespace common\lib;

use Yii;
use common\lib\CandidatejobapplyQueryBase;

/**
 * This is the model class for table "j2j_candidatejobapply".
 *
 * @property integer $userid
 * @property integer $jobposid
 * @property integer $status
 * @property string $createdate
 *
 * @property Jobposition $jobpos
 * @property Users $user
 */
class CandidatejobapplyBase extends \common\models\Candidatejobapply
{
    /**
     * @inheritdoc
     * @return CandidatejobapplyQuery the active query used by this AR class.
     */
	
	private $user = false;
	private $candidate = false;
	private $jobpostion = false;
	
    public static function find()
    {
        return new CandidatejobapplyQueryBase(get_called_class());
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobpos()
    {
    	if(!$this->jobpostion)
    	{
    		$this->jobpostion = $this->hasOne(JobpositionBase::className(), ['id' => 'jobposid'])->one();
    	}
    	return $this->jobpostion;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
    	if(!$this->user)
    	{
    		$this->user = $this->hasOne(UsersBase::className(), ['id' => 'userid'])->one();
    	}
    	return $this->user;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidate()
    {
    	if(!$this->candidate)
    	{
    		$this->candidate = $this->hasOne(CandidateBase::className(), ['userid' => 'userid'])->one();
    	}
    	return $this->candidate;
    }
    
}
