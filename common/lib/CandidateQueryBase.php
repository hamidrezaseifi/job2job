<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Candidate]].
 *
 * @see Candidate
 */
class CandidateQueryBase extends \yii\db\ActiveQuery
{
	/*public function active()
	 {
	 return $this->andWhere('[[status]]=1');
	 }*/
	
	/**
	 * @inheritdoc
	 * @return CandidateQueryBase[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}
	
	/**
	 * @inheritdoc
	 * @return CandidateQueryBase|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
