<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_branch".
 *
 * @property integer $id
 * @property string $title
 * @property string $shortcut
 * @property string $image
 * @property string $logo
 * @property integer $status
 * @property string $created
 * @property string $updated
 */
class BranchBase extends \common\models\Branch {


	/**
	 *
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => Yii::t('app', 'ID'),
		    'title' => Yii::t('app', 'Title'),
		    'shortcut' => Yii::t('app', 'Shortcut'),
		    'image' => Yii::t('app', 'Image'),
		    'logo' => Yii::t('app', 'Logo'),
		    'status' => Yii::t('app', 'Status'),
		    'created' => Yii::t('app', 'Created'),
		    'updated' => Yii::t('app', 'Updated'),
		];
	}

	/**
	 *
	 * @inheritdoc
	 * @return BranchQueryBase the active query used by this AR class.
	 */
	public static function find() {
		return new BranchQueryBase ( get_called_class () );
	}

	/**
	 *
	 * @inheritdoc
	 * @return BranchQueryBase the active query used by this AR class.
	 */
	public static function findFromShortcut($shortcut) {
		return BranchBase::findOne ( [
				'shortcut' => $shortcut
		] );
	}
	
	/**
	 *
	 * @inheritdoc
	 * @return BranchQueryBase the active branches.
	 */
	public static function allActive() {
	    $branchesQuery = BranchBase::findAll ( [
	        'status' => 1
	    ] );
	    
	    $branches = array ();
	    foreach ( $branchesQuery as $branchItem ) {
	        $branch = array ();
	        $branch ["id"] = $branchItem->id;
	        $branch ["shortcut"] = $branchItem->shortcut;
	        $branch ["label"] = $branchItem->title;
	        $branch ["image"] = $branchItem->image;
	        $branch ["logo"] = $branchItem->logo;
	        $branch ["jobs"] = [ ];
	        
	        $branches [] = $branch;
	    }
	    
	    return $branches;
	}
	
	/**
	 *
	 * @inheritdoc
	 * @return BranchQueryBase the active branches.
	 */
	public static function allActiveKeyList() {
	    $branchesQuery = BranchBase::findAll ( [
	        'status' => 1
	    ] );
	    
	    $branches = array ();
	    foreach ( $branchesQuery as $branchItem ) {
	        
	        $branches [$branchItem->id] = $branchItem->title;
	    }
	    
	    return $branches;
	}
}
