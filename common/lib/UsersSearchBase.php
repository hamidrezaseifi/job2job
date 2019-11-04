<?php

namespace common\lib;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\lib\UsersBase;

/**
 * UsersSearchBase represents the model behind the search form about `common\lib\UsersBase`.
 */
class UsersSearchBase extends UsersBase
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usertype', 'group', 'permission', 'status'], 'integer'],
            [['uname', 'password_hash', 'password_reset_token', 'auth_key', 'fname', 'lname', 'createdate', 'updatedate'], 'safe'],
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
        $query = UsersBase::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'usertype' => $this->usertype,
            'createdate' => $this->createdate,
            'updatedate' => $this->updatedate,
            'group' => $this->group,
            'permission' => $this->permission,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'uname', $this->uname])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'lname', $this->lname]);

            //echo $query->createCommand()->getRawSql(); exit;
        return $dataProvider;
    }
}
