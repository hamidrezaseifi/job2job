<?php

namespace common\lib;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\lib\JobpositionBase;
use yii\helpers\ArrayHelper;

/**
 * JobPositionBaseSearch represents the model behind the search form about `common\lib\JobPositionBase`.
 */
class JobpositionBaseSearch extends JobpositionBase {
	/**
	 *
	 * @inheritdoc
	 */
	public function rules() {
		return [
				[
						[
								'id',
								'companyid',
								'status'
						],
						'integer'
				],
				[
						[
								'title',
								'subtitle',
								'postcode',
								'city',
								'country',
								'createdate',
								'updatedate'
						],
						'safe'
				]
		];
	}

	/**
	 *
	 * @inheritdoc
	 */
	public function scenarios() {
		// bypass scenarios() implementation in the parent class
		return Model::scenarios ();
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params, $order = array('createdate' => SORT_DESC), $filterExpire = true, $fromJob2job = false) {
		$ort = isset ( $_GET ['so'] ) ? $_GET ['so'] : false;
		$text = isset ( $_GET ['st'] ) ? $_GET ['st'] : false;
		$worktype = isset ( $_GET ['wt'] ) ? $_GET ['wt'] : false;
		$vacancy = isset ( $_GET ['vk'] ) ? $_GET ['vk'] : false;

		if ($worktype) {
			$this->worktype = $worktype;
		}
		if ($vacancy) {
			$this->vacancy = $vacancy;
		}

		$query = JobpositionBase::find ();
		$query->select ( [
				'j2j_jobposition.*',
				'IFNULL((select GROUP_CONCAT(skill SEPARATOR ", ") from j2j_jobpositionskill where jobid=id ), "") as allskill'
		] );
		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider ( [
				'query' => $query
		] );

		$this->load ( $params );

		if (! $this->validate ()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		// grid filtering conditions
		$query->andFilterWhere ( [
				'id' => $this->id,
				'companyid' => $this->companyid,
				'status' => $this->status,
				'branch' => $this->branch,
				'worktype' => $this->worktype,
				'vacancy' => $this->vacancy
		] );

		if ($filterExpire) {
			$query->andWhere ( [
					'>=',
					'expiredate',
					date ( 'Y-m-d' )
			] );
		}

		if ($fromJob2job) {
			$job2jobModels = CompanyBase::find ()->where ( [
					'isjob2job' => 1,
					'status' => 1
			] )->select ( [
					'id'
			] )->all ();

			$allCompID = ArrayHelper::getColumn ( $job2jobModels, 'id' );

			$allPosModels = JobpositionBase::find ()->select ( [
					'id'
			] )->where ( [
					'status' => 1
			] )->andFilterWhere ( [
					'in',
					'companyid',
					$allCompID
			] )->all ();
			$allJobposID = ArrayHelper::getColumn ( $allPosModels, 'id' );
			// print_r($allJobposID); exit;
			if (count ( $allJobposID ) == 0) {
				$allJobposID [] = 0;
			}
			// $allJobposID = array(0);
			$query->andFilterWhere ( [
					'in',
					'id',
					$allJobposID
			] );
		}

		// $query->andFilterWhere(['like', 'title', $this->title]);
		// ->andFilterWhere(['like', 'subtitle', $this->subtitle])
		// ->andFilterWhere(['like', 'postcode', $this->postcode])
		// ->andFilterWhere(['like', 'city', $this->city])
		// ->andFilterWhere(['like', 'country', $this->country]);

		if ($ort) {
			$ortlist = explode ( ',', $ort );
			foreach ( $ortlist as $idx => $ort ) {
				if (trim ( $ort ) == '')
					unset ( $ortlist [$idx] );
			}
			if (count ( $ortlist ) > 0) {
				$ortqr = array (
						'or'
				);
				foreach ( $ortlist as $idx => $ort ) {
					$ort = trim ( $ort );
					if (strval ( intval ( $ort ) ) == $ort) {
						$ortqr [] = [
								'like',
								'postcode',
								$ort
						];
					} else {
						$ortqr [] = [
								'like',
								'country',
								$ort
						];
						$ortqr [] = [
								'like',
								'city',
								$ort
						];
					}
				}

				$query->andFilterWhere ( $ortqr );
			}
		}

		$textlist = array ();
		if ($text) {
			$textlist = explode ( ',', $text );
			foreach ( $textlist as $idx => $text ) {
				if (trim ( $text ) == '')
					unset ( $textlist [$idx] );
			}
			if (count ( $textlist ) > 0) {
				$ortqr = array (
						'or'
				);
				foreach ( $textlist as $idx => $text ) {
					$text = trim ( $text );

					$ortqr [] = [
							'like',
							'title',
							$text
					];
					$ortqr [] = [
							'>',
							'(select count(*) from j2j_jobpositionskill where jobid=j2j_jobposition.id and skill like "%' . $text . '%")',
							0
					];
				}

				$query->andFilterWhere ( $ortqr );
			}
		}

		$query->orderBy ( $order );

		// echo $query->createCommand()->getRawSql(); exit;

		return $dataProvider;
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function searchFavoriteJob($params, $userid, $order = array('createdate' => SORT_DESC)) {
		$query = JobpositionBase::find ();
		// $query->select(['j2j_jobposition.*' , 'IFNULL((select GROUP_CONCAT(skill SEPARATOR ", ") from j2j_jobpositionskill where jobid=id ), "") as allskill']);
		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider ( [
				'query' => $query
		] );

		$this->load ( $params );

		$allfav = CandidatefavoriteBase::find ()->select ( [
				'jobposid'
		] )->where ( [
				'userid' => $userid
		] )->all ();

		$allfav = ArrayHelper::getColumn ( $allfav, 'jobposid' );
		$allfav [] = 0;
		// print_r($allfav); exit;

		$query->andFilterWhere ( [
				'in',
				'id',
				$allfav
		] );
		if (! $this->validate ()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		// grid filtering conditions
		$query->andFilterWhere ( [
				'id' => $this->id,
				'companyid' => $this->companyid,
				'status' => $this->status,
		        'branch' => $this->branch,
				'worktype' => $this->worktype,
				'vacancy' => $this->vacancy
		] );

		$query->orderBy ( $order );

		// echo $query->createCommand()->getRawSql(); exit;

		return $dataProvider;
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function searchApplyJob($params, $userid, $order = array('createdate' => SORT_DESC)) {
		$query = JobpositionBase::find ();
		// $query->select(['j2j_jobposition.*' , 'IFNULL((select GROUP_CONCAT(skill SEPARATOR ", ") from j2j_jobpositionskill where jobid=id ), "") as allskill']);
		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider ( [
				'query' => $query
		] );

		$this->load ( $params );

		$allfav = CandidatejobapplyBase::find ()->select ( [
				'jobposid'
		] )->where ( [
				'userid' => $userid
		] )->all ();

		$allfav = ArrayHelper::getColumn ( $allfav, 'jobposid' );
		$allfav [] = 0;
		// print_r($allfav); exit;

		$query->andFilterWhere ( [
				'in',
				'id',
				$allfav
		] );
		if (! $this->validate ()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		// grid filtering conditions
		$query->andFilterWhere ( [
				'id' => $this->id,
				'companyid' => $this->companyid,
				'status' => $this->status,
				'branch' => $this->branch,
				'worktype' => $this->worktype,
				'vacancy' => $this->vacancy
		] );

		$query->orderBy ( $order );

		// echo $query->createCommand()->getRawSql(); exit;

		return $dataProvider;
	}
	public function searchBranches($branch, $limit = 10) {
		$order = array (
				'createdate' => SORT_DESC
		);

		$models = JobpositionBase::find ()->select ( [
				'title',
				'subtitle'
		] )->where ( [
				'status' => 1,
				'branch' => $branch
		] )->orderBy ( [
				'createdate' => SORT_DESC
		] )->limit ( $limit )->all ();

		return $models;
	}
}
