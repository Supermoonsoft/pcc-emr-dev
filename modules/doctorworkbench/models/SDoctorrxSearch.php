<?php

namespace app\modules\doctorworkbench\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\doctorworkbench\models\SDoctorrx;

/**
 * SDoctorrxSearch represents the model behind the search form of `app\modules\doctorworkbench\models\SDoctorrx`.
 */
class SDoctorrxSearch extends SDoctorrx
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'vn', 'hn', 'an', 'vstdate', 'vsttime', 'drugcode', 'userid_doctor', 'data_json'], 'safe'],
            [['use_id'], 'integer'],
            [['qty', 'unitprice', 'costprice', 'totalprice'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = SDoctorrx::find();

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
            'vstdate' => $this->vstdate,
            'vsttime' => $this->vsttime,
            'use_id' => $this->use_id,
            'qty' => $this->qty,
            'unitprice' => $this->unitprice,
            'costprice' => $this->costprice,
            'totalprice' => $this->totalprice,
        ]);

        $query->andFilterWhere(['ilike', 'id', $this->id])
            ->andFilterWhere(['ilike', 'vn', $this->vn])
            ->andFilterWhere(['ilike', 'hn', $this->hn])
            ->andFilterWhere(['ilike', 'an', $this->an])
            ->andFilterWhere(['ilike', 'drugcode', $this->drugcode])
            ->andFilterWhere(['ilike', 'userid_doctor', $this->userid_doctor])
            ->andFilterWhere(['ilike', 'data_json', $this->data_json]);

        return $dataProvider;
    }
}
