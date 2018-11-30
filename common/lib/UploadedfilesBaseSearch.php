<?php

namespace common\lib;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\lib\UploadedfilesBase;

/**
 * UploadedfilesBaseSearch represents the model behind the search form about `common\lib\UploadedfilesBase`.
 */
class UploadedfilesBaseSearch extends UploadedfilesBase
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'userid'], 'integer'],
            [['file', 'upload_date'], 'safe'],
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
        $query = UploadedfilesBase::find();

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
            'upload_date' => $this->upload_date,
            'userid' => $this->userid,
        ]);

        $query->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
