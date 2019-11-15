<?php

namespace common\lib;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\lib\CompanyBase;

/**
 * CompanySearchBase represents the model behind the search form about `common\lib\CompanyBase`.
 */
class CompanySearchBase extends CompanyBase
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'companytype', 'employeecountindex', 'status'], 'integer'],
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
        $query = CompanyBase::find();

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
        /*$query->andFilterWhere([
            'id' => $this->id,
            'companytype' => $this->companytype,
            'founddate' => $this->founddate,
            'employeecountindex' => $this->employeecountindex,
            'status' => $this->status,
            'createdate' => $this->createdate,
            'updatedate' => $this->updatedate,
        ]);

        $query->andFilterWhere(['like', 'companyname', $this->companyname])
            ->andFilterWhere(['like', 'adress', $this->adress])
            ->andFilterWhere(['like', 'taxid', $this->taxid])
            ->andFilterWhere(['like', 'homepage', $this->homepage])
            ->andFilterWhere(['like', 'logo', $this->logo]);*/

        return $dataProvider;
    }
}
