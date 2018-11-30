<?php

namespace common\lib;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\lib\EmailtextBase;

/**
 * EmailtextBaseSearch represents the model behind the search form about `common\lib\EmailtextBase`.
 */
class EmailtextBaseSearch extends EmailtextBase
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['text', 'texttype'], 'safe'],
        	[['title', 'text', 'texttype'], 'safe'],
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
        $query = EmailtextBase::find();

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
            'id' => $this->id,
            'status' => $this->status,
        ]);

        
        $query->andFilterWhere(['like', 'text', $this->text])
        	->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'texttype', $this->texttype]);

        return $dataProvider;
    }
}
