<?php

namespace common\lib;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\lib\CandidatejobapplyBase;
use yii\helpers\ArrayHelper;

/**
 * CandidatejobapplyBaseSearch represents the model behind the search form about `common\lib\CandidatejobapplyBase`.
 */
class CandidatejobapplyBaseSearch extends CandidatejobapplyBase
{
	public $companyid = 0;
    /**
     * @inheritdoc
     */
	
    public function rules()
    {
        return [
            [['userid', 'jobposid', 'status'], 'integer'],
            [['createdate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CandidatejobapplyBase::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if($this->companyid > 0)
        {
        	$alljobpos = JobpositionBase::find()->select(['id'])->where(['companyid' => $this->companyid, 'status' => 1])->all();
        	$alljobpos = ArrayHelper::getColumn($alljobpos, 'id');
        	if(count($alljobpos) == 0)
        	{
        		$alljobpos[] = -1;
        	}
        	
        	$query->andFilterWhere(['in', 'jobposid', $alljobpos]);
        }
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'userid' => $this->userid,
            'jobposid' => $this->jobposid,
            'status' => $this->status,
            'createdate' => $this->createdate,
        ]);
        $query->orderBy(['createdate' => SORT_DESC]);
        //echo $this->companyid;
        //echo $query->createCommand()->sql; exit;
        return $dataProvider;
    }
}
