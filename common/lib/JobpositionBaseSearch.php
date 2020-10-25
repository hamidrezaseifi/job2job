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
				    [ 'id', 'companyid', 'status' ],
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

		 //echo $query->createCommand()->getRawSql(); exit;

		return $dataProvider;
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function searchBackend($params) {
	    $ort = isset ( $_GET ['so'] ) ? $_GET ['so'] : false;
	    $text = isset ( $_GET ['st'] ) ? $_GET ['st'] : false;
	    $worktype = isset ( $_GET ['wt'] ) ? $_GET ['wt'] : false;
	    $vacancy = isset ( $_GET ['vk'] ) ? $_GET ['vk'] : false;
	    
	    $order = array('createdate' => SORT_DESC);
	    
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
	    
	    //echo $query->createCommand()->getRawSql(); exit;
	    
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
	    
	    $models = JobpositionBase::find ()
	    ->select ( [ 'id', 'title', 'subtitle' ] )
	    ->where ( [ 'status' => 1, 'branch' => $branch ] )
	    ->orderBy ( [ 'createdate' => SORT_DESC ] )
	    ->limit ( $limit )
	    ->all ();
	    
	    return $models;
	}
	
	public function searchCount($params) {
	    $query = $this->createSearchCountQuery($params, ['count(DISTINCT id) as jobCount']);
	    
	    $result = $query->all();
	    
	    $out = ['count' => 0, 'err' => false];
	    if($result && is_array($result) && count($result) > 0){
	        $out['count'] = $result[0]->jobCount;
	    }
	    return $out;
	}
	
	public function searchInPage($params, $sortType) {
	    
	    $order = false;
	    switch ($sortType){
	        case "new": $order = ["createdate" => SORT_DESC]; break;
	        case "title": $order = ["title" => SORT_ASC]; break;
	        case "vacancy": $order = ["vacancy" => SORT_ASC]; break;
	        case "startdate": $order = ["jobstartdate" => SORT_ASC]; break;
	        case "branch": $order = ["branch" => SORT_ASC]; break;
	    }

	    $query = $this->createSearchQuery($params, ['j2j_jobposition.id', 'j2j_jobposition.title', 'j2j_jobposition.city', 'j2j_jobposition.country', 'j2j_jobposition.postcode', 'j2j_jobposition.createdate', 'j2j_jobposition.vacancy', 'j2j_jobposition.jobstartdate', 'j2j_jobposition.branch']);
	    
	    if($order){
	        $query->orderBy($order);
	    }

	    $models = $query->all();
	    
	    $results = [];
	    
	    foreach ($models as $model){
	        $results[] = [
	            'id' => $model->id, 
	            'title' => $model->title, 
	            'city' => $model->city, 
	            'country' => $model->country, 
	            'postcode' => $model->postcode, 
	            'skills' => $model->getSkillsAsStringList(), 
	            
	        ];
	    }
	    
	    return $results;
	}
	
	private function createSearchQuery($params, $columnSelect){
	    
	    $searchTextList = array_filter(explode(" ", $params["searchText"]), function($value) {
	        return $value !== "";
	    });
	        
	        
	        $countries = array_keys($params["region"]);
	        
	        $query = JobpositionBase::find()->distinct(['id'])
	        ->select($columnSelect)
	        ->leftJoin('j2j_jobpositionskill', 'j2j_jobpositionskill.jobid = j2j_jobposition.id')
	        ->Where(['status' => 1]);
	        $textFilterArray = false;
	        
	        foreach ($searchTextList as $searchText){
	            $orItem = ['or', ['like', 'title' , trim($searchText)], ['like', 'subtitle' , trim($searchText)]];
	            if($textFilterArray){
	                $textFilterArray = ['or', $textFilterArray, $orItem];
	            }
	            else{
	                $textFilterArray = $orItem;
	            }
	            
	            //echo $likeSearchText . ', '. PHP_EOL;
	        }
	        
	        if($textFilterArray){
	            $query->andWhere($textFilterArray);
	        }
	        
	        if(count($params["vacancies"])){
	            $query->andWhere(['in', 'vacancy', $params["vacancies"]]);
	        }
	        if(count($params["branches"])){
	            $query->andWhere(['in', 'branch', $params["branches"]]);
	        }
	        
	        if(count($params["skills"])){
	            $query->andWhere(['in', 'skill', $params["skills"]]);
	        }
	        
	        $regionFilterArray = false;
	        foreach ($countries as $country){
	            
	            
	            if(isset($params["region"][$country])){
	                
	                $countryList = $params["region"][$country];
	                $cities = array_keys($countryList);
	                foreach ($cities as $city){
	                    if($countryList[$city]){
	                        $orItem = $city == 'self' ? ['or', ['country' => $country]] : ['or', ['city' => $city]];
	                        
	                        if($regionFilterArray){
	                            $regionFilterArray = ['or', $regionFilterArray, $orItem];
	                        }
	                        else{
	                            $regionFilterArray = $orItem;
	                        }
	                    }
	                }
	            }
	            
	            //echo $likeSearchText . ', '. PHP_EOL;
	        }
	        
	        if($regionFilterArray){
	            $query->andWhere($regionFilterArray);
	        }
	        
	        //echo $query->createCommand()->rawSql;
	        //exit;
	        return $query;
	}
	
	
	private function createSearchCountQuery($params, $columnSelect){
	    
	    $searchTextList = array_filter(explode(" ", $params["searchText"]), function($value) {
	        return $value !== "";
	    });
	        
	        
	        $countries = array_keys($params["region"]);
	        
	        $query = JobpositionBase::find()->distinct(['id'])
	        ->select($columnSelect)
	        ->Where(['status' => 1]);
	        $textFilterArray = false;
	        
	        foreach ($searchTextList as $searchText){
	            $orItem = ['or', ['like', 'title' , trim($searchText)], ['like', 'subtitle' , trim($searchText)]];
	            if($textFilterArray){
	                $textFilterArray = ['or', $textFilterArray, $orItem];
	            }
	            else{
	                $textFilterArray = $orItem;
	            }
	            
	            //echo $likeSearchText . ', '. PHP_EOL;
	        }
	        
	        if($textFilterArray){
	            $query->andWhere($textFilterArray);
	        }
	        
	        if(count($params["vacancies"])){
	            $query->andWhere(['in', 'vacancy', $params["vacancies"]]);
	        }
	        if(count($params["branches"])){
	            $query->andWhere(['in', 'branch', $params["branches"]]);
	        }
	        
	        if(count($params["skills"])){
	            $skillIdList = JobpositionskillBase::findAllJobIdsForSkills($params["skills"]); 	            
	            //print_r($skillIdList); exit;
	            $query->andWhere(['in', 'id', $skillIdList]);
	        }
	        
	        $regionFilterArray = false;
	        foreach ($countries as $country){
	            
	            
	            if(isset($params["region"][$country])){
	                
	                $countryList = $params["region"][$country];
	                $cities = array_keys($countryList);
	                foreach ($cities as $city){
	                    if($countryList[$city]){
	                        $orItem = $city == 'self' ? ['or', ['country' => $country]] : ['or', ['city' => $city]];
	                        
	                        if($regionFilterArray){
	                            $regionFilterArray = ['or', $regionFilterArray, $orItem];
	                        }
	                        else{
	                            $regionFilterArray = $orItem;
	                        }
	                    }
	                }
	            }
	            
	            //echo $likeSearchText . ', '. PHP_EOL;
	        }
	        
	        if($regionFilterArray){
	            $query->andWhere($regionFilterArray);
	        }
	        
	        //echo $query->createCommand()->rawSql;
	        //exit;
	        return $query;
	}
}
