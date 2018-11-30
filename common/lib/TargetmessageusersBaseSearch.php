<?php

namespace common\lib;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\lib\TargetMessageUsersBase;

/**
 * TargetMessageUsersBaseSearch represents the model behind the search form about `common\lib\TargetMessageUsersBase`.
 */
class TargetmessageusersBaseSearch extends TargetMessageUsersBase
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'status'], 'integer'],
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
        $query = TargetMessageUsersBase::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'userid' => $this->userid,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
