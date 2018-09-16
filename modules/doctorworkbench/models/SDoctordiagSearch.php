<?php

namespace app\modules\doctorworkbench\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\doctorworkbench\models\SDoctordiag;

/**
 * SDoctordiagSearch represents the model behind the search form of `app\modules\doctorworkbench\models\SDoctordiag`.
 */
class SDoctordiagSearch extends SDoctordiag
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'vn', 'hn', 'vstdate', 'vsttime', 'diagtype', 'diagcode', 'icd10', 'userid_doctor', 'data_json'], 'safe'],
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
        $query = SDoctordiag::find();

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
        ]);

        $query->andFilterWhere(['ilike', 'id', $this->id])
            ->andFilterWhere(['ilike', 'vn', $this->vn])
            ->andFilterWhere(['ilike', 'hn', $this->hn])
            ->andFilterWhere(['ilike', 'diagtype', $this->diagtype])
            ->andFilterWhere(['ilike', 'diagcode', $this->diagcode])
            ->andFilterWhere(['ilike', 'icd10', $this->icd10])
            ->andFilterWhere(['ilike', 'userid_doctor', $this->userid_doctor])
            ->andFilterWhere(['ilike', 'data_json', $this->data_json]);

        return $dataProvider;
    }
}
