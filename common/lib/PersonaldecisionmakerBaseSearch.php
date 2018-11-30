<?php

namespace common\lib;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\lib\PersonaldecisionmakerBase;

/**
 * PersonaldecisionmakerBaseSearch represents the model behind the search form about `common\lib\PersonaldecisionmakerBase`.
 */
class PersonaldecisionmakerBaseSearch extends PersonaldecisionmakerBase
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'companyid', 'isdeputy'], 'integer'],
            [['title', 'title2', 'email', 'cellphone', 'tel', 'reachability', 'contacttime', 'createdate', 'updatedate'], 'safe'],
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
        $query = PersonaldecisionmakerBase::find();

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
            'companyid' => $this->companyid,
            'isdeputy' => $this->isdeputy,
            'createdate' => $this->createdate,
            'updatedate' => $this->updatedate,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title2', $this->title2])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'cellphone', $this->cellphone])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'reachability', $this->reachability])
            ->andFilterWhere(['like', 'contacttime', $this->contacttime]);

        return $dataProvider;
    }
}
