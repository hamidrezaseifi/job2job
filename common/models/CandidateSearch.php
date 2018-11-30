<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Candidate;

/**
 * CandidateSearch represents the model behind the search form about `common\models\Candidate`.
 */
class CandidateSearch extends Candidate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'employment', 'jobtype', 'desiredjobregion'], 'integer'],
            [['title', 'title2', 'nationality', 'photo', 'email', 'pcode', 'city', 'country', 'address', 'cellphone', 'tel', 'reachability', 'contacttime', 'availability', 'availablefrom', 'desiredjobpcode', 'desiredjobcity', 'desiredjobcountry', 'coverletter', 'createdate', 'updatedate'], 'safe'],
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
        $query = Candidate::find();

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
            'employment' => $this->employment,
            'jobtype' => $this->jobtype,
            'availablefrom' => $this->availablefrom,
            'desiredjobregion' => $this->desiredjobregion,
            'createdate' => $this->createdate,
            'updatedate' => $this->updatedate,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title2', $this->title2])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'pcode', $this->pcode])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'cellphone', $this->cellphone])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'reachability', $this->reachability])
            ->andFilterWhere(['like', 'contacttime', $this->contacttime])
            ->andFilterWhere(['like', 'availability', $this->availability])
            ->andFilterWhere(['like', 'desiredjobpcode', $this->desiredjobpcode])
            ->andFilterWhere(['like', 'desiredjobcity', $this->desiredjobcity])
            ->andFilterWhere(['like', 'desiredjobcountry', $this->desiredjobcountry])
            ->andFilterWhere(['like', 'coverletter', $this->coverletter]);

        return $dataProvider;
    }
}
